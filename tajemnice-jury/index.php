<?php 
    $pageTitle = "Tajemnice Jury - Gra Fabularna dla Dzieci";
    $pageDescription = "Zapisz dziecko na darmową grę fabularną 'Tajemnice Jury' we Włodowicach. Projekt sfinansowano ze środków Narodowego Instytutu Wolności.";
    $currentPage = basename(__FILE__);
    $isHomePage = false;
    // Zmieniamy ścieżkę, bo plik jest teraz w podfolderze
    include '../header.php'; 
?>

<style>
    .event-hero-section {
        min-height: 60vh;
        /* Zmieniona ścieżka do obrazka */
        background: url('images/hero-bg.png') no-repeat center center/cover;
        position: relative;
    }
    .event-hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
    }
    .icon-feature {
        font-size: 3rem;
        color: var(--secondary-color);
    }
    .details-table {
        background-color: var(--light-gray);
        border-radius: 10px;
    }
    .details-table td {
        padding: 15px;
        border-bottom: 1px solid #dee2e6;
    }
    .details-table tr:last-child td {
        border-bottom: none;
    }
    .child-entry {
        background-color: #fdfdfd;
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        position: relative;
    }
    .remove-child-btn {
        position: absolute;
        top: 10px;
        right: 10px;
    }
    .sponsors-section {
        background-color: #f8f9fa;
        padding: 4rem 0;
        border-top: 1px solid #dee2e6;
    }
    .sponsors-section img {
        max-height: 60px;
        margin: 15px;
        filter: grayscale(100%);
        transition: filter 0.3s ease;
    }
    .sponsors-section img:hover {
        filter: grayscale(0%);
    }
</style>

<!-- Sekcja Hero -->
<header class="event-hero-section text-white text-center d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Odkryjcie "Tajemnice Jury" – Przygodowa Gra Miejska dla Młodych Odkrywców!</h1>
        <h3 class="fw-bold mt-4" style="color: var(--accent-color);">27 Września 2025</h3>
    </div>
</header>

<main class="container my-5">
    <!-- Sekcja "Czym są Tajemnice Jury?" -->
    <section id="event-description" class="py-5">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h2 class="mb-4">Czym są "Tajemnice Jury"?</h2>
                <p class="lead">Szukasz sposobu, by Twoje dziecko aktywnie spędziło czas, odrywając się od ekranu komputera? Chcesz, aby przez zabawę i przygodę poznało magię miejsca, w którym mieszka? Mamy coś specjalnie dla Was!</p>
                <p>To wyjątkowa, fabularna gra miejska, która zamieni <strong>Włodowice</strong> w planszę pełną zagadek! Uczestnicy, wcielając się w rolę odkrywców, przemierzą trasę prowadzącą przez historyczne zakątki naszej gminy – od zabytkowego kościoła św. Bartłomieja, przez tajemnicze ruiny pałacu, aż po malownicze formacje skalne. Na każdym kroku czekać będą na nich zadania i łamigłówki związane z lokalną historią i przyrodą Jury Krakowsko-Częstochowskiej. To nie jest nudna lekcja historii – to prawdziwa wyprawa po skarby naszej małej ojczyzny!</p>
            </div>
            <div class="col-lg-5 text-center">
                 <!-- Zmieniona ścieżka do obrazka -->
                <img src="images/gra-fabularna.png" class="img-fluid rounded shadow-lg w-75 mx-auto d-block" alt="Ilustracja do gry fabularnej 'Tajemnice Jury'">
            </div>
        </div>
    </section>

    <!-- Pozostałe sekcje bez zmian... -->
    <section id="benefits" class="py-5 bg-light rounded shadow">
        <div class="container text-center">
            <h2 class="mb-5">Co zyska Twoje dziecko?</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3"><i class="bi bi-compass-fill icon-feature"></i></div>
                    <h4>Niezapomnianą Przygodę</h4>
                    <p>Aktywna eksploracja terenu i satysfakcja z rozwiązywania zagadek.</p>
                </div>
                <div class="col-md-3">
                    <div class="mb-3"><i class="bi bi-book-half icon-feature"></i></div>
                    <h4>Nową Wiedzę o Regionie</h4>
                    <p>Poznawanie historii i przyrody "małej ojczyzny" w angażujący sposób.</p>
                </div>
                <div class="col-md-3">
                    <div class="mb-3"><i class="bi bi-people-fill icon-feature"></i></div>
                    <h4>Szansę na Poznanie Rówieśników</h4>
                    <p>Współpraca w grupie i nawiązywanie nowych znajomości.</p>
                </div>
                <div class="col-md-3">
                    <div class="mb-3"><i class="bi bi-patch-check-fill icon-feature"></i></div>
                    <h4>Pamiątkowy Certyfikat</h4>
                    <p>Na mecie każdy uczestnik otrzyma Certyfikat "Młodego Znawcy Jury"!</p>
                </div>
            </div>
        </div>
    </section>

    <section id="details-and-signup" class="py-5">
        <div class="row">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <h2 class="mb-4">Najważniejsze informacje:</h2>
                <div class="details-table p-3">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td class="fw-bold"><i class="bi bi-calendar-event-fill me-2"></i>Data i Godzina:</td>
                                <td>27.09.2025, godz. 10:00 - 14:00</td>
                            </tr>
                            <tr>
                                <td class="fw-bold"><i class="bi bi-geo-alt-fill me-2"></i>Miejsce Startu:</td>
                                <td>Stodoła przy plebanii we Włodowicach</td>
                            </tr>
                            <tr>
                                <td class="fw-bold"><i class="bi bi-person-check-fill me-2"></i>Dla kogo?</td>
                                <td>Dzieci i młodzież w wieku 7-15 lat.</td>
                            </tr>
                            <tr>
                                <td class="fw-bold"><i class="bi bi-person-plus-fill me-2"></i>Młodsze rodzeństwo?</td>
                                <td>Poniżej 7 lat - tylko z aktywnym udziałem opiekuna.</td>
                            </tr>
                            <tr>
                                <td class="fw-bold"><i class="bi bi-cash-coin me-2"></i>Koszt:</td>
                                <td>Udział jest całkowicie darmowy!</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-7">
                <h2 class="mb-3">Zapisz się już dziś!</h2>
                <p class="lead">Nie czekaj, liczba miejsc jest ograniczona! Podaruj swojemu dziecku podróż w czasie po niezwykłej Jurze. Przygoda czeka!</p>
                <div id="form-container" class="mt-4">
                    <form id="event-signup-form" method="POST">
                        <div class="mb-3">
                            <label for="parentName" class="form-label">Imię i nazwisko rodzica/opiekuna</label>
                            <input type="text" class="form-control" id="parentName" name="parentName" required>
                        </div>
                        <div class="mb-3">
                            <label for="parentEmail" class="form-label">Adres e-mail do kontaktu</label>
                            <input type="email" class="form-control" id="parentEmail" name="parentEmail" required>
                        </div>
                        <hr class="my-4">
                        <h6>Dane uczestników</h6>
                        <div id="children-container">
                            <div class="child-entry">
                                <div class="row">
                                    <div class="col-md-7"><div class="mb-3"><label class="form-label">Imię dziecka</label><input type="text" class="form-control" name="childName[]" required></div></div>
                                    <div class="col-md-5"><div class="mb-3"><label class="form-label">Wiek</label><input type="number" class="form-control" name="childAge[]" min="4" max="15" required></div></div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add-child-btn" class="btn btn-outline-secondary btn-sm mb-3">+ Dodaj kolejne dziecko</button>
                        <div class="form-text mb-3">Dla dzieci poniżej 7 lat wymagana jest obecność opiekuna podczas gry.</div>
                        <hr class="my-4">
                        <div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="parent_participates" value="1" id="parentParticipates"><label class="form-check-label" for="parentParticipates"><strong>Biorę udział w grze razem z dzieckiem/dziećmi.</strong></label></div>
                        <div class="form-check mb-3"><input class="form-check-input" type="checkbox" id="privacyPolicy" required><label class="form-check-label" for="privacyPolicy">Wyrażam zgodę na przetwarzanie moich danych osobowych w celu organizacji wydarzenia, zgodnie z <a href="../polityka-prywatnosci.html" target="_blank">polityką prywatności</a>.</label></div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">Zarezerwuj darmowe miejsce!</button>
                    </form>
                </div>
                <div id="form-success-message" class="alert alert-success text-center" style="display: none;">
                    <h4>Dziękujemy za zgłoszenie!</h4>
                    <p>Potwierdzenie zostało wysłane na podany adres e-mail. Do zobaczenia na starcie przygody!</p>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- NOWA SEKCJA ZGODNA Z REGULAMINEM -->
<div class="sponsors-section">
    <div class="container text-center">
        <h4 class="mb-4">Partnerzy i Finansowanie Projektu</h4>
        <p class="lead mb-4">
            „Sfinansowano ze środków Narodowego Instytutu Wolności - Centrum Rozwoju Społeczeństwa Obywatelskiego w ramach Programu NOWEFIO na lata 2021-2030”.
        </p>
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-2 col-md-4 col-6"><img src="images/logos/logo-kdspp.png" alt="Logo Komitetu do Spraw Pożytku Publicznego" class="img-fluid"></div>
            <div class="col-lg-2 col-md-4 col-6"><img src="images/logos/logo-nowefio.png" alt="Logo Programu NOWEFIO" class="img-fluid"></div>
            <div class="col-lg-2 col-md-4 col-6"><img src="images/logos/logo-operatorzy.png" alt="Logo Operatorów Programu - Klaster Innowacji Społecznych i New Europe Foundation" class="img-fluid"></div>
            <div class="col-lg-2 col-md-4 col-6"><img src="images/logos/logo-slaskielokalnie.png" alt="Logo Konkursu Śląskie Lokalnie" class="img-fluid"></div>
            <div class="col-lg-2 col-md-4 col-6"><img src="images/logos/logo-niw.png" alt="Logo Narodowego Instytutu Wolności" class="img-fluid"></div>
        </div>
    </div>
</div>

<?php
// Ścieżka do skryptu w fetch() jest już poprawna, bo jest względna do pliku index.php
$extraScripts = <<<HTML
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('event-signup-form');
    const formContainer = document.getElementById('form-container');
    const successMessage = document.getElementById('form-success-message');
    const addChildBtn = document.getElementById('add-child-btn');
    const childrenContainer = document.getElementById('children-container');

    const childEntryTemplate = childrenContainer.querySelector('.child-entry').cloneNode(true);
    const removeBtnHTML = '<button type="button" class="btn-close remove-child-btn" aria-label="Close"></button>';

    addChildBtn.addEventListener('click', function() {
        const newChildEntry = childEntryTemplate.cloneNode(true);
        newChildEntry.querySelectorAll('input').forEach(input => input.value = '');
        newChildEntry.insertAdjacentHTML('beforeend', removeBtnHTML);
        childrenContainer.appendChild(newChildEntry);
    });

    childrenContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-child-btn')) {
            e.target.closest('.child-entry').remove();
        }
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        fetch('api/handle_event_signup.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                formContainer.style.display = 'none';
                successMessage.style.display = 'block';
            } else {
                alert('Wystąpił błąd: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Wystąpił błąd serwera. Spróbuj ponownie później.');
        });
    });
});
</script>
HTML;
?>

<?php 
    // Zmieniamy ścieżkę, bo plik jest teraz w podfolderze
    include '../footer.php'; 
?>