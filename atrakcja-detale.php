<?php
// Wczytaj wszystkie atrakcje
$all_attractions = require 'dane_mapy.php';
$attraction = null;

// Znajdź konkretną atrakcję na podstawie ID z adresu URL
if (isset($_GET['id'])) {
    foreach ($all_attractions as $item) {
        if ($item['id'] === $_GET['id']) {
            $attraction = $item;
            break;
        }
    }
}

// Jeśli nie znaleziono atrakcji, przekieruj lub pokaż błąd
if ($attraction === null) {
    header("HTTP/1.0 404 Not Found");
    // Możesz tu dołączyć plik 404.php lub wyświetlić prosty komunikat
    echo "<h1>404 - Atrakcja nie została znaleziona</h1>";
    exit;
}

// Ustawienia dla strony
$pageTitle = htmlspecialchars($attraction['name']);
$pageDescription = htmlspecialchars($attraction['short_description']);
$currentPage = 'mapa-atrakcji.php'; // Aby podświetlić poprawną pozycję w menu
$isHomePage = false;

// Dodajemy specjalne style i skrypty
$extraStyles = '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>';
$extraScripts = '<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>';

include 'header.php';
?>

<main class="container py-5">
    <div class="row gx-lg-5">
        <!-- Kolumna z treścią -->
        <div class="col-lg-7">
            <article>
                <img src="<?= htmlspecialchars($attraction['image']) ?>" class="img-fluid rounded mb-4" alt="<?= htmlspecialchars($attraction['name']) ?>">
                <?= $attraction['full_content'] // Pełna treść z tagami HTML ?>
            </article>
            <a href="mapa-atrakcji.php" class="btn btn-secondary mt-4"><i class="bi bi-arrow-left"></i> Powrót do mapy</a>
        </div>

        <!-- Kolumna z mapą -->
        <div class="col-lg-5">
            <div style="position: sticky; top: 100px;">
                <h3>Lokalizacja na mapie</h3>
                <div id="detail-map" style="height: 400px; width: 100%; border-radius: 15px; border: 1px solid #ddd;"></div>
                <a href="https://www.google.com/maps/dir/?api=1&destination=<?= $attraction['lat'] ?>,<?= $attraction['lon'] ?>" class="btn btn-success mt-3 w-100" target="_blank">
                    <i class="bi bi-geo-alt-fill"></i> Prowadź do celu (Google Maps)
                </a>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lat = <?= $attraction['lat'] ?>;
        const lon = <?= $attraction['lon'] ?>;
        const name = "<?= htmlspecialchars($attraction['name'], ENT_QUOTES) ?>";

        const map = L.map('detail-map').setView([lat, lon], 14);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([lat, lon]).addTo(map).bindPopup(`<b>${name}</b>`).openPopup();
    });
</script>

<?php include 'footer.php'; ?>