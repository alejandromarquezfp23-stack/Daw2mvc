<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appletito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Daw2mvc/css/header.css">
    <link rel="stylesheet" href="/Daw2mvc/css/footer.css">

    <?php if (isset($css)) : ?>
        <link rel="stylesheet" href="/Daw2mvc/css/<?= $css ?>">
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