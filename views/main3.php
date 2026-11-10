<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'Appletito' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Daw2mvc/css/header.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="/Daw2mvc/css/footer.css">
    <link rel="icon" type="image/png" sizes="32x32" href="/Daw2mvc/iconos/LogoOscuro.png">

    <?php if (isset($css)) : ?>
        <link rel="stylesheet" href="/Daw2mvc/css/<?= $css ?>">
    <?php endif; ?>
</head>

<body>
    <?php
        include __DIR__ . '/header3.php';
    ?>

    <?php include_once $view; ?>

    <?php
        include __DIR__ . '/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if (isset($js)) : ?>
        <script>
            const loginCorrecto = <?= json_encode($loginCorrecto ?? null) ?>;
            const registroCorrecto = <?= json_encode($registroCorrecto ?? null) ?>;
            const mensajeJS = <?= json_encode($mensajeJS ?? null) ?>;
        </script>
        <script src="/Daw2mvc/js/<?= $js ?>"></script>
    <?php endif; ?>
</body>
</html>