<?php
// Nagłówki odpowiedzi JSON
header('Content-Type: application/json; charset=utf-8');

// Import klas PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../api/PHPMailer/PHPMailer-6.9.1/src/Exception.php';
require '../../api/PHPMailer/PHPMailer-6.9.1/src/PHPMailer.php';
require '../../api/PHPMailer/PHPMailer-6.9.1/src/SMTP.php';

// Dołącz plik konfiguracyjny
require '../../api/config.php';

// Funkcja do bezpiecznego kończenia skryptu i zwracania błędu
function return_error($message) {
    // W wersji produkcyjnej nie chcemy pokazywać szczegółów technicznych
    // Można tu dodać logowanie błędów do pliku
    // error_log($message);
    echo json_encode(['success' => false, 'message' => 'Wystąpił nieoczekiwany błąd. Spróbuj ponownie.']);
    exit;
}

// Sprawdź, czy metoda to POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['success' => false, 'message' => 'Nieprawidłowa metoda żądania.']);
    exit;
}

// --- ODBIERZ I ZWALIDUJ DANE ---
$parentName = trim($_POST['parentName'] ?? '');
$parentEmail = trim($_POST['parentEmail'] ?? '');
$parentParticipates = isset($_POST['parent_participates']) && $_POST['parent_participates'] == '1';

$childNames = $_POST['childName'] ?? [];
$childAges = $_POST['childAge'] ?? [];

// Podstawowa walidacja
if (empty($parentName) || empty($parentEmail) || !is_array($childNames) || empty($childNames)) {
    return_error('Proszę wypełnić wszystkie wymagane pola formularza.');
}
if (!filter_var($parentEmail, FILTER_VALIDATE_EMAIL)) {
    return_error('Proszę podać prawidłowy adres e-mail.');
}
if (count($childNames) !== count($childAges)) {
    return_error('Dane dzieci są niespójne.');
}

// Walidacja danych dzieci
$childrenListHtml = '<ol>';
$childrenListText = '';
foreach ($childNames as $index => $name) {
    $age = $childAges[$index] ?? '';
    if (empty(trim($name)) || empty(trim($age))) {
        return_error('Proszę wypełnić imię i wiek dla każdego dziecka.');
    }
    $childrenListHtml .= '<li>' . htmlspecialchars(trim($name)) . ' (wiek: ' . htmlspecialchars(trim($age)) . ')</li>';
    $childrenListText .= '- ' . trim($name) . ' (wiek: ' . trim($age) . ')\n';
}
$childrenListHtml .= '</ol>';

$parentParticipationText = $parentParticipates ? 'Tak' : 'Nie';

// --- WYSYŁKA E-MAILI ---
try {
    // E-mail do admina
    $mailToAdmin = new PHPMailer(true);
    $mailToAdmin->isSMTP();
    $mailToAdmin->Host = SMTP_HOST;
    $mailToAdmin->SMTPAuth = true;
    $mailToAdmin->Username = SMTP_USERNAME;
    $mailToAdmin->Password = SMTP_PASSWORD;
    $mailToAdmin->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mailToAdmin->Port = SMTP_PORT;
    $mailToAdmin->CharSet = 'UTF-8';
    $mailToAdmin->setFrom(SMTP_FROM_EMAIL, 'System Jura Quest');
    $mailToAdmin->addAddress(SMTP_USERNAME, 'Admin Jura Quest');
    $mailToAdmin->addReplyTo($parentEmail, $parentName);
    $mailToAdmin->isHTML(true);
    $mailToAdmin->Subject = 'Nowe zgłoszenie na wydarzenie: Tajemnice Jury!';
    $mailToAdmin->Body = "
        <h2>Nowe zgłoszenie na wydarzenie 'Tajemnice Jury'</h2>
        <p><strong>Rodzic/Opiekun:</strong> " . htmlspecialchars($parentName) . " (" . htmlspecialchars($parentEmail) . ")</p>
        <p><strong>Zadeklarowany udział rodzica:</strong> {$parentParticipationText}</p>
        <p><strong>Zgłoszone dzieci:</strong></p>
        {$childrenListHtml}
    ";
    $mailToAdmin->AltBody = "Nowe zgłoszenie od {$parentName} ({$parentEmail}). Udział rodzica: {$parentParticipationText}. Dzieci:\n{$childrenListText}";
    $mailToAdmin->send();

    // E-mail do rodzica
    $mailToParent = new PHPMailer(true);
    $mailToParent->isSMTP();
    $mailToParent->Host = SMTP_HOST;
    $mailToParent->SMTPAuth = true;
    $mailToParent->Username = SMTP_USERNAME;
    $mailToParent->Password = SMTP_PASSWORD;
    $mailToParent->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mailToParent->Port = SMTP_PORT;
    $mailToParent->CharSet = 'UTF-8';
    $mailToParent->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
    $mailToParent->addAddress($parentEmail, $parentName);
    $mailToParent->isHTML(true);
    $mailToParent->Subject = 'Potwierdzenie zapisu na wydarzenie "Tajemnice Jury"';
    $mailToParent->Body = "
        <h2>Witaj {$parentName},</h2>
        <p>Dziękujemy za zgłoszenie! Potwierdzamy zapis następujących uczestników:</p>
        {$childrenListHtml}
        <p><strong>Twój zadeklarowany udział:</strong> {$parentParticipationText}</p>
        <p>Oto krótkie podsumowanie szczegółów:</p>
        <ul>
            <li><strong>Data:</strong> 27 września 2025</li>
            <li><strong>Godzina:</strong> 10:00 - 14:00</li>
            <li><strong>Miejsce startu:</strong> Stodoła przy plebanii we Włodowicach</li>
        </ul>
        <p>Do zobaczenia na starcie przygody!</p>
        <p>Pozdrawiamy,<br>Zespół Jura Quest</p>
    ";
    $mailToParent->send();

} catch (Exception $e) {
    return_error("Wiadomość e-mail nie mogła zostać wysłana. Błąd: {$e->getMessage()}");
}

// --- ZAPIS DO BAZY DANYCH ---
try {
    $servername = "localhost";
    $username = "srv90026_juraquest_db";
    $password = "zaq12wsxz";
    $dbname = "srv90026_juraquest_db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Błąd połączenia z bazą: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");

    // Krok 1: Upewnij się, że tabela istnieje i ma poprawną strukturę
    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS event_signups (
        id INT AUTO_INCREMENT PRIMARY KEY,
        parent_name VARCHAR(255) NOT NULL,
        parent_email VARCHAR(255) NOT NULL,
        child_name VARCHAR(255) NOT NULL,
        child_age INT NOT NULL,
        parent_participates TINYINT(1) NOT NULL DEFAULT 0,
        event_name VARCHAR(255) DEFAULT 'Tajemnice Jury',
        signup_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    if (!$conn->query($sqlCreateTable)) {
        throw new Exception("Błąd tworzenia tabeli: " . $conn->error);
    }

    // Krok 2: Przygotuj zapytanie INSERT
    $stmt = $conn->prepare("INSERT INTO event_signups (parent_name, parent_email, child_name, child_age, parent_participates) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        throw new Exception("Błąd przygotowania zapytania: " . $conn->error);
    }

    // Krok 3: Wstaw dane dla każdego dziecka
    foreach ($childNames as $index => $name) {
        $age = $childAges[$index];
        $parentParticipatesInt = $parentParticipates ? 1 : 0;
        $stmt->bind_param("sssii", $parentName, $parentEmail, $name, $age, $parentParticipatesInt);
        if (!$stmt->execute()) {
            throw new Exception("Błąd wykonywania zapytania: " . $stmt->error);
        }
    }

    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    return_error("Błąd bazy danych: " . $e->getMessage());
}

// Jeśli wszystko się udało, zwróć sukces
echo json_encode(['success' => true]);

?>