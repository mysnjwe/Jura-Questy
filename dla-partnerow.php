<?php 
    $pageTitle = "Dla Partnerów - Jura Quest";
    $pageDescription = "Zarabiaj na turystyce i wzbogać ofertę dla swoich gości o niezapomnianą przygodę.";
    $currentPage = basename(__FILE__);
    $isHomePage = false;
    $extraStyles = <<<HTML
    <style>
        .page-header {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2') no-repeat center center/cover;
            padding: 8rem 0;
            color: white;
        }
        .benefit-icon {
            font-size: 3rem;
            color: var(--accent-color);
        }
    </style>
HTML;
    include 'header.php'; 
?>

    <!-- Nagłówek podstrony -->
    <header class="page-header text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Zostań Partnerem Jura Quest</h1>
            <p class="lead">Zarabiaj na turystyce i wzbogać ofertę dla swoich gości o niezapomnianą przygodę.</p>
        </div>
    </header>

    <main class="py-5">
        <div class="container">
            <div class="row align-items-center gx-lg-5">
                <div class="col-lg-6">
                    <h2 class="mb-4">Dlaczego warto z nami współpracować?</h2>
                    <p class="lead">Prowadzisz hotel, pensjonat, agroturystykę lub restaurację na Jurze? Nasze gry terenowe to idealny sposób na uatrakcyjnienie pobytu Twoich gości i wygenerowanie dodatkowego przychodu.</p>
                    <div class="d-flex align-items-start my-4">
                        <i class="bi bi-graph-up-arrow benefit-icon me-4"></i>
                        <div>
                            <h5>Zwiększ atrakcyjność swojej oferty</h5>
                            <p>Zaproponuj gościom gotowy, innowacyjny sposób na spędzenie wolnego czasu, bez żadnych inwestycji z Twojej strony.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start my-4">
                        <i class="bi bi-cash-coin benefit-icon me-4"></i>
                        <div>
                            <h5>Zarabiaj na każdej sprzedanej grze</h5>
                            <p>Otrzymuj atrakcyjną prowizję od każdego kodu dostępu sprzedanego Twoim gościom. To prosty sposób na dodatkowy zysk.</p>
                        </div>
                    </div>
                     <div class="d-flex align-items-start my-4">
                        <i class="bi bi-star-fill benefit-icon me-4"></i>
                        <div>
                            <h5>Wyróżnij się na tle konkurencji</h5>
                            <p>Pokaż, że dbasz o kompleksową obsługę i oferujesz więcej niż tylko nocleg. Pozytywne opinie gwarantowane!</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="card p-4 p-lg-5 shadow-lg">
                        <h3 class="text-center mb-4">Porozmawiajmy o współpracy</h3>
                        <form>
                            <div class="mb-3">
                                <label for="partnerName" class="form-label">Twoje imię i nazwisko</label>
                                <input type="text" class="form-control" id="partnerName" required>
                            </div>
                            <div class="mb-3">
                                <label for="partnerBusiness" class="form-label">Nazwa obiektu / firmy</label>
                                <input type="text" class="form-control" id="partnerBusiness" required>
                            </div>
                            <div class="mb-3">
                                <label for="partnerEmail" class="form-label">Adres e-mail</label>
                                <input type="email" class="form-control" id="partnerEmail" required>
                            </div>
                            <div class="mb-3">
                                <label for="partnerMessage" class="form-label">Wiadomość (opcjonalnie)</label>
                                <textarea class="form-control" id="partnerMessage" rows="4"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Wyślij zapytanie</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include 'footer.php'; ?>