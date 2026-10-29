<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appletito - Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Daw2mvc/css/detalleproducto.css">
    <link rel="icon" type="image/png" href="/Daw2mvc/iconos/LogoOscuro.png">
</head>
<body>
    <?php
        include __DIR__ . '/header3.php';

        require_once __DIR__ . '/../config/DataBase.php';
        require_once __DIR__ . '/../models/productos.php';
        require_once __DIR__ . '/../dao/productosDAO.php';
        $productosDAO = new productosDAO(DataBase::connect());
        $productos = $productosDAO->selectAll();
    ?>

    <?php
        include __DIR__ . '/footer.php';
    ?>
</body>
</html>