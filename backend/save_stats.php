<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://juraquest.pl'); // Pozwól na żądania tylko z Twojej domeny
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Obsługa preflight request dla CORS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

$servername = "localhost";
$username = "srv90026_juraquest_db";
$password = "zaq12wsxz";
$dbname = "srv90026_juraquest_db";

// Utwórz połączenie
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdź połączenie
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);

$teamName = $input['teamName'] ?? '';
$completionTimeSeconds = $input['completionTimeSeconds'] ?? 0; // Czas w sekundach
$score = $input['score'] ?? 0; // Nowa zmienna dla wyniku

if (empty($teamName) || $completionTimeSeconds <= 0) {
    echo json_encode(["success" => false, "message" => "Invalid data provided."]);
    $conn->close();
    exit();
}

// Przygotuj zapytanie SQL
$stmt = $conn->prepare("INSERT INTO game_stats (team_name, completion_time_seconds, score) VALUES (?, ?, ?)");
$stmt->bind_param("sii", $teamName, $completionTimeSeconds, $score); // Dodano 'i' dla score

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Statistics saved successfully!"]);
} else {
    echo json_encode(["success" => false, "message" => "Error saving statistics: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>