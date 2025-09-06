<?php 
    $pageTitle = "Nasze Gry - Jura Quest";
    $pageDescription = "Wybierz swoją przygodę spośród naszych interaktywnych gier terenowych na Jurze.";
    $currentPage = basename(__FILE__);
    $isHomePage = false;
    include 'header.php'; 
?>

<main class="container py-5">
    <header class="text-center mb-5">
        <h1>Nasze Gry</h1>
        <p class="lead">Każda nasza gra to nie tylko wyzwanie, ale podróż w czasie i przestrzeni. Zaprojektowaliśmy je z pasją, abyś mógł odkryć fascynujące historie i zapomniane legendy Jury Krakowsko-Częstochowskiej w sposób, jakiego jeszcze nie znałeś.</p>
    </header>

    <!-- Lista Gier -->
    <section id="all-quests">
        <div class="row g-4 justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card h-100">
                    <img src="images/palac-wlodowice.jpg" class="card-img-top" alt="Przejdź do gry 'Tajemnica Skarbu Warszyckiego', której akcja toczy się w ruinach pałacu we Włodowicach." loading="lazy">
                    <div class="card-body p-4 d-flex flex-column">
                        <h5 class="card-title">Tajemnica Skarbu Warszyckiego</h5>
                        <p class="card-text">Wyrusz śladem legendarnego kasztelana i odkryj sekrety ukryte w ruinach pałacu we Włodowicach.</p>
                        <a href="gra-warszycki.html" class="btn btn-primary mt-auto stretched-link">Rozpocznij przygodę</a>
                    </div>
                </div>
            </div>
            <!-- Tu w przyszłości pojawią się kolejne gry -->
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>