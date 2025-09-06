<?php
// router.php

// --- BARDZIEJ NIEZAWODNE LOGOWANIE ---
// Funkcja do zapisywania logów w pliku router.log
function write_log($message) {
    // file_put_contents z flagą FILE_APPEND dopisuje na końcu pliku
    // PHP_EOL dodaje znak nowej linii
    file_put_contents('router.log', date('[Y-m-d H:i:s] ') . $message . PHP_EOL, FILE_APPEND);
}

// Czyszczenie pliku logu przy starcie serwera (opcjonalne, ale pomocne)
if (!isset($_SERVER['ROUTER_INITIALIZED'])) {
    file_put_contents('router.log', '');
    $_SERVER['ROUTER_INITIALIZED'] = true;
}
// -----------------------------------------


// Ustawienie nagłówków CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Obsługa żądania preflight OPTIONS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    write_log("Received OPTIONS preflight request. Responding with 200 OK.");
    exit(0);
}

$request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];
$remote_addr = $_SERVER['REMOTE_ADDR'];

// Logowanie każdego żądania do pliku
write_log("--- NEW REQUEST ---");
write_log("URI: " . $request_uri);
write_log("METHOD: " . $request_method);
write_log("FROM: " . $remote_addr);

// Jeśli to POST, zaloguj również ciało żądania
if ($request_method === 'POST') {
    $body = file_get_contents('php://input');
    write_log("BODY: " . $body);
}


// Sprawdzenie, czy żądanie dotyczy skryptu verify_code.php
if (preg_match('#^/verify_code\.php#', $request_uri)) {
    write_log("Action: Matched /verify_code.php. Forwarding to backend/verify_code.php");
    chdir('backend');
    require_once 'verify_code.php';
    return;
}

// Sprawdzenie, czy żądanie dotyczy skryptu phpinfo.php
if ($request_uri === '/phpinfo.php') {
    write_log("Action: Matched /phpinfo.php. Executing phpinfo().");
    require_once 'phpinfo.php';
    return;
}

// Dla wszystkich innych żądań
write_log("Action: No match. Letting built-in server handle the file.");
return false;