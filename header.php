<!DOCTYPE html>
<html lang="pl">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NKMLRB8F');</script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Ten tytuł będzie dynamicznie ustawiany na każdej podstronie -->
    <title><?php echo $pageTitle; ?> - Jura Quest</title>

    <meta name="description" content="<?php echo $pageDescription; ?>">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Google Fonts (Montserrat, Lato) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@700;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="manifest" href="manifest.json">

    <!-- Tutaj można dodać dodatkowe style dla konkretnych podstron -->
    <?php if (!empty($extraStyles)) { echo $extraStyles; } ?>
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKMLRB8F"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Nawigacja - teraz w jednym miejscu! -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top <?php echo ($isHomePage ? '' : 'navbar-scrolled'); ?>">
        <div class="container">
            <a class="navbar-brand" href="index.php">Jura Quest</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage === 'index.php') echo 'active'; ?>" href="index.php">Strona Główna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage === 'nasze-gry.php') echo 'active'; ?>" href="nasze-gry.php">Nasze Gry</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage === 'tajemnice-jury/') echo 'active'; ?>" href="tajemnice-jury/">Tajemnice Jury</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aktywacja.html">Aktywuj Grę</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage === 'mapa-atrakcji.php') echo 'active'; ?>" href="mapa-atrakcji.php">Mapa Atrakcji</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage === 'cennik.php') echo 'active'; ?>" href="cennik.php">Cennik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage === 'dla-partnerow.php') echo 'active'; ?>" href="dla-partnerow.php">Dla Partnerów</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage === 'blog.php') echo 'active'; ?>" href="blog.php">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage === 'kontakt.php') echo 'active'; ?>" href="kontakt.php">Kontakt</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>