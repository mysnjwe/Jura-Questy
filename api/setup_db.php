<?php

$servername = "localhost";
$username = "srv90026_juraquest_db";
$password = "zaq12wsxz";
$dbname = "srv90026_juraquest_db";

// Utwórz połączenie
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdź połączenie
if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

// SQL do utworzenia tabeli orders
$sql_orders = "CREATE TABLE IF NOT EXISTS orders (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id VARCHAR(255) NOT NULL UNIQUE,
    game_id VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    access_code VARCHAR(255) NOT NULL,
    payment_status VARCHAR(50) NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql_orders) === TRUE) {
    echo "Tabela orders utworzona pomyślnie lub już istnieje.<br>";
} else {
    echo "Błąd podczas tworzenia tabeli orders: " . $conn->error . "<br>";
}

// SQL do utworzenia tabeli game_stats z kolumną score
$sql_game_stats = "CREATE TABLE IF NOT EXISTS game_stats (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    team_name VARCHAR(255) NOT NULL,
    completion_time_seconds INT(11) NOT NULL,
    score INT(11) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql_game_stats) === TRUE) {
    echo "Tabela game_stats utworzona pomyślnie lub już istnieje.<br>";
} else {
    echo "Błąd podczas tworzenia tabeli game_stats: " . $conn->error . "<br>";
}

$conn->close();

?>