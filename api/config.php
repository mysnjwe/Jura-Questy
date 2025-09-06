<?php
// === OSTATECZNA KONFIGURACJA PRODUKCYJNA ===

// Przełącznik na tryb produkcyjny
define('P24_SANDBOX', false);

// Dane Twojego konta Przelewy24 - PRODUKCYJNE
define('P24_MERCHANT_ID', '352184');
define('P24_POS_ID', '352184');
define('P24_CRC_KEY', '5d0f8ff414160baa');
define('P24_API_KEY', '9e1ce94c3a205442a99a7a618c423630');

// Adresy URL Przelewy24
if (P24_SANDBOX) {
    define('P24_URL', 'https://sandbox.przelewy24.pl/');
} else {
    define('P24_URL', 'https://secure.przelewy24.pl/');
}

// Ustawienia e-mail
define('SMTP_HOST', 'h61.seohost.pl');
define('SMTP_USERNAME', 'kontakt@juraquest.pl');
define('SMTP_PASSWORD', 'kygrab-0dymca-cIhjeq');
define('SMTP_PORT', 465);
define('SMTP_FROM_EMAIL', 'no-reply@juraquest.pl');
define('SMTP_FROM_NAME', 'Jura Quest');

?>