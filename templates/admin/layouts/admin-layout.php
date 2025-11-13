<?php
// File: templates/admin/layouts/admin-layout.php
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle ?? 'Dashboard'); ?> - Admin PKU</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://cdn.jsdelivr.net/gh/creativetimofficial/material-dashboard@main/assets/css/material-dashboard.css"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/css/coreui.min.css" rel="stylesheet"
        integrity="sha384-PDUiPu3vDllMfrUHnurV430Qg8chPZTNhY8RUpq89lq22R3PzypXQifBpcpE1eoB" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>favicon.png">
    <link href="<?php echo BASE_URL; ?>/assets/css/main.css" rel="stylesheet">
</head>

<body class="bg-gray-100 d-flex">

    <?php include __DIR__ . '/../partials/sidebar.php'; ?>
    <section class="overlay"></section>
    <div class="wrapper flex-grow-1 min-vh-100 d-flex flex-column">

        <?php include __DIR__ . '/../partials/navbar.php'; ?>

        <main class="flex-grow-1 container-fluid py-4">
            <?php include __DIR__ . '/../../' . $contentView; ?>
        </main>

    </div>
    <script>
    const navBar = document.querySelector("nav"),
        menuBtns = document.querySelectorAll(".menu-icon"),
        overlay = document.querySelector(".overlay");

    menuBtns.forEach((menuBtn) => {
        menuBtn.addEventListener("click", () => {
            navBar.classList.toggle("open");
        });
    });

    overlay.addEventListener("click", () => {
        navBar.classList.remove("open");
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/gh/creativetimofficial/material-dashboard@main/assets/js/material-dashboard.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/js/coreui.min.js"
        integrity="sha384-Rj9po7KQz8y0hVoeRgl1LRoQcxYkHxszkpKUdatY+9b5o35FsiENOwOWwxzWfAfF" crossorigin="anonymous">
    </script>
</body>

</html>
<style>
.object-fit-cover {
    object-fit: cover;
}
</style>