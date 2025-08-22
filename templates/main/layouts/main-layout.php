<?php
// File: templates/main/layouts/main-layout.php
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-g">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo htmlspecialchars($pageTitle ?? 'Medilab Website'); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($metaDescription ?? ''); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($metaKeywords ?? ''); ?>">

    <link href="<?php echo BASE_URL; ?>/assets/img/favicon.png" rel="icon">
    <link href="<?php echo BASE_URL; ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" type="text/css">
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="<?php echo BASE_URL; ?>/assets/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"
        type="text/css">
    <link href="<?php echo BASE_URL; ?>/assets/css/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"
        type="text/css">
    <link href="<?php echo BASE_URL; ?>/assets/css/vendor/aos/aos.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>/assets/css/vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link href="<?php echo BASE_URL; ?>/assets/css/vendor/glightbox/css/glightbox.min.css" rel="stylesheet"
        type="text/css">
    <link href="<?php echo BASE_URL; ?>/assets/css/vendor/swiper/swiper-bundle.min.css" rel="stylesheet"
        type="text/css">

    <link href="<?php echo BASE_URL; ?>/assets/css/main.css" rel="stylesheet" type="text/css">

</head>

<body class="index-page">

    <?php
    // Menggantikan @include('main.layout.navbar')
    // Path ini menunjuk ke file partials dari lokasi layout ini
    include __DIR__ . '/../partials/navbar.php';
    ?>

    <main class="main">
        <?php
        // Menggantikan @yield('content')
        // Ini akan memuat file konten spesifik yang path-nya didefinisikan dalam variabel $contentView
        include __DIR__ . '/../../' . $contentView;
        ?>
    </main>

    <?php
    // Menggantikan @include('main.layout.footer')
    include __DIR__ . '/../partials/footer.php';
    ?>

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <script src="<?php echo BASE_URL; ?>/assets/css/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/assets/css/vendor/php-email-form/validate.js"></script>
    <script src="<?php echo BASE_URL; ?>/assets/css/vendor/aos/aos.js"></script>
    <script src="<?php echo BASE_URL; ?>/assets/css/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/assets/css/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?php echo BASE_URL; ?>/assets/css/vendor/swiper/swiper-bundle.min.js"></script>

    <script src="<?php echo BASE_URL; ?>/assets/js/main.js"></script>
</body>

</html>