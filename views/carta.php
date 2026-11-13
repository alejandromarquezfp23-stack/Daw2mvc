<div class="div-carta">
    <div class="d-flex flex-column flex-md-row justify-content-between mx-0 mx-md-5">
        <h1 class="text-start text-md-center fw-semibold mx-5 mx-md-5 mt-md-3 display-2">
            Carta
        </h1>
    </div>

    <div class="d-flex flex-wrap flex-md-nowrap justify-content-center mx-0 mx-md-5 mb-md-5 gap-0 gap-md-5">
        <?php foreach ($categorias as $categoria) { ?>
            <div class="col-6 col-md-auto text-center px-md-0 divCategoria">
                <a href="index.php?controller=productos&amp;id=<?= urlencode((string) $categoria->getId()) ?>" class="text-decoration-none text-dark">
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

    <?php foreach ($categorias as $categoria) { ?>
        <?php if ($categoriaActivaId === null || (int) $categoria->getId() === $categoriaActivaId) { ?>
            <section class="categoriaCarta">
                <h2 class="fw-semibold mx-0 mx-md-5 mt-5 mt-md-5 h2-segundo">
                    <?= htmlspecialchars($categoria->getNombre()) ?>.
                    <span class="text-secondary fw-semibold">
                        Elige el plato que más te guste.
                    </span>
                </h2>

                <form method="POST" class="d-flex gap-4 py-md-3 mx-md-5 px-md-5 rounded-pill filtrosCarta">
                    <input type="hidden" name="id" value="<?= $categoriaActivaId ?>">

                    <button type="submit" name="filtroid" value="1"
                        class="btn <?= $filtroActivo === 'id' ? 'btn-dark' : 'btn-outline-dark' ?> rounded-pill px-4"
                        aria-pressed="<?= $filtroActivo === 'id' ? 'true' : 'false' ?>">
                        ID
                    </button>

                    <button type="submit" name="filtronombre" value="2"
                        class="btn <?= $filtroActivo === 'nombre' ? 'btn-dark' : 'btn-outline-dark' ?> rounded-pill px-4"
                        aria-pressed="<?= $filtroActivo === 'nombre' ? 'true' : 'false' ?>">
                        Nombre
                    </button>

                    <button type="submit" name="filtroprecio" value="3"
                        class="btn <?= $filtroActivo === 'precio' ? 'btn-dark' : 'btn-outline-dark' ?> rounded-pill px-4"
                        aria-pressed="<?= $filtroActivo === 'precio' ? 'true' : 'false' ?>">
                        Precio
                    </button>
                </form>

                <div class="d-flex align-items-center carruselProductos">
                    <button class="btn flecha-carrusel flecha-izquierda" type="button" onclick="desplazarProductos(this, -1)" aria-label="Desplazar productos hacia la izquierda">
                        <img src="/Daw2mvc/iconos/icono_flecha_izquierda-removebg-preview.png" alt="">
                    </button>

                    <div class="d-flex divProductos overflow-auto">
                        <?php foreach ($productos as $producto) { ?>
                            <?php if ((int) $producto->getCategoriaId() === (int) $categoria->getId()) { ?>
                                <div class="divProducto mx-3 m-md-3 p-4 rounded-4">
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
                                        <a class="btn btn-primary rounded-3 w-100" href="/Daw2mvc/index.php?controller=productos&amp;action=show&amp;id=<?= urlencode((string) $producto->getId()) ?>">
                                            Añadir al carrito
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>

                    <button class="btn flecha-carrusel flecha-derecha" type="button" onclick="desplazarProductos(this, 1)" aria-label="Desplazar productos hacia la derecha">
                        <img src="/Daw2mvc/iconos/icono_flecha_derecha-removebg-preview.png" alt="">
                    </button>
                </div>
            </section>
        <?php } ?>
    <?php } ?>

    <div class="bannerCarta d-flex flex-column align-items-center justify-content-center text-center pt-5 mt-5 pb-5 mb-5 px-md-4">
        <h1 class="fw-bold text-white mb-4">Algunos de nuestros productos</h1>

        <div class="w-100 d-flex justify-content-center mb-4">
            <img src="<?php echo $productosRandom[0]->getImagen() ?>"
                class="img-fluid w-25 rounded-3"
                alt="<?php echo htmlspecialchars($productosRandom[0]->getNombre(), ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <a class="btn btn-primary rounded-pill w-25"
        href="/Daw2mvc/index.php?controller=productos&amp;action=detalle&amp;id=<?= urlencode((string) $productosRandom[0]->getId()) ?>">
            Comprar
        </a>
    </div>
</div>