<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'Appletito' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= url ?>css/header.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="<?= url ?>css/footer.css">
    <link rel="icon" type="image/svg+xml" href="<?= url ?>iconos/LogoClaro.svg">

    <?php if (isset($css)) : ?>
        <link rel="stylesheet" href="<?= url ?>css/<?= $css ?>">
    <?php endif; ?>

    <?php if (isset($js)) : ?>
        <script src="<?= url ?>js/<?= $js ?>"></script>
    <?php endif; ?>
</head>

<body>
    <?php
        include __DIR__ . '/header2.php';
    ?>

    <?php include_once $view; ?>

    <?php
        include __DIR__ . '/footer.php';
    ?>
</body>
</html>