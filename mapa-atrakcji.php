<?php 
    $pageTitle = "Mapa Ukrytych Skarbów Jury";
    $pageDescription = "Odkryj interaktywną mapę mniej znanych, ale fascynujących atrakcji Jury Krakowsko-Częstochowskiej. Znajdź inspirację na swoją następną przygodę z Jura Quest.";
    $currentPage = basename(__FILE__);
    $isHomePage = false;
    
    // Wczytujemy dane
    $attractions = require 'dane_mapy.php';
    $attractionsJson = json_encode($attractions, JSON_UNESCAPED_UNICODE);

    // Dodajemy specjalne style i skrypty dla tej podstrony
    $extraStyles = '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>';
    $extraScripts = '<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>';

    include 'header.php'; 
?>

<main class="container py-5">
    <header class="text-center mb-5">
        <h1>Mapa Ukrytych Skarbów Jury</h1>
        <p class="lead">Odkryj mniej znane, ale równie fascynujące miejsca, które czekają na Twoją wizytę.</p>
    </header>

    <!-- Sekcja z kafelkami atrakcji -->
    <section id="attractions-grid" class="mb-5">
        <div class="row g-4">
            <?php foreach ($attractions as $attraction): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= htmlspecialchars($attraction['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($attraction['name']) ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($attraction['name']) ?></h5>
                            <p class="card-text text-muted"><?= htmlspecialchars($attraction['short_description']) ?></p>
                            <a href="atrakcja-detale.php?id=<?= htmlspecialchars($attraction['id']) ?>" class="btn btn-outline-primary mt-auto">Dowiedz się więcej</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Sekcja z ogólną mapą -->
    <section id="overview-map-section">
        <h2 class="text-center mb-4">Wszystkie atrakcje na jednej mapie</h2>
        <div id="overview-map" style="height: 500px; width: 100%; border-radius: 15px; border: 1px solid #ddd;"></div>
    </section>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const attractions = <?= $attractionsJson ?>;

        const map = L.map('overview-map').setView([50.58, 19.50], 9);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        attractions.forEach(loc => {
            const popupContent = `<b>${loc.name}</b><br><a href="atrakcja-detale.php?id=${loc.id}">Zobacz szczegóły</a>`;
            L.marker([loc.lat, loc.lon]).addTo(map).bindPopup(popupContent);
        });
    });
</script>

<?php include 'footer.php'; ?>