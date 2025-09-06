<?php
// --- FUNKCJA LOGOWANIA ---
function backend_log($message) {
    file_put_contents(__DIR__ . '/../backend.log', date('[Y-m-d H:i:s] ') . $message . PHP_EOL, FILE_APPEND);
}

// --- OBSŁUGA BŁĘDÓW ---
error_reporting(E_ALL);
ini_set('display_errors', 0);
set_error_handler(function($severity, $message, $file, $line) {
    backend_log("PHP BŁĄD: $message w $file na linii $line");
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'error' => 'PHP_ERROR', 'message' => $message]);
    exit;
});

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://juraquest.pl'); // Pozwól na żądania tylko z Twojej domeny
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Obsługa preflight request dla CORS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

backend_log("--- SKRYPT get_leaderboard.php URUCHOMIONY ---");

// --- DANE DOSTĘPOWE DO BAZY DANYCH ---
$servername = "localhost";
$username = "srv90026_juraquest_db";
$password = "zaq12wsxz";
$dbname = "srv90026_juraquest_db";
// ----------------------------------------

// Utwórz połączenie
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdź połączenie
if ($conn->connect_error) {
    backend_log("KRYTYCZNY BŁĄD POŁĄCZENIA: " . $conn->connect_error);
    http_response_code(503); // Service Unavailable
    echo json_encode(["success" => false, "message" => "Błąd połączenia z bazą danych: " . $conn->connect_error]);
    exit();
}
$conn->set_charset("utf8mb4");
backend_log("Pomyślnie połączono z bazą danych.");

// Pobierz 10 najlepszych wyników (najkrótszy czas, najwyższy wynik)
$sql = "SELECT team_name, completion_time_seconds, score FROM game_stats ORDER BY score DESC, completion_time_seconds ASC LIMIT 10";
$result = $conn->query($sql);

if (!$result) {
    backend_log("BŁĄD ZAPYTANIA SQL: " . $conn->error);
    echo json_encode(["success" => false, "message" => "Błąd zapytania do bazy danych: " . $conn->error]);
    $conn->close();
    exit();
}

$leaderboard = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $leaderboard[] = $row;
    }
}

echo json_encode(["success" => true, "leaderboard" => $leaderboard]);

$conn->close();
backend_log("--- Koniec skryptu ---");
?>