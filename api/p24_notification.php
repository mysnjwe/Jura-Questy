<?php
require_once 'config.php';
require 'PHPMailer/PHPMailer-6.9.1/src/Exception.php';
require 'PHPMailer/PHPMailer-6.9.1/src/PHPMailer.php';
require 'PHPMailer/PHPMailer-6.9.1/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Ustawienie nagłówka odpowiedzi
header('Content-Type: text/plain');

// Odczytanie danych wejściowych (powiadomienia ITN)
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Logowanie surowego zapytania dla celów diagnostycznych
$log_message = "Odebrano powiadomienie P24: " . $json . "\n";
error_log($log_message, 3, '../backend.log');

// Sprawdzenie, czy dane zostały poprawnie zdekodowane
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    error_log("Błąd dekodowania JSON.\n", 3, '../backend.log');
    exit('Błąd dekodowania JSON.');
}

// Weryfikacja sygnatury
$crc = P24_CRC_KEY;
$sign_data_for_hash = [
    "merchantId" => (int)$data['merchantId'],
    "posId" => (int)$data['posId'],
    "sessionId" => $data['sessionId'],
    "amount" => (int)$data['amount'],
    "originAmount" => (int)$data['originAmount'],
    "currency" => $data['currency'],
    "orderId" => (int)$data['orderId'],
    "methodId" => (int)$data['methodId'],
    "statement" => $data['statement'],
    "crc" => $crc
];

// Log the array before encoding
error_log("p24_notification.php: Sign data for hash: " . json_encode($sign_data_for_hash), 3, '../backend.log');

$expectedSign = hash('sha384', json_encode($sign_data_for_hash, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

// Log the generated sign and received sign
error_log("p24_notification.php: Expected Sign: " . $expectedSign . " | Received Sign: " . $data['sign'], 3, '../backend.log');

if ($expectedSign !== $data['sign']) {
    http_response_code(401);
    error_log("Błąd weryfikacji sygnatury.\n", 3, '../backend.log');
    exit('Błąd weryfikacji sygnatury.');
}

// Weryfikacja statusu płatności (opcjonalnie, ale zalecane)
// Tutaj można dodać logikę sprawdzającą, czy zamówienie nie zostało już przetworzone

// Generowanie kodu dostępu
$generatedAccessCode = strtoupper(bin2hex(random_bytes(4)));
$customerEmail = $data['email'];
$gameId = "Jura Quest"; // Można by to przechowywać w bazie danych powiązane z sessionId

// Wysłanie e-maila z kodem dostępu
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USERNAME;
    $mail->Password   = SMTP_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = SMTP_PORT;

    $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
    $mail->addAddress($customerEmail);

    $mail->isHTML(true);
    $mail->Subject = 'Twój kod dostępu do gry Jura Quest!';
    $mail->Body    = "<h1>Dziękujemy za zakup gry Jura Quest!</h1><p>Twój kod dostępu to: <strong>{$generatedAccessCode}</strong></p><p>Życzymy udanej zabawy!</p>";
    $mail->AltBody = "Twój kod dostępu do gry Jura Quest to: {$generatedAccessCode}";

    $mail->send();
    error_log("Wysłano e-mail z kodem {$generatedAccessCode} na adres {$customerEmail}\n", 3, '../backend.log');
} catch (Exception $e) {
    error_log("Błąd wysyłki e-maila: {$mail->ErrorInfo}\n", 3, '../backend.log');
}

// Potwierdzenie otrzymania powiadomienia do Przelewy24
http_response_code(200);
echo "OK";

?>