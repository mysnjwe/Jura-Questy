<?php 
    $pageTitle = "Odkryj tajemnice Jury. Twoja przygoda czeka.";
    $pageDescription = "Interaktywne gry terenowe na smartfona dla rodzin, przyjaciół i firm na Jurze Krakowsko-Częstochowskiej.";
    $currentPage = basename(__FILE__); // Automatycznie wykrywa nazwę pliku
    $isHomePage = true; // Zmienna do sterowania stylem nawigacji
    include 'header.php'; 
?>

<!-- Sekcja Hero -->
<header class="hero-section text-white text-center d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <h1 class="display-3 fw-bold">Odkryj tajemnice Jury. Twoja przygoda czeka.</h1>
        <p class="lead my-3">Interaktywne gry terenowe na smartfona dla rodzin, przyjaciół i firm.</p>
        <a href="nasze-gry.php" class="btn btn-primary btn-lg">Wybierz Swoją Przygodę</a>
    </div>
</header>

<main>
    <!-- Sekcja "Jak to działa?" -->
    <section id="how-it-works" class="py-5">
        <div class="container text-center">
            <h2 class="mb-5">Jak to działa?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="step">
                        <div class="step-icon mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-map-fill" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.598-.49L10.5.99 5.598.01a.5.5 0 0 0-.196 0l-5 1A.5.5 0 0 0 0 1.5v13a.5.5 0 0 0 .598.49l4.902-.98 4.902.98a.5.5 0 0 0 .196 0l5-1A.5.5 0 0 0 16 14.5zM5 14.09V1.11l4.52.9.53.108V15.1l-4.52-.9L5 14.09zM15 13.1l-4.52.9-.53.108V1.91l4.52-.9.53-.108z"/>
                            </svg>
                        </div>
                        <h3>1. Wybierz Grę</h3>
                        <p>Wybierz i kup dostęp do jednej z naszych fabularnych przygód.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step">
                        <div class="step-icon mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-phone-fill" viewBox="0 0 16 16">
                              <path d="M3 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zm6 11a1 1 0 1 0-2 0 1 1 0 0 0 2 0"/>
                            </svg>
                        </div>
                        <h3>2. Uruchom Grę w Przeglądarce</h3>
                        <p>Uruchom grę bezpośrednio w przeglądarce na swoim smartfonie i wpisz swój kod.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step">
                        <div class="step-icon mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-compass-fill" viewBox="0 0 16 16">
                              <path d="M15.5 8.516a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0m-7.5-4.853a.5.5 0 0 0-.5.5v3.353l-2.165 1.083a.5.5 0 0 0-.22 1.01l4.5 1.5a.5.5 0 0 0 .495-.022l4.5-1.5a.5.5 0 0 0-.22-1.01l-2.165-1.083V4.163a.5.5 0 0 0-.5-.5"/>
                            </svg>
                        </div>
                        <h3>3. Ruszaj na Szlak!</h3>
                        <p>Podążaj za wskazówkami GPS, rozwiązuj zagadki i odkrywaj skarby Jury.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sekcja "Polecane Questy" -->
    <section id="featured-quests" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Polecane Questy</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/0/0c/JuDrone_Palac_Wlodowice.jpg" class="card-img-top" alt="Ruiny pałacu we Włodowicach">
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title">Tajemnica Skarbu Warszyckiego</h5>
                            <p class="card-text">Wyrusz śladem legendarnego kasztelana i odkryj sekrety ukryte w ruinach pałacu we Włodowicach.</p>
                            <a href="gra-warszycki.html" class="btn btn-outline-primary mt-auto">Dowiedz się więcej</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <img src="https://www.orlegniazda.pl/Media/Default/.MainStorage/Poi/sw1vpa14.deb/Wlo_12j-CF065897-02%20%E2%80%94%20kopia.jpg" class="card-img-top" alt="Ruiny pałacu we Włodowicach">
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title">Dziedzictwo Dwóch Panów: Rzędkowicka Misja</h5>
                            <p class="card-text">Zmierz się z legendą, odnajdź scytyjską strzałę i zdecyduj o losach jurajskiej krainy.</p>
                            <a href="gra-rzedkowice-ukryta.html" class="btn btn-outline-primary mt-auto">Dowiedz się więcej</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!-- Sekcja "Dla Kogo" -->
    <section id="for-whom" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Dla Kogo Jest Jura Quest?</h2>
            <div class="row text-center">
                <div class="col-lg-4">
                    <img src="https://media.istockphoto.com/id/1447123729/pl/zdj%C4%99cie/rodzina-matka-i-ojciec-z-dzieckiem-na-wakacje-wakacje-i-bycie-szcz%C4%99%C5%9Bliwym-razem-na-%C5%9Bwie%C5%BCym.jpg?s=612x612&w=0&k=20&c=WadkO0pOb6WRRhsxfVdV06pTn3ceXE0pjFBtiBlX6vI=" class="rounded-circle mb-3" width="180" height="180" alt="Rodzina na szlaku" style="object-fit: cover;">
                    <h3>Dla Rodzin</h3>
                    <p>Niezapomniana zabawa i edukacja na świeżym powietrzu.</p>
                </div>
                <div class="col-lg-4">
                    <img src="https://img.myloview.pl/fototapety/grupa-przyjaciol-dobra-zabawa-700-119435899.jpg" class="rounded-circle mb-3" width="180" height="180" alt="Grupa przyjaciół" style="object-fit: cover;">
                    <h3>Dla Grup Przyjaciół</h3>
                    <p>Sprawdźcie się w terenie i przeżyjcie wspólną przygodę.</p>
                </div>
                <div class="col-lg-4">
                    <img src="https://images.pexels.com/photos/3184418/pexels-photo-3184418.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="rounded-circle mb-3" width="180" height="180" alt="Zespół firmowy" style="object-fit: cover;">
                    <h3>Dla Firm</h3>
                    <p>Oryginalny pomysł na integrację i teambuilding.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sekcja "Opinie" -->
    <section id="testimonials" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Opinie Naszych Odkrywców</h2>
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="testimonial-card text-center">
                            <p class="lead">"Świetna zabawa! Dzieciaki były zachwycone, a i my, dorośli, nauczyliśmy się czegoś nowego o okolicy. Polecamy!"</p>
                            <p><strong>- Anna K. z rodziną</strong></p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="testimonial-card text-center">
                            <p class="lead">"Genialny sposób na spędzenie weekendu ze znajomymi. Zagadki były wymagające, ale satysfakcja z ich rozwiązania ogromna!"</p>
                            <p><strong>- Tomasz P.</strong></p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Finalne Wezwanie do Działania -->
    <section id="final-cta" class="py-5 text-white text-center">
        <div class="container">
            <h2 class="display-5">Gotowy na przygodę życia?</h2>
            <p class="lead">Wybierz swój Quest już dziś!</p>
            <a href="#" class="btn btn-primary btn-lg mt-3">Zobacz Nasze Gry</a>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>