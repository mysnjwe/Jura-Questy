<?php
session_start();

header('Content-Type: application/json; charset=utf-8');

// --- PROSTA KONFIGURACJA BEZPIECZEŃSTWA ---
$session_key = 'is_logged_in';

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION[$session_key]) || $_SESSION[$session_key] !== true) {
    echo json_encode(['success' => false, 'message' => 'Brak autoryzacji.']);
    exit;
}

// Sprawdź, czy metoda to POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Nieprawidłowa metoda żądania.']);
    exit;
}

// Odbierz ID do usunięcia
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    echo json_encode(['success' => false, 'message' => 'Nieprawidłowe ID wpisu.']);
    exit;
}

// --- DANE DOSTĘPOWE DO BAZY DANYCH ---
$servername = "localhost";
$username = "srv90026_juraquest_db";
$password = "zaq12wsxz";
$dbname = "srv90026_juraquest_db";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Błąd połączenia z bazą: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");

    // Przygotuj i wykonaj zapytanie DELETE
    $stmt = $conn->prepare("DELETE FROM event_signups WHERE id = ?");
    if ($stmt === false) {
        throw new Exception("Błąd przygotowania zapytania: " . $conn->error);
    }
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Wpis o podanym ID nie istnieje.']);
        }
    } else {
        throw new Exception("Błąd wykonywania zapytania: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Błąd serwera: ' . $e->getMessage()]);
    exit;
}

?>
