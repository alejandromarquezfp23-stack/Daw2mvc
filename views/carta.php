<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appletito - Carta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Daw2mvc/css/carta.css?v=2">
    <link rel="icon" type="image/png" href="/Daw2mvc/iconos/LogoOscuro.png">
</head>
<body>
    <?php
        include __DIR__ . '/header.php';
    ?>

    <div class="mt-1 container-fluid div-carta">
        <div class="d-flex justify-content-between mx-5">
            <h1 class="text-center fw-semibold mx-5 mt-5 mb-5 display-2">Carta</h1>
            <h2 class="text-end fw-semibold mx-5 mt-5 mb-5 h2-primero">La mejor forma de elegir tus platos</h2>
        </div>
        
        <div class="d-flex justify-content-center mx-5 mb-5 mt-5 gap-5">
            <?php
                require_once __DIR__ . '/../config/DataBase.php';
                require_once __DIR__ . '/../models/Categorias.php'; 
                require_once __DIR__ . '/../dao/CategoriasDAO.php'; 

                $categoriasDAO = new CategoriasDAO(DataBase::connect());
                $categorias = $categoriasDAO->selectAll();

                require_once __DIR__ . '/../models/productos.php'; 
                require_once __DIR__ . '/../dao/productosDAO.php';
                $productosDAO = new productosDAO(DataBase::connect());
                $productos = $productosDAO->selectAll();

                $categoriaActivaId = isset($_GET['id']) ? $_GET['id'] : (isset($categorias[0]) ? $categorias[0]->getId() : 0);
            ?>

            <?php foreach ($categorias as $categoria) { ?>
                <div class="text-center">
                    <a href="carta.php?id=<?= $categoria->getId() ?>" class="text-decoration-none text-dark">
                        <img src="<?= $categoria->getImagenes() ?>" 
                            alt="" 
                            style="width: 125px; height: 125px; object-fit: contain;">
                        <p class="fw-bold mt-2"><?= $categoria->getNombre() ?></p>
                    </a>
                </div>
            <?php } ?>
        </div>

            <?php for($i = 0; $i < count($productos); $i++) { 
                if($productos[$i]->getCategoriaId() == $categoriaActivaId) { ?>
                    <h2 class="fw-semibold mx-5 mt-5 mb-5 h2-segundo">
                        <?= $categoria->getNombre() ?>. 
                        <span class="text-secondary fw-semibold">Elije el plato que más te guste.</span>
                    </h2>

                    <div class="d-flex gap-5 m-5 divProductos">
                        <div class="divProducto">
                            <h5 class="fw-bold mt-2"><?= $productos[$i]->getNombre() ?></h5>
                            <p class="mt-2"><?= $productos[$i]->getDescripcion() ?></p>
                            <img src="<?= $productos[$i]->getImagen() ?>" 
                                alt="" 
                                style="width: 340px; height: 264px; object-fit: contain;"
                                class="justify-content-center">
                            <div class="d-flex justify-content-center">
                                <button class="justify-content-center btn btn-primary rounded-pill m-1">Añadir al carrito</button>
                            </div>
                            <p class=" m-1"><?= $productos[$i]->getPrecio() ?>€</p>
                    </div>
            <?php }
            } ?>
        </div>
    </div>

    <div class="footer">
        <?php
            include __DIR__ . '/footer.php';
        ?>
    </div>
</body>
</html>