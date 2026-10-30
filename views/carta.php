
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appletito - Carta</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Daw2mvc/css/carta.css">
    <link rel="icon" type="image/png" href="/Daw2mvc/iconos/LogoOscuro.png">
</head>

<body>
    <?php
        include __DIR__ . '/header.php';
        require_once __DIR__ . '/../controllers/cartaController.php';
    ?>

    <div class="mt-1 container-fluid div-carta">

        <div class="d-flex justify-content-between mx-5">
            <h1 class="text-center fw-semibold mx-5 mt-5 mb-5 display-2">
                Carta
            </h1>

            <h2 class="text-end fw-semibold mx-5 mt-5 mb-5 h2-primero">
                La mejor forma de elegir tus platos
            </h2>
        </div>

        <div class="d-flex justify-content-center mx-5 mb-5 mt-5 gap-5">
            <?php foreach ($categorias as $categoria) { ?>

                <div class="text-center">
                    <a href="index.php?controller=carta&id=<?php echo $categoria->getId(); ?>" class="text-decoration-none text-dark">

                        <img
                            src="<?= htmlspecialchars($categoria->getImagenes()) ?>"
                            alt="<?= htmlspecialchars($categoria->getNombre()) ?>"
                            style="width: 125px; height: 125px; object-fit: contain;"
                        >

                        <p class="fw-bold mt-2">
                            <?= htmlspecialchars($categoria->getNombre()) ?>
                        </p>

                    </a>
                </div>
            <?php } ?>
        </div>

        <?php if ($nombreCategoria !== '') { ?>

            <h2 class="fw-semibold mx-5 mt-5 mb-5 h2-segundo">
                <?= htmlspecialchars($nombreCategoria) ?>.
                <span class="text-secondary fw-semibold">
                    Elige el plato que más te guste.
                </span>
            </h2>

        <?php } ?>

        <div class="d-flex divProductos">

            <?php foreach ($productos as $producto) { ?>

                <?php if ($producto->getCategoriaId() == $categoriaActivaId) { ?>

                    <div class="divProducto m-5">

                        <h5 class="fw-bold mt-2">
                            <?= htmlspecialchars($producto->getNombre()) ?>
                        </h5>

                        <p class="mt-2">
                            <?= htmlspecialchars($producto->getDescripcion()) ?>
                        </p>

                        <img
                            src="<?= htmlspecialchars($producto->getImagen()) ?>"
                            alt="<?= htmlspecialchars($producto->getNombre()) ?>"
                            style="width: 300px; height: 200px; object-fit: contain;"
                            class="d-block mx-auto"
                        >

                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary rounded-pill m-3" onclick="window.location.href='/Daw2mvc/index.php?controller=detalleProducto&action=index&id=<?php echo $producto->getId(); ?>'">Comprar</button>
                        </div>

                        <p class="m-1">
                            <?= htmlspecialchars((string) $producto->getPrecio()) ?>€
                        </p>

                    </div>

                <?php } ?>

            <?php } ?>

        </div>

    </div>

    <div class="footer">
        <?php include __DIR__ . '/footer.php'; ?>
    </div>

</body>
</html>