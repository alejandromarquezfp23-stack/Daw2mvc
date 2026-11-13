<div class="container-fluid mt-1 text-white banner">
    <h1 class="text-center fw-bold titulos-h1">Nuestro producto más vendido</h1>
    <h3 class="text-center"><?php echo $productoMasPedido->getNombre() ?></h3>
    <p class="text-center text-secondary"><?php echo $productoMasPedido->getDescripcion() ?></p>
    <div class="d-flex justify-content-center gap-3 mt-4">
        <a href="/Daw2mvc/index.php?controller=productos&action=show&id=<?= $productoMasPedido->getId() ?>" class="btn btn-primary rounded-pill px-4">Más información</a>
        <a href="/Daw2mvc/index.php?controller=productos&action=show&id=<?= $productoMasPedido->getId() ?>" class="btn btn-outline-primary rounded-pill px-4">Comprar</a>
    </div>
    <img src="<?php echo $productoMasPedido->getImagen() ?>" alt="<?php echo htmlspecialchars($productoMasPedido->getNombre(), ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid mx-auto d-block mt-4 w-25">
</div>

<div class="container-fluid mt-1 banner2">
    <h1 class="text-center fw-bold titulos-h1">Otros de nuestros éxitos</h1>
    <h3 class="text-center"><?php echo $productosRandom[1]->getNombre() ?></h3>
    <p class="text-center text-secondary"><?php echo $productosRandom[1]->getDescripcion() ?></p>
    <div class="d-flex justify-content-center gap-3 mt-4">
        <a href="/Daw2mvc/index.php?controller=productos&action=show&id=<?= $productosRandom[1]->getId() ?>" class="btn btn-primary rounded-pill px-4">Más información</a>
        <a href="/Daw2mvc/index.php?controller=productos&action=show&id=<?= $productosRandom[1]->getId() ?>" class="btn btn-outline-primary rounded-pill px-4">Comprar</a>
    </div>
    <img src="<?php echo $productosRandom[1]->getImagen() ?>" alt="<?php echo htmlspecialchars($productosRandom[1]->getNombre(), ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid mx-auto w-25 d-block mt-4">
</div>

<div class="container-fluid mt-1 banner3">
    <h1 class="text-center fw-bold titulos-h1">Otros de nuestros éxitos</h1>
    <h3 class="text-center"><?php echo $productosRandom[2]->getNombre() ?></h3>
    <p class="text-center text-secondary"><?php echo $productosRandom[2]->getDescripcion() ?></p>
    <div class="d-flex justify-content-center gap-3 mt-4">
        <a href="/Daw2mvc/index.php?controller=productos&action=show&id=<?= $productosRandom[2]->getId() ?>" class="btn btn-primary rounded-pill px-4">Más información</a>
        <a href="/Daw2mvc/index.php?controller=productos&action=show&id=<?= $productosRandom[2]->getId() ?>" class="btn btn-outline-primary rounded-pill px-4">Comprar</a>
    </div>
    <img src="<?php echo $productosRandom[2]->getImagen() ?>" alt="<?php echo htmlspecialchars($productosRandom[2]->getNombre(), ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid mx-auto w-25 d-block mt-4">
</div>

<div class="container-fluid d-flex flex-column flex-md-row justify-content-center gap-3 mt-3 text-white">
    <div class="contenedores2 container-fluid mb-3 p-5 rounded-3">
        <h2 class="text-center fw-bold titulos-h1"><?php echo $productosRandom[3]->getNombre() ?></h2>
        <p class="text-center text-secondary"><?php echo $productosRandom[3]->getDescripcion() ?></p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="/Daw2mvc/index.php?controller=productos&action=show&id=<?= $productosRandom[3]->getId() ?>" class="btn btn-primary rounded-pill px-3">Más información</a>
            <a href="/Daw2mvc/index.php?controller=productos&action=show&id=<?= $productosRandom[3]->getId() ?>" class="btn btn-outline-primary rounded-pill px-3">Comprar</a>
        </div>
        <img src="<?php echo $productosRandom[3]->getImagen() ?>" alt="<?php echo htmlspecialchars($productosRandom[3]->getNombre(), ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid mx-auto w-50 d-block mt-4 rounded-2">
    </div>

    <div class="contenedores2 container-fluid mb-3 p-5 rounded-3">
        <h2 class="text-center fw-bold titulos-h1"><?php echo $productosRandom[4]->getNombre() ?></h2>
        <p class="text-center text-secondary"><?php echo $productosRandom[4]->getDescripcion() ?></p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="/Daw2mvc/index.php?controller=productos&action=show&id=<?= $productosRandom[4]->getId() ?>" class="btn btn-primary rounded-pill px-3">Más información</a>
            <a href="/Daw2mvc/index.php?controller=productos&action=show&id=<?= $productosRandom[4]->getId() ?>" class="btn btn-outline-primary rounded-pill px-3">Comprar</a>
        </div>
        <img src="<?php echo $productosRandom[4]->getImagen() ?>" alt="<?php echo htmlspecialchars($productosRandom[4]->getNombre(), ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid mx-auto w-50 d-block mt-4 rounded-2">
    </div>
</div>

<div class="container-fluid d-flex flex-column flex-md-row justify-content-center gap-3 mt-1">
    <div class="contenedores4 container-fluid mb-3 p-5 rounded-3">
        <h2 class="text-center fw-bold titulos-h1"><?php echo $productosRandom[5]->getNombre() ?></h2>
        <p class="text-center text-secondary"><?php echo $productosRandom[5]->getDescripcion() ?></p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="/Daw2mvc/index.php?controller=productos&action=show&id=<?= $productosRandom[5]->getId() ?>" class="btn btn-primary rounded-pill px-3">Más información</a>
            <a href="/Daw2mvc/index.php?controller=productos&action=show&id=<?= $productosRandom[5]->getId() ?>" class="btn btn-outline-primary rounded-pill px-3">Comprar</a>
        </div>
        <img src="<?php echo $productosRandom[5]->getImagen() ?>" alt="<?php echo htmlspecialchars($productosRandom[5]->getNombre(), ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid mx-auto w-50 d-block mt-4 rounded-2">
    </div>

    <div class="contenedores3 container-fluid mb-3 p-5 rounded-3">
        <h2 class="text-center fw-bold titulos-h1"><?php echo $productosRandom[6]->getNombre() ?></h2>
        <p class="text-center text-secondary"><?php echo $productosRandom[6]->getDescripcion() ?></p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="/Daw2mvc/index.php?controller=productos&action=show&id=<?= $productosRandom[6]->getId() ?>" class="btn btn-primary rounded-pill px-3">Más información</a>
            <a href="/Daw2mvc/index.php?controller=productos&action=show&id=<?= $productosRandom[6]->getId() ?>" class="btn btn-outline-primary rounded-pill px-3">Comprar</a>
        </div>
        <img src="<?php echo $productosRandom[6]->getImagen() ?>" alt="<?php echo htmlspecialchars($productosRandom[6]->getNombre(), ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid mx-auto w-50 d-block mt-4 rounded-2">
    </div>
</div>