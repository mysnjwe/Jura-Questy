<?php 
    $pageTitle = "Cennik - Jura Quest";
    $pageDescription = "Prosty i przejrzysty cennik. Wybierz pakiet idealny dla Twojej ekipy i rozpocznij przygodę bez żadnych ukrytych kosztów.";
    $currentPage = basename(__FILE__);
    $isHomePage = false;
    $extraStyles = <<<HTML
    <style>
        .page-header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://turystycznyninja.pl/wp-content/uploads/2023/10/upload_653942e266c05.jpg') no-repeat center center/cover;
            padding: 8rem 0;
            color: white;
        }
        .pricing-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.07);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 2.5rem;
        }
        .pricing-card.featured {
            transform: scale(1.05);
            border: 2px solid var(--accent-color);
            background-color: var(--light-gray); /* Dodano subtelne tło */
        }
        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.12);
        }
        .price {
            font-size: 3.5rem;
            font-weight: 900;
            color: var(--primary-color);
        }
    </style>
HTML;
    include 'header.php'; 
?>

    <!-- Nagłówek podstrony -->
    <header class="page-header text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Prosty i Przejrzysty Cennik</h1>
            <p class="lead">Wybierz pakiet idealny dla Twojej ekipy i rozpocznij przygodę bez żadnych ukrytych kosztów.</p>
        </div>
    </header>

    <main class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center align-items-center g-4">
                <!-- Pakiet Standardowy -->
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-card text-center featured">
                        <h3 class="mb-3">Drużyna Odkrywców</h3>
                        <p class="text-muted">Idealny dla rodziny lub grupy przyjaciół</p>
                        <div class="price my-4" style="color: var(--secondary-color);">Free!</div>
                        <ul class="list-unstyled text-start">
                            <li class="mb-2"><i class="bi bi-joystick"></i> Dostęp do 1 wybranej gry</li>
                            <li class="mb-2"><i class="bi bi-people-fill"></i> Dla drużyny 2-5 osób</li>
                            <li class="mb-2"><i class="bi bi-hourglass-split"></i> Nielimitowany czas na ukończenie</li>
                            <li class="mb-2"><i class="bi bi-award-fill"></i> Pamiątkowy dyplom online</li>
                            <li class="mb-2"><i class="bi bi-tags-fill"></i> <strong>Użyj kodu: JURAFREE</strong></li>
                        </ul>
                        <a href="aktywacja.html" class="btn btn-primary mt-4 w-100">Aktywuj Teraz za Darmo</a>
                    </div>
                </div>

                <!-- Pakiet dla Firm -->
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-card text-center">
                        <h3 class="mb-3">Integracja Firmowa</h3>
                        <p class="text-muted">Świetny pomysł na teambuilding</p>
                        <div class="price my-4"><i class="bi bi-envelope-paper-heart"></i></div>
                        <ul class="list-unstyled text-start">
                            <li class="mb-2"><i class="bi bi-people-fill"></i> Dostęp dla wielu drużyn</li>
                            <li class="mb-2"><i class="bi bi-trophy-fill"></i> Możliwość rywalizacji na punkty</li>
                            <li class="mb-2"><i class="bi bi-receipt-cutoff"></i> Faktura VAT</li>
                            <li class="mb-2"><i class="bi bi-currency-dollar"></i> Indywidualna wycena</li>
                        </ul>
                        <a href="#" class="btn btn-outline-primary mt-4 w-100">Zapytaj o Ofertę</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include 'footer.php'; ?>