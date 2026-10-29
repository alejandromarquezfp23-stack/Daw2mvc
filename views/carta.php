<!DOCTYPE html>
<html lang="en">
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
    ?>

    <div class="mt-1 container-fluid div-carta">
        <div class="d-flex justify-content-between mx-5">
            <h1 class="text-center fw-bold mx-5 mt-5 mb-5 display-2">Carta</h1>
            <h2 class="text-end fw-bold mx-5 mt-5 mb-5 h2-primero">La mejor forma de elegir tus platos</h2>
        </div>
        
        <div class="d-flex justify-content-center mx-5 mb-5 mt-5 gap-5">
            <?php
                require_once __DIR__ . '/../config/DataBase.php';
                require_once __DIR__ . '/../models/Categorias.php'; 
                require_once __DIR__ . '/../dao/CategoriasDAO.php'; 

                $categoriasDAO = new CategoriasDAO(DataBase::connect());
                $categorias = $categoriasDAO->selectAll();

            ?>

            <?php foreach ($categorias as $categoria) { ?>
                <div class="text-center">
                    <a href="#" class="text-decoration-none text-dark">
                        <img src="<?= $categoria->getImagenes() ?>" 
                            alt="Logo de Appletito" 
                            class="card-logo" 
                            style="width: 125px; height: 125px; object-fit: contain;">
                        <p class="fw-bold mt-2"><?= $categoria->getNombre() ?></p>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="footer">
        <?php
            include __DIR__ . '/footer.php';
        ?>
    </div>
</body>
</html>