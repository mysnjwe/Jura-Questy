<?php 
    $pageTitle = "Blog - Jura Quest";
    $pageDescription = "Odkrywaj z nami Jurę! Znajdziesz tu legendy, przewodniki i inspiracje do kolejnych przygód.";
    $currentPage = basename(__FILE__);
    $isHomePage = false;
    $extraStyles = <<<HTML
    <style>
        .page-header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://i0.wp.com/zzjednosc.pl/wp-content/uploads/2021/06/unnamed-3.jpg') no-repeat center center/cover;
            padding: 8rem 0;
            color: white;
        }
        .post-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.07);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .post-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.12);
        }
    </style>
HTML;
    $extraScripts = <<<JS
    <script>
        document.querySelectorAll('.clickable-card').forEach(card => {
            card.addEventListener('click', function() {
                window.location.href = this.dataset.href;
            });
        });
    </script>
JS;
    include 'header.php'; 
?>

    <!-- Nagłówek podstrony -->
    <header class="page-header text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Blog Jura Quest</h1>
            <p class="lead">Odkrywaj z nami Jurę! Znajdziesz tu legendy, przewodniki i inspiracje do kolejnych przygód.</p>
        </div>
    </header>

    <main class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <!-- Wpis 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card post-card h-100 clickable-card" data-href="duchy-demony-potepione-dusze.html">
                        <img src="https://polskazachwyca.pl/wp-content/uploads/2018/01/zamek-rabsztyn-ko%C5%82o-olkusza-olkusz-jura-wy%C5%BCyna-krakowsko-cz%C4%99stochowska-orle-gniazda-szlak-orlich-gniazd-shutterstock_714460285-e1516181205683-1392x928.jpg" class="card-img-top" alt="Zamek na Jurze">
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title">5 najciekawszych legend o zamkach na Jurze</h5>
                            <p class="card-text text-muted">Od białych dam po ukryte skarby - poznaj mrożące krew w żyłach opowieści, które kryją się w murach jurajskich warowni.</p>
                            <a href="duchy-demony-potepione-dusze.html" class="btn btn-outline-primary mt-auto">Czytaj więcej</a>
                        </div>
                    </div>
                </div>
                <!-- Wpis 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card post-card h-100 clickable-card" data-href="skaly-rzedkowickie-przewodnik.html">
                        <img src="https://www.slaskie.travel/uploads/media/default/0010/86/thumb_985355_default_large.jpeg" class="card-img-top" alt="Skały Rzędkowickie">
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title">Skały Rzędkowickie: Przewodnik dla początkujących odkrywców</h5>
                            <p class="card-text text-muted">Planujesz wycieczkę w Rzędkowice? Sprawdź nasz przewodnik po najciekawszych szlakach, formacjach skalnych i punktach widokowych.</p>
                            <a href="skaly-rzedkowickie-przewodnik.html" class="btn btn-outline-primary mt-auto">Czytaj więcej</a>
                        </div>
                    </div>
                </div>
                <!-- Wpis 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card post-card h-100 clickable-card" data-href="wlodowice-w-jeden-dzien.html">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c4/JuDrone_Rynek_Wlodowice_2.jpg/2560px-JuDrone_Rynek_Wlodowice_2.jpg" class="card-img-top" alt="Włodowice">
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title">Włodowice – co warto zobaczyć w jeden dzień?</h5>
                            <p class="card-text text-muted">Pałac, kościół, a może coś więcej? Odkryj z nami uroki miasteczka, które jest punktem startowym jednej z naszych gier.</p>
                            <a href="wlodowice-w-jeden-dzien.html" class="btn btn-outline-primary mt-auto">Czytaj więcej</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include 'footer.php'; ?>