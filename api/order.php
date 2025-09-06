<?php
// === OSTATECZNA WERSJA DIAGNOSTYCZNA ===

// Krok 1: Agresywne raportowanie błędów - MUSI być na samej górze
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Krok 2: Nagłówki CORS
header('Access-Control-Allow-Origin: https://juraquest.pl');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json'); // Zawsze zwracamy JSON

// Obsługa preflight request dla CORS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Krok 3: Niezawodne logowanie
function log_to_file($message) {
    // Używamy ścieżki bezwzględnej dla pewności
    $log_file = __DIR__ . '/../backend.log';
    file_put_contents($log_file, date('[Y-m-d H:i:s] ') . '[order.php] ' . $message . PHP_EOL, FILE_APPEND);
}

log_to_file("Skrypt uruchomiony.");

// Dołączanie konfiguracji
require_once 'config.php';
log_to_file("Plik config.php załadowany.");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    log_to_file("Błąd - nieprawidłowa metoda HTTP: " . $_SERVER['REQUEST_METHOD']);
    echo json_encode(['status' => 'error', 'message' => 'Metoda żądania musi być POST.']);
    exit;
}
log_to_file("Metoda POST poprawna.");

$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$gameId = htmlspecialchars($_POST['gameId'] ?? 'Nieznana Gra');
$amount = 499; // Kwota w groszach

if (!$email) {
    http_response_code(400);
    log_to_file("Błąd - nieprawidłowy lub pusty e-mail.");
    echo json_encode(['status' => 'error', 'message' => 'Brak poprawnego adresu e-mail.']);
    exit;
}
log_to_file("E-mail poprawny: {$email}");

$sessionId = uniqid('juraquest_', true);
$description = "Zamówienie gry: {$gameId}";
$urlReturn = "https://juraquest.pl/dziekujemy.html?session={$sessionId}";
$urlStatus = "https://juraquest.pl/api/p24_notification.php";

log_to_file("Sesja {$sessionId} przygotowana.");

// Tworzenie sygnatury
$crc = P24_CRC_KEY;
$sign_data = [
    "sessionId" => $sessionId,
    "merchantId" => (int)P24_MERCHANT_ID,
    "amount" => $amount,
    "currency" => "PLN",
    "crc" => $crc
];
$sign = hash('sha384', json_encode($sign_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

log_to_file("Sygnatura dla sesji {$sessionId} wygenerowana.");

$p24_data = [
    "merchantId" => (int)P24_MERCHANT_ID,
    "posId" => (int)P24_POS_ID,
    "sessionId" => $sessionId,
    "amount" => $amount,
    "currency" => "PLN",
    "description" => $description,
    "email" => $email,
    "country" => "PL",
    "language" => "pl",
    "urlReturn" => $urlReturn,
    "urlStatus" => $urlStatus,
    "sign" => $sign
];

log_to_file("Dane do wysłania do P24: " . json_encode($p24_data));

// Komunikacja z API Przelewy24
$register_url = P24_URL . 'api/v1/transaction/register';
log_to_file("Inicjuję cURL do: {$register_url}");

$ch = curl_init($register_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($p24_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Basic ' . base64_encode(P24_POS_ID . ':' . P24_API_KEY)
]);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);
curl_close($ch);

log_to_file("Odpowiedź z P24. HTTP Code: {$httpcode}. cURL Error: {$curl_error}. Raw Response: {$response}");

$responseData = json_decode($response, true);

if (($httpcode === 200 || $httpcode === 201) && isset($responseData['data']['token'])) {
    $redirectUrl = P24_URL . 'trnRequest/' . $responseData['data']['token'];
    log_to_file("Sukces! Token otrzymany. Przekierowanie na: {$redirectUrl}");
    echo json_encode(['status' => 'success', 'redirectUrl' => $redirectUrl]);
} else {
    log_to_file("BŁĄD REJESTRACJI TRANSAKCJI.");
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Nie udało się zainicjować płatności. Błąd komunikacji z bramką.']);
}

?>