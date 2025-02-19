<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- SEO Meta Tags -->
    <meta name="description"
          content="Vetcamp - El campamento donde aprendes divirtiéndote y compartiendo con colegas de la profesión.">
    <meta name="keywords"
          content="vetcamp, campamento verano, campamento veterinario, campamento upra, upra vetcamp, vet camp, upra camp, veterinaria, veterinarios, puerto rico, veterinaria puerto rico">
    <meta name="author" content="Universidad de Puerto Rico, Arecibo">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags (for social media sharing) -->
    <meta property="og:title" content="<?= $page_title ?? 'Vetcamp' ?>">
    <meta property="og:description"
          content="Vetcamp - El campamento donde aprendes divirtiéndote y compartiendo con colegas de la profesión.">
    <meta property="og:image" content="/<?= asset('seo_banner.png') ?>">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $page_title ?? 'Vetcamp' ?>">
    <meta name="twitter:description"
          content="Vetcamp - El campamento donde aprendes divirtiéndote y compartiendo con colegas de la profesión.">
    <meta name="twitter:image" content="/<?= asset('seo_banner.png') ?>">

    <!-- Favicon -->
    <link rel="icon" href="/<?= asset("icon.svg") ?>" type="image/x-icon">

    <!-- CSS -->

    <link rel="stylesheet" href="<?= web_resource("css/main.css") ?>">

    <!-- JAVASCRIPT -->
    <script src="<?= web_resource("js/homeCarrousel.js") ?>"></script>
    <script src="<?= web_resource("js/fileupload.js") ?>"></script>
    <script src="<?= web_resource("js/modals.js") ?>"></script>
    <script src="<?= web_resource("js/dropdowns.js") ?>"></script>
    <script src="<?= web_resource("js/passwordShow.js") ?>"></script>
    <script src="<?= web_resource("js/backendDashboard.js") ?>"></script>
    <script src="<?= web_resource("js/backendSidebar.js") ?>"></script>
    <script src="<?= web_resource("js/contextMenu.js") ?>"></script>
    <script src="<?= web_resource("js/holdPost.js") ?>"></script>
    <script src="<?= web_resource("js/notifications.js") ?>"></script>


    <!-- TYPEFACES -->

    <!-- Parkin Sans & Figtree -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Parkinsans:wght@300..800&display=swap"
          rel="stylesheet">

    <!-- ICONS -->
    <link rel="stylesheet"
          href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- PASSWORD VISSIBILITY TOGGLE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <title><?= $page_title ?? 'Vetcamp' ?></title>
</head>

<?php if (isset($_SESSION['message'])) { ?>
    <div id='notification' class="notification" onclick="closeModal('notification')">
        <div class="notification-content">
            <i class="fas fa-exclamation-circle"></i>
            <p class="notification-content"><?= $_SESSION['message'] ?> </p>
        </div>
        <span class="notification-progress"></span>
    </div>
    <?php unset($_SESSION['message']);
} ?>

<?php if (isset($_SESSION['error'])) { ?>
    <div id='notification' class="notification error" onclick="closeModal('notification')">
        <div class="notification-content">
            <i class="fas fa-exclamation-triangle"></i>
            <p class="notification-content"><?= $_SESSION['error'] ?> </p>
        </div>
        <span class="notification-progress"></span>
    </div>
    <?php unset($_SESSION['error']);
} ?>

<!-- beta warning -->
<div class="lower-disclaimer">
    <div class="minicon">
        <img src="/<?= asset("logo/SVG/vetcamp-icon-yellow.svg") ?>" alt="vet-icon">
        <p class="alert-text">!</p>
    </div>
    <p class="noprint">
        Vetcamp se encuentra en desarrollo,
    </p>
    <a target="_blank" style="color: white;" class=" no-deco-action" href="https://forms.gle/vh4v4ryUXCHvAVos8">déjanos
        saber <i style="color: white;" class="fas fa-external-link-alt"></i></a>
    <p>si presentas algún error con la web.</p>
</div>