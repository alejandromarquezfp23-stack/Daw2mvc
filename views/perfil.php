<div class="padre">
    <div class="py-5 divArriba">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold">Cuenta</h5>
            <form method="post" action="<?= url ?>index.php?controller=usuario&action=logout">
                <?php
                    if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]->getRol() === 'admin'){
                ?>
                        <a href="<?= url ?>index.php?controller=admin" class="btn btn-danger rounded-3">
                            Admin
                        </a>

                        <button type="submit" class="btn btn-secondary rounded-3">
                            Cerrar sesión
                        </button>
                        
                <?php
                    } else {
                ?>
                        <button type="submit" class="btn btn-secondary rounded-3">
                            Cerrar sesión
                        </button>
                <?php
                    }
                ?>
            </form>
        </div>

        <hr>

        <div>
            <h2 class="fw-semibold">Hola, <?php echo htmlspecialchars($usuario->getNombre(), ENT_QUOTES, 'UTF-8'); ?></h2>
        </div>
    </div>

    <div class="d-flex flex-column flex-md-row gap-3 gap-md-0 p-3 p-md-5 divMedio my-5">
        <form method="POST" action="" id="divBlancos" class="rounded-3 m-md-3 p-3">
            <h2 class="fw-semibold">Tu cuenta de Appletito</h2>
            <p>Consulta tu cuenta de Appletito y tus datos privados, puedes modificarlos siempre que quieras, recuerda de los cambios que hagas siempre.</p>
            <input type="submit" name="gestionar_cuenta" value="Gestionar cuenta" class="btn btn-outline-primary rounded-3">
        </form>

        <form method="POST" action="" id="divBlancos" class="rounded-3 m-md-3 p-3">
            <h2 class="fw-semibold">Tus pedidos</h2>
            <p>Revisa tus pedidos anteriores, consulta qué platos incluiste y comprueba el importe de cada pedido.</p>
            <input type="submit" name="historial_pedidos" value="Consulta tu historial de pedidos" class="btn btn-outline-primary rounded-3">
        </form>

        <form method="POST" action="" id="divBlancos" class="rounded-3 m-md-3 p-3">
            <h2 class="fw-semibold">Tus favoritos</h2>
            <p>Guarda tus platos favoritos para encontrarlos fácilmente y volver a pedirlos cuando te apetezcan.</p>
            <input type="submit" name="ver_favoritos" value="Ver Tus favoritos" class="btn btn-outline-primary rounded-3">
        </form>
    </div>

    <?php if ($gestionar_cuenta): ?>  
        <div class="container py-5">
            <div class="card border-0 rounded-4 p-4 divPerfil">
                <div class="row g-4">
                    <!-- NOMBRE -->
                    <form method="POST" class="col-md-6">
                        <label class="form-label text-secondary">Nombre</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="text" name="nuevoNombre"
                                class="form-control form-control-sm me-2"
                                value="<?= htmlspecialchars($usuario->getNombre()) ?>">
                            <input type="hidden" name="gestionar_cuenta" value="1">

                            <button type="submit" name="guardarNombre"
                                    class="btn btn-outline-primary btn-sm rounded-3 px-3">
                                Guardar
                            </button>
                        </div>
                        <hr>
                    </form>

                    <!-- CORREO ELECTRÓNICO -->
                    <form method="POST" class="col-md-6">
                        <label class="form-label text-secondary">Correo electrónico</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="email" name="nuevoEmail"
                                class="form-control form-control-sm me-2"
                                value="<?= htmlspecialchars($usuario->getEmail()) ?>">
                            <input type="hidden" name="gestionar_cuenta" value="1">

                            <button type="submit" name="guardarEmail"
                                    class="btn btn-outline-primary btn-sm rounded-3 px-3">
                                Guardar
                            </button>
                        </div>
                        <hr>
                    </form>

                    <!-- TELÉFONO -->
                    <form method="POST" class="col-md-6">
                        <label class="form-label text-secondary">Teléfono</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="tel" name="nuevoTelefono"
                                class="form-control form-control-sm me-2"
                                value="<?= htmlspecialchars($usuario->getTelefono()) ?>">
                            <input type="hidden" name="gestionar_cuenta" value="1">

                            <button type="submit" name="guardarTelefono"
                                    class="btn btn-outline-primary btn-sm rounded-3 px-3">
                                Guardar
                            </button>
                        </div>
                        <hr>
                    </form>

                    <!-- DIRECCIÓN -->
                    <form method="POST" class="col-md-6">
                        <label class="form-label text-secondary">Dirección</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="text" name="nuevaDireccion"
                                class="form-control form-control-sm me-2"
                                value="<?= htmlspecialchars($usuario->getDireccion()) ?>">
                            <input type="hidden" name="gestionar_cuenta" value="1">

                            <button type="submit" name="guardarDireccion"
                                    class="btn btn-outline-primary btn-sm rounded-3 px-3">
                                Guardar
                            </button>
                        </div>
                        <hr>
                    </form>

                    <!-- FECHA DE NACIMIENTO -->
                    <form method="POST" class="col-md-6">
                        <label class="form-label text-secondary">Fecha de nacimiento</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="date" name="nuevaFecha"
                                class="form-control form-control-sm me-2"
                                value="<?= htmlspecialchars($usuario->getFechaNacimiento()) ?>">
                            <input type="hidden" name="gestionar_cuenta" value="1">

                            <button type="submit" name="guardarFecha"
                                    class="btn btn-outline-primary btn-sm rounded-3 px-3">
                                Guardar
                            </button>
                        </div>
                        <hr>
                    </form>

                    <!-- ROL -->
                    <div class="col-md-6">
                        <label class="form-label text-secondary">Rol</label>
                        <p class="mb-0"><?= htmlspecialchars($usuario->getRol()) ?></p>
                        <input type="hidden" name="gestionar_cuenta" value="1">
                        <hr>
                    </div>


                    <!-- FECHA DE REGISTRO -->
                    <div class="col-md-6">
                        <label class="form-label text-secondary">Fecha de registro</label>
                        <p class="mb-0"><?= htmlspecialchars($usuario->getFechaRegistro()) ?></p>
                        <input type="hidden" name="gestionar_cuenta" value="1">
                    </div>

                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($historial_pedidos): ?>
        <div class="d-flex flex-column divMedio mb-5 py-5">
            <?php if (empty($pedidosUsuario)): ?>
                <div class="d-flex justify-content-center align-items-center m-5">
                    <div class="rounded-3 p-4 bg-white text-center">
                        <h4 class="fw-semibold mb-2">Todavía no tienes pedidos</h4>
                        <p>Cuando hagas tu primer pedido, aparecerá aquí.</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="divFiltroPedidos">
                    <form method="POST" class="d-flex flex-wrap align-items-center gap-3 p-3 bg-white rounded-3 filtrosPedidos" aria-label="Ordenar pedidos">
                        <input type="hidden" name="historial_pedidos" value="1">

                        <div class="d-flex flex-column">
                            <span class="fw-semibold">Ordenar pedidos</span>
                            <small class="text-muted">Elige un criterio</small>
                        </div>

                        <div class="d-flex flex-wrap gap-2 filtroBotones" role="group" aria-label="Criterio de ordenación">
                            <button type="submit" name="filtroidpedido" value="1"
                                class="btn <?= $filtroActivo === 'id' ? 'btn-dark' : 'btn-outline-dark' ?> rounded-pill px-4"
                                aria-pressed="<?= $filtroActivo === 'id' ? 'true' : 'false' ?>">
                                ID
                            </button>

                            <button type="submit" name="filtrofechapedido" value="2"
                                class="btn <?= $filtroActivo === 'fecha' ? 'btn-dark' : 'btn-outline-dark' ?> rounded-pill px-4"
                                aria-pressed="<?= $filtroActivo === 'fecha' ? 'true' : 'false' ?>">
                                Fecha
                            </button>

                            <button type="submit" name="filtropreciopedido" value="3"
                                class="btn <?= $filtroActivo === 'precio' ? 'btn-dark' : 'btn-outline-dark' ?> rounded-pill px-4"
                                aria-pressed="<?= $filtroActivo === 'precio' ? 'true' : 'false' ?>">
                                Precio
                            </button>
                        </div>
                    </form>
                </div>

                <div class="carruselProductos">
                    <button class="btn flecha-carrusel flecha-izquierda" type="button" onclick="desplazarProductos(this, -1)" aria-label="Pedido anterior">
                        <img src="<?= url ?>iconos/icono_flecha_izquierda-removebg-preview.png" alt="">
                    </button>

                    <div class="d-flex divProductos overflow-auto">
                        <?php foreach ($pedidosUsuario as $pedido): ?>
                            <div class="divProducto mx-3 m-md-3 p-4 rounded-3" style="min-width: 280px;">
                                <p class="text-muted mb-1">Pedido</p>
                                <h5 class="fw-bold">#<?= $pedido->getId() ?></h5>
                                <p class="mb-1"><strong>Estado:</strong> <?= htmlspecialchars($pedido->getEstado(), ENT_QUOTES, 'UTF-8') ?></p>
                                <p class="mb-1"><strong>Fecha:</strong> <?= htmlspecialchars($pedido->getFechaPedido(), ENT_QUOTES, 'UTF-8') ?></p>
                                <p class="mb-3"><strong>Total:</strong> <?= number_format((float) $pedido->getTotal(), 2, ',', '.') ?> €</p>

                                <?php foreach (($pedidodetalle[$pedido->getId()] ?? []) as $detalle): ?>
                                    <div class="border-top pt-2">
                                        <p class="mb-1"><?= htmlspecialchars($detalle->getNombreProducto(), ENT_QUOTES, 'UTF-8') ?></p>
                                        <p class="mb-1">Cantidad: <?= (int) $detalle->getCantidad() ?></p>
                                        <p class="mb-1"><?= number_format((float) $detalle->getSubtotal(), 2, ',', '.') ?> €</p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button class="btn flecha-carrusel flecha-derecha" type="button" onclick="desplazarProductos(this, 1)" aria-label="Pedido siguiente">
                        <img src="<?= url ?>iconos/icono_flecha_derecha-removebg-preview.png" alt="">
                    </button>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($ver_favoritos): ?>
        <div class="d-flex flex-column divMedio mb-5 py-5">
            <?php if (empty($favoritosUsuario)): ?>
                <div class="d-flex justify-content-center align-items-center m-5">
                    <div class="rounded-3 p-4 bg-white text-center">
                        <h4 class="fw-semibold mb-2">Todavía no tienes productos en favoritos</h4>
                        <p>Cuando pongas tu primer producto en favoritos, aparecerá aquí.</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="carruselProductos">
                    <button class="btn flecha-carrusel flecha-izquierda" type="button" onclick="desplazarProductos(this, -1)" aria-label="Pedido anterior">
                        <img src="<?= url ?>iconos/icono_flecha_izquierda-removebg-preview.png" alt="">
                    </button>

                    <div class="d-flex divProductos overflow-auto">
                        <?php foreach ($favoritosUsuario as $favorito): ?>
                            <div class="divProducto mx-3 m-md-3 p-4 rounded-4" style="min-width: 280px;">
                                <h5 class="fw-bold">
                                    <?= htmlspecialchars($favorito->getNombre(), ENT_QUOTES, 'UTF-8') ?>
                                </h5>

                                <div class="d-flex justify-content-center">
                                    <img
                                        src="<?= url ?><?= htmlspecialchars($favorito->getImagen(), ENT_QUOTES, 'UTF-8') ?>"
                                        alt="<?= htmlspecialchars($favorito->getNombre(), ENT_QUOTES, 'UTF-8') ?>"
                                        class="object-fit-contain w-75"
                                    >
                                </div>
                                <a class="btn btn-primary rounded-3 w-100" href="<?= url ?>index.php?controller=productos&amp;action=show&amp;id=<?= urlencode((string) $favorito->getId()) ?>">
                                    Ver producto
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button class="btn flecha-carrusel flecha-derecha" type="button" onclick="desplazarProductos(this, 1)" aria-label="Pedido siguiente">
                        <img src="<?= url ?>iconos/icono_flecha_derecha-removebg-preview.png" alt="">
                    </button>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>