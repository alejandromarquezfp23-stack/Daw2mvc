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
                        alt=""
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

        <button class="btn flecha-carrusel flecha-izquierda" type="button" onclick="desplazarProductos(-1)" aria-label="Desplazar productos hacia la izquierda">
            <img src="/Daw2mvc/iconos/icono_flecha_izquierda-removebg-preview.png" alt="">
        </button>

        <div class="d-flex divProductos overflow-auto">

            <?php foreach ($productos as $producto) { ?>

                <?php if ($producto->getCategoriaId() == $categoriaActivaId) { ?>

                    <div class="divProducto mx-3 m-md-3 p-4 rounded-3">
                        <div class="d-flex justify-content-first">
                            <p class="fw-bold precioString">
                                <?= htmlspecialchars((string) $producto->getPrecio()) ?>€
                            </p>
                        </div>

                        <h5 class="fw-bold">
                            <?= htmlspecialchars($producto->getNombre()) ?>
                        </h5>

                        <p>
                            <?= htmlspecialchars($producto->getDescripcion()) ?>
                        </p>

                        <div class="d-flex justify-content-center">
                            <img
                                src="<?= htmlspecialchars($producto->getImagen()) ?>"
                                alt="<?= htmlspecialchars($producto->getNombre(), ENT_QUOTES, 'UTF-8') ?>"
                                class="object-fit-contain w-75"
                            >
                        </div>

                        <div class="d-flex justify-content-end pt-2">
                            <a class="btn btn-primary rounded-pill w-100" href="/Daw2mvc/index.php?controller=detalleProducto&action=index&id=<?= $producto->getId() ?>">
                                Comprar
                            </a>
                        </div>
                    </div>

                <?php } ?>

            <?php } ?>

        </div>

        <button class="btn flecha-carrusel flecha-derecha" type="button" onclick="desplazarProductos(1)" aria-label="Desplazar productos hacia la derecha">
            <img src="/Daw2mvc/iconos/icono_flecha_derecha-removebg-preview.png" alt="">
        </button>
    </div>

    <div class="bannerCarta d-flex flex-column align-items-center justify-content-center text-center pt-5 mt-5 pb-5 mb-5 px-md-4">
        <h1 class="fw-bold text-white mb-4">Algunos de nuestros productos</h1>

        <div class="w-100 d-flex justify-content-center mb-4">
            <img src="<?php echo $productosRandom[0]->getImagen() ?>"
                class="img-fluid w-25 rounded-3"
                alt="<?php echo htmlspecialchars($productosRandom[0]->getNombre(), ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <a class="btn btn-primary rounded-pill w-25"
        href="/Daw2mvc/index.php?controller=detalleProducto&action=index&id=<?= $productosRandom[0]->getId() ?>">
            Comprar
        </a>
    </div>
</div>