<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <!-- Favicon -->
    <link rel="shortcut icon" href="/<?= asset("logo/SVG/vetcamp-icon-white.svg") ?>" type="image/x-icon">

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


    <!-- TYPEFACES -->

    <!-- Parkin Sans & Figtree -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">

    <!-- ICONS -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- PASSWORD VISSIBILITY TOGGLE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <title><?= $page_title ?? 'Vetcamp' ?></title>
</head>

<?php if (isset($_SESSION['message'])) { ?>
    <div id='notification' class="notification" onclick="closeModal('notification')">
        <i class="las la-exclamation-circle"></i>
        <p class="notification-content"><?= $_SESSION['message'] ?> </p>
    </div>
<?php unset($_SESSION['message']);
} ?>

<?php if (isset($_SESSION['error'])) { ?>
    <div id='notification' class="notification error" onclick="closeModal('notification')">
        <i class="las la-exclamation-triangle"></i>
        <p class="notification-content"><?= $_SESSION['error'] ?> </p>
    </div>
<?php unset($_SESSION['error']);
} ?>