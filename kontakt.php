<?php 
    $pageTitle = "Kontakt - Jura Quest";
    $pageDescription = "Masz pytania? Napisz do Nas! Jesteśmy tutaj, aby pomóc Ci zaplanować Twoją jurajską przygodę.";
    $currentPage = basename(__FILE__);
    $isHomePage = false;
    $extraStyles = <<<HTML
    <style>
        .page-header {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.pexels.com/photos/3747139/pexels-photo-3747139.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2') no-repeat center center/cover;
            padding: 8rem 0;
            color: white;
        }
        .contact-icon {
            font-size: 2.5rem;
            color: var(--accent-color);
        }
    </style>
HTML;
    include 'header.php'; 
?>

    <!-- Nagłówek podstrony -->
    <header class="page-header text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Masz Pytania? Napisz do Nas!</h1>
            <p class="lead">Jesteśmy tutaj, aby pomóc Ci zaplanować Twoją jurajską przygodę.</p>
        </div>
    </header>

    <main class="py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <h2 class="mb-4">Dane Kontaktowe</h2>
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-center mb-4">
                            <i class="bi bi-envelope-fill contact-icon me-4"></i>
                            <div>
                                <h5>E-mail</h5>
                                <a href="mailto:biuro@juraquest.pl" class="text-decoration-none text-primary">biuro@juraquest.pl</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                            <i class="bi bi-telephone-fill contact-icon me-4"></i>
                            <div>
                                <h5>Telefon</h5>
                                <a href="tel:+48123456789" class="text-decoration-none text-primary">+48 123 456 789</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="bi bi-share-fill contact-icon me-4"></i>
                            <div>
                                <h5>Media Społecznościowe</h5>
                                <a href="#" class="fs-4 text-primary me-2"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="fs-4 text-primary"><i class="bi bi-instagram"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                     <div class="card p-4 p-lg-5 shadow-lg">
                        <h3 class="text-center mb-4">Formularz kontaktowy</h3>
                        <form>
                            <div class="mb-3">
                                <label for="contactName" class="form-label">Twoje imię</label>
                                <input type="text" class="form-control" id="contactName" required>
                            </div>
                            <div class="mb-3">
                                <label for="contactEmail" class="form-label">Adres e-mail</label>
                                <input type="email" class="form-control" id="contactEmail" required>
                            </div>
                            <div class="mb-3">
                                <label for="contactSubject" class="form-label">Temat</label>
                                <input type="text" class="form-control" id="contactSubject" required>
                            </div>
                            <div class="mb-3">
                                <label for="contactMessage" class="form-label">Twoja wiadomość</label>
                                <textarea class="form-control" id="contactMessage" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Wyślij wiadomość</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include 'footer.php'; ?>