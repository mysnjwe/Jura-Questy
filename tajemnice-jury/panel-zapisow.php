<?php
session_start();

// --- PROSTA KONFIGURACJA BEZPIECZEŃSTWA ---
$password = 'JuraQuestAdmin2025!';
$session_key = 'is_logged_in';

// --- OBSŁUGA LOGOWANIA I WYLOGOWYWANIA ---
if (isset($_POST['password'])) {
    if ($_POST['password'] === $password) {
        $_SESSION[$session_key] = true;
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $login_error = 'Nieprawidłowe hasło!';
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// --- DANE DOSTĘPOWE DO BAZY DANYCH ---
$servername = "localhost";
$username = "srv90026_juraquest_db";
$db_password = "zaq12wsxz";
$dbname = "srv90026_juraquest_db";

$total_children = 0;
$total_parents = 0;
$signups = [];
$db_error = null;

// Funkcja do pobierania i aktualizowania liczników
function update_counts($conn) {
    global $total_children, $total_parents;
    $total_children = 0;
    $total_parents = 0;

    $table_check = $conn->query("SHOW TABLES LIKE 'event_signups'");
    if ($table_check->num_rows > 0) {
        $result_children = $conn->query("SELECT COUNT(*) as total FROM event_signups");
        $total_children = $result_children->fetch_assoc()['total'];

        $column_check = $conn->query("SHOW COLUMNS FROM `event_signups` LIKE 'parent_participates'");
        if ($column_check->num_rows > 0) {
            $result_parents = $conn->query("SELECT COUNT(DISTINCT parent_email) as total FROM event_signups WHERE parent_participates = 1");
            $total_parents = $result_parents->fetch_assoc()['total'];
        }
    }
}

// --- POBIERANIE DANYCH (tylko jeśli zalogowano) ---
if (isset($_SESSION[$session_key]) && $_SESSION[$session_key] === true) {
    try {
        $conn = new mysqli($servername, $username, $db_password, $dbname);
        if ($conn->connect_error) {
            throw new Exception("Błąd połączenia: " . $conn->connect_error);
        }
        $conn->set_charset("utf8mb4");

        update_counts($conn); // Aktualizuj liczniki przy ładowaniu strony

        $table_check = $conn->query("SHOW TABLES LIKE 'event_signups'");
        if ($table_check->num_rows > 0) {
            $column_check = $conn->query("SHOW COLUMNS FROM `event_signups` LIKE 'parent_participates'");
            if ($column_check->num_rows > 0) {
                $sql_select_all = "SELECT id, parent_name, parent_email, child_name, child_age, signup_date, parent_participates FROM event_signups ORDER BY signup_date DESC";
            } else {
                $sql_select_all = "SELECT id, parent_name, parent_email, child_name, child_age, signup_date, 0 AS parent_participates FROM event_signups ORDER BY signup_date DESC";
            }

            $result_data = $conn->query($sql_select_all);
            while ($row = $result_data->fetch_assoc()) {
                $signups[] = $row;
            }
        } else {
            $signups = [];
        }

        $conn->close();
    } catch (Exception $e) {
        $db_error = $e->getMessage();
    }
}

// --- USTAWIENIA STRONY (dla nagłówka) ---
$pageTitle = "Panel Zapisów na Wydarzenie";
$pageDescription = "Panel administracyjny do przeglądania zapisów na wydarzenie.";
$currentPage = basename(__FILE__);
$isHomePage = false;

function include_modified_header($pageTitle, $pageDescription, $currentPage, $isHomePage) {
    include '../header.php';
    echo '<meta name="robots" content="noindex, nofollow">';
}

include_modified_header($pageTitle, $pageDescription, $currentPage, $isHomePage);
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0">Panel Zapisów</h1>
                <?php if (isset($_SESSION[$session_key]) && $_SESSION[$session_key] === true): ?>
                    <a href="?logout=1" class="btn btn-sm btn-outline-secondary">Wyloguj</a>
                <?php endif; ?>
            </div>

            <?php if (!isset($_SESSION[$session_key]) || $_SESSION[$session_key] !== true): ?>
                <div class="card col-md-6 offset-md-3">
                    <div class="card-body">
                        <h5 class="card-title text-center">Logowanie do panelu</h5>
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="password" class="form-label">Hasło</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <?php if (isset($login_error)): ?>
                                <div class="alert alert-danger"><?php echo $login_error; ?></div>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-primary w-100">Zaloguj</button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <!-- === PANEL PO ZALOGOWANIU === -->
                <div class="row text-center mb-4">
                    <div class="col-md-4">
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <h6 class="text-muted mb-1">Zapisane dzieci</h6>
                                <p class="display-4 fw-bold mb-0" id="total-children-count"><?php echo $total_children; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <h6 class="text-muted mb-1">Uczestniczący rodzice</h6>
                                <p class="display-4 fw-bold mb-0" id="total-parents-count"><?php echo $total_parents; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <h6 class="text-muted mb-1">Wszyscy uczestnicy</h6>
                                <p class="display-4 fw-bold mb-0"><?php echo $total_children + $total_parents; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($db_error): ?>
                    <div class="alert alert-danger">Błąd bazy danych: <?php echo htmlspecialchars($db_error); ?></div>
                <?php else: ?>
                    <div class="card">
                        <div class="card-header">
                            Lista zgłoszeń (od najnowszych)
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0" id="signups-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Imię i Nazwisko Rodzica</th>
                                        <th>E-mail</th>
                                        <th>Imię Dziecka</th>
                                        <th>Wiek</th>
                                        <th>Rodzic uczestniczy?</th>
                                        <th>Data Zapisu</th>
                                        <th>Akcje</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($signups)): ?>
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">Brak zapisów.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($signups as $signup): ?>
                                            <tr id="signup-<?php echo $signup['id']; ?>">
                                                <td><?php echo htmlspecialchars($signup['id']); ?></td>
                                                <td><?php echo htmlspecialchars($signup['parent_name']); ?></td>
                                                <td><?php echo htmlspecialchars($signup['parent_email']); ?></td>
                                                <td><?php echo htmlspecialchars($signup['child_name']); ?></td>
                                                <td><?php echo htmlspecialchars($signup['child_age']); ?></td>
                                                <td>
                                                    <?php if ($signup['parent_participates']): ?>
                                                        <span class="badge bg-success">Tak</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary">Nie</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo date('d.m.Y H:i', strtotime($signup['signup_date'])); ?></td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $signup['id']; ?>">Usuń</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const signupsTableBody = document.querySelector('#signups-table tbody');
    const totalChildrenCountElem = document.getElementById('total-children-count');
    const totalParentsCountElem = document.getElementById('total-parents-count');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const signupId = this.dataset.id;
            const row = document.getElementById(`signup-${signupId}`);

            if (confirm(`Czy na pewno chcesz usunąć wpis o ID: ${signupId}?`)) {
                const formData = new FormData();
                formData.append('id', signupId);

                fetch('api/delete_signup.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        row.remove(); // Usuń wiersz z tabeli
                        // Aktualizuj liczniki
                        // Najprostszy sposób to ponowne pobranie liczników z serwera
                        fetchCounts();
                    } else {
                        alert('Błąd podczas usuwania: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Błąd sieci lub serwera:', error);
                    alert('Wystąpił błąd serwera podczas usuwania. Spróbuj ponownie.');
                });
            }
        });
    });

    // Funkcja do aktualizacji liczników
    function fetchCounts() {
        fetch(window.location.href) // Pobierz dane z bieżącej strony (która jest PHP i zwróci liczniki)
            .then(response => response.text()) // Pobierz jako tekst, bo to cała strona HTML
            .then(html => {
                // Stwórz tymczasowy element DOM, aby sparsować HTML i wyciągnąć liczniki
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTotalChildren = doc.getElementById('total-children-count').innerText;
                const newTotalParents = doc.getElementById('total-parents-count').innerText;

                totalChildrenCountElem.innerText = newTotalChildren;
                totalParentsCountElem.innerText = newTotalParents;
            })
            .catch(error => {
                console.error('Błąd podczas aktualizacji liczników:', error);
            });
    }
});
</script>

<?php include '../footer.php'; ?>
