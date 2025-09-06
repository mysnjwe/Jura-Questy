<?php
// verify_code.php (Wersja ostateczna)

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

// =================================================================================
// GŁÓWNA LOGIKA SKRYPTU
// =================================================================================

header('Content-Type: application/json; charset=utf-8');

// --- DANE DOSTĘPOWE DO BAZY DANYCH ---
$servername = "localhost";
$username = "srv90026_juraquest_db";
$password = "zaq12wsxz";
$dbname = "srv90026_juraquest_db";
// ----------------------------------------

backend_log("--- SKRYPT verify_code.php URUCHOMIONY (wersja ostateczna) ---");

$input = json_decode(file_get_contents('php://input'), true);
$code = isset($input['code']) ? trim($input['code']) : '';

backend_log("Odebrano kod: '" . $code . "'");

if (empty($code)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Kod aktywacyjny nie może być pusty.']);
    exit;
}

// --- NAJPIERW NAWIĄŻ POŁĄCZENIE ---
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    backend_log("KRYTYCZNY BŁĄD POŁĄCZENIA: " . $conn->connect_error);
    http_response_code(503);
    echo json_encode(['success' => false, 'message' => 'Błąd połączenia z bazą danych: ' . $conn->connect_error]);
    exit;
}
$conn->set_charset("utf8mb4");
backend_log("Pomyślnie połączono z bazą danych.");

// --- OBSŁUGA KODÓW WIELORAZOWYCH ---
if ($code === "JURAFREE" || $code === "1") {
    backend_log("Kod pasuje do kodu wielorazowego. Loguję użycie.");
    
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
    $sql_insert_log = "INSERT INTO multi_use_code_usage (code, ip_address) VALUES (?, ?)";
    $stmt_log = $conn->prepare($sql_insert_log);
    
    if ($stmt_log) {
        $stmt_log->bind_param("ss", $code, $ip_address);
        if ($stmt_log->execute()) {
            backend_log("Pomyślnie zapisano użycie kodu '" . $code . "' w bazie danych.");
        } else {
            backend_log("BŁĄD wykonania zapytania INSERT: " . $stmt_log->error);
        }
        $stmt_log->close();
    } else {
        backend_log("Błąd przygotowania zapytania INSERT: " . $conn->error);
    }
    
    // Niezależnie od sukcesu logowania, aktywuj grę
    echo json_encode(['success' => true, 'message' => 'Gra aktywowana! Witaj w Jura Quest!']);

} else {
    // --- OBSŁUGA KODÓW JEDNORAZOWYCH ---
    backend_log("Kod nie jest wielorazowy. Sprawdzam w tabeli activation_codes...");

    $sql_select = "SELECT status FROM activation_codes WHERE code = ? LIMIT 1";
    $stmt = $conn->prepare($sql_select);
    if (!$stmt) {
        backend_log("Błąd przygotowania zapytania SELECT: " . $conn->error);
        echo json_encode(['success' => false, 'message' => 'Błąd serwera przy sprawdzaniu kodu.']);
        exit;
    }

    $stmt->bind_param("s", $code);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($status);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        if ($status === 'used') {
            echo json_encode(['success' => false, 'message' => 'Ten kod został już wykorzystany.']);
        } elseif ($status === 'new') {
            $stmt->close();
            $sql_update = "UPDATE activation_codes SET status = 'used', used_at = NOW() WHERE code = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("s", $code);
            if ($stmt_update->execute()) {
                echo json_encode(['success' => true, 'message' => 'Gra została pomyślnie aktywowana!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Nie udało się zaktualizować statusu kodu.']);
            }
            $stmt_update->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Kod ma nieprawidłowy status.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Nieprawidłowy kod aktywacyjny.']);
    }
}

// Zawsze zamykaj połączenie na końcu
$conn->close();
backend_log("--- Koniec skryptu ---");

?>