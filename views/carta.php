<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appletito - Carta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Daw2mvc/css/carta.css?v=<?= time() ?>">
    <link rel="icon" type="image/png" href="/Daw2mvc/iconos/LogoOscuro.png">
    <script src="/Daw2mvc/js/carta.js" defer></script>
</head>

<body>
    <?php
        include __DIR__ . '/header.php';
        require_once __DIR__ . '/../controllers/cartaController.php';
    ?>

    <div class="div-carta">

        <div class="d-flex flex-column flex-md-row justify-content-between mx-0 mx-md-5">
            <h1 class="text-start text-md-center fw-semibold mx-5 mx-md-5 mt-3 mt-md-5 mb-3 mb-md-5 display-2">
                Carta
            </h1>
        </div>

        <div class="d-flex flex-wrap flex-md-nowrap justify-content-center mx-0 mx-md-5 mb-md-5 gap-0 gap-md-5">

            <?php foreach ($categorias as $categoria) { ?>

                <div class="col-6 col-md-auto text-center px-md-0 divCategoria">
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

            <h2 class="fw-semibold mx-0 mx-md-5 mt-4 mt-md-5 mb-4 mb-md-5 h2-segundo">
                <?= htmlspecialchars($nombreCategoria) ?>.
                <span class="text-secondary fw-semibold">
                    Elige el plato que más te guste.
                </span>
            </h2>

        <?php } ?>

        <div class="d-flex align-items-center">

            <button class="btn flecha-carrusel flecha-izquierda" type="button" onclick="desplazarProductos(-1)">
                <img src="/Daw2mvc/iconos/icono_flecha_izquierda-removebg-preview.png" alt="Flecha izquierda">
            </button>

            <div class="d-flex divProductos overflow-auto">

                <?php foreach ($productos as $producto) { ?>

                    <?php if ($producto->getCategoriaId() == $categoriaActivaId) { ?>

                        <div class="divProducto mx-3 m-md-4 p-4 rounded-3">

                            <h5 class="fw-bold mt-2">
                                <?= htmlspecialchars($producto->getNombre()) ?>
                            </h5>

                            <p class="mt-2">
                                <?= htmlspecialchars($producto->getDescripcion()) ?>
                            </p>

                            <div class="ratio ratio-3x2 mx-auto w-100">
                                <img
                                    src="<?= htmlspecialchars($producto->getImagen()) ?>"
                                    alt="<?= htmlspecialchars($producto->getNombre()) ?>"
                                    class="object-fit-contain"
                                >
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-5 mt-4">
                                <p class="fw-bold">
                                    <?= htmlspecialchars((string) $producto->getPrecio()) ?>€
                                </p>
                                <a class="btn btn-primary rounded-pill" href="/Daw2mvc/index.php?controller=detalleProducto&action=index&id=<?= $producto->getId() ?>">
                                    Comprar
                                </a>
                            </div>
                        </div>

                    <?php } ?>

                <?php } ?>

            </div>

            <button class="btn flecha-carrusel flecha-derecha" type="button" onclick="desplazarProductos(1)">
                <img src="/Daw2mvc/iconos/icono_flecha_derecha-removebg-preview.png" alt="Flecha derecha">
            </button>

        </div>

    </div>

    <div class="footer">
        <?php include __DIR__ . '/footer.php'; ?>
    </div>
</body>
</html>