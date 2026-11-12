<form class="container checkout-container py-5">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-5">
        <h3 class="fw-semibold mb-0">Caja</h3>
        <button type="button" class="btn btn-link text-primary text-decoration-none"
                data-bs-toggle="offcanvas" data-bs-target="#resumenPedido">
            Ver resumen del pedido: 59,00 €
        </button>
    </div>

    <div class="text-center mb-5">
        <h1 class="fw-semibold mb-3">¿Cómo quieres disfrutar de tu pedido?</h1>
        <p class="text-secondary">Elige cómo quieres recibir tu pedido.</p>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="radio" class="btn-check" name="modalidad"
                           id="paraLlevar" value="llevar" checked>

                    <label for="paraLlevar" class="opcion-checkout rounded-3 w-100">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-bag fs-2"></i>
                            <div>
                                <h5 class="fw-semibold mb-1">Para llevar</h5>
                                <small class="text-secondary">Recoge tu pedido en el restaurante.</small>
                            </div>
                        </div>
                    </label>
                </div>

                <div class="col-md-6">
                    <input type="radio" class="btn-check" name="modalidad"
                           id="enRestaurante" value="restaurante">

                    <label for="enRestaurante" class="opcion-checkout rounded-3 w-100">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-restaurant fs-2"></i>
                            <div>
                                <h5 class="fw-semibold mb-1">En el restaurante</h5>
                                <small class="text-secondary">Disfruta de tu pedido en nuestro local.</small>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <hr class="mb-5">

    <div class="row justify-content-center">
        <div class="col-lg-9">
            <form action="" method="POST">
                <div class="mb-5">
                    <h4 class="fw-semibold mb-4">¿Cuándo quieres disfrutar de tu pedido?</h4>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="fecha" class="form-label fw-medium">Selecciona el día</label>
                            <input type="date" class="form-control form-control-lg rounded-3"
                                   id="fecha" name="fecha" required>
                        </div>

                        <div class="col-md-6">
                            <label for="hora" class="form-label fw-medium">Selecciona la hora</label>
                            <select class="form-select form-select-lg rounded-3"
                                    id="hora" name="hora" required>
                                <option value="" selected disabled>Elige una hora</option>
                                <option value="13:00">13:00</option>
                                <option value="13:30">13:30</option>
                                <option value="14:00">14:00</option>
                                <option value="14:30">14:30</option>
                                <option value="15:00">15:00</option>
                                <option value="20:00">20:00</option>
                                <option value="20:30">20:30</option>
                                <option value="21:00">21:00</option>
                                <option value="21:30">21:30</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="seleccionMesa" class="mb-5 d-none">
                    <h4 class="fw-semibold mb-2">Elige tu mesa</h4>
                    <p class="text-secondary mb-4">
                        Selecciona la mesa en la que quieres disfrutar de tu comida.
                    </p>

                    <div class="row g-3">

                        <div class="col-6 col-md-4">
                            <input type="radio" class="btn-check" name="mesa"
                                   id="mesa1" value="1">
                            <label for="mesa1" class="mesa-check w-100">
                                <i class="bi bi-people fs-3"></i>
                                <h5 class="mb-1 mt-2">Mesa 1</h5>
                                <small class="text-secondary">2 personas</small>
                            </label>
                        </div>

                        <div class="col-6 col-md-4">
                            <input type="radio" class="btn-check" name="mesa"
                                   id="mesa2" value="2">
                            <label for="mesa2" class="mesa-check w-100">
                                <i class="bi bi-people fs-3"></i>
                                <h5 class="mb-1 mt-2">Mesa 2</h5>
                                <small class="text-secondary">4 personas</small>
                            </label>
                        </div>

                        <div class="col-6 col-md-4">
                            <input type="radio" class="btn-check" name="mesa"
                                   id="mesa3" value="3">
                            <label for="mesa3" class="mesa-check w-100">
                                <i class="bi bi-people fs-3"></i>
                                <h5 class="mb-1 mt-2">Mesa 3</h5>
                                <small class="text-secondary">4 personas</small>
                            </label>
                        </div>

                        <div class="col-6 col-md-4">
                            <input type="radio" class="btn-check" name="mesa"
                                   id="mesa4" value="4">
                            <label for="mesa4" class="mesa-check w-100">
                                <i class="bi bi-people fs-3"></i>
                                <h5 class="mb-1 mt-2">Mesa 4</h5>
                                <small class="text-secondary">6 personas</small>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <h4 class="fw-semibold mb-4">Tus datos de contacto</h4>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control form-control-lg rounded-3"
                                   id="nombre" name="nombre" placeholder="Tu nombre" required>
                        </div>

                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control form-control-lg rounded-3"
                                   id="telefono" name="telefono" placeholder="Tu teléfono" required>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control form-control-lg rounded-3"
                                   id="email" name="email" placeholder="tu@email.com" required>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="observaciones" class="form-label fw-semibold">
                        ¿Alguna indicación especial? (Opcional)
                    </label>

                    <textarea class="form-control rounded-3" id="observaciones"
                              name="observaciones" rows="3"
                              placeholder="Escribe aquí cualquier indicación..."></textarea>
                </div>

                <hr class="mb-4">

                <div class="form-check mb-5">
                    <input class="form-check-input" type="checkbox"
                           id="terminos" name="terminos" required>

                    <label class="form-check-label" for="terminos">
                        He leído y acepto los
                        <a href="#" class="text-primary">términos y condiciones</a>
                        de Appletito.
                    </label>
                </div>

                <button type="submit" name="confirmarPedido"
                        class="btn btn-dark btn-lg rounded-3 w-100 py-3">
                    Confirmar pedido
                </button>

                <p class="text-secondary text-center small mt-3">
                    Revisa los datos antes de confirmar tu pedido.
                </p>
            </form>
        </div>
    </div>
</form>

<div class="offcanvas offcanvas-end resumen-offcanvas rounded-start-4"
     tabindex="-1" id="resumenPedido"
     aria-labelledby="resumenPedidoLabel">

    <div class="offcanvas-header px-4 pt-4">
        <h4 class="offcanvas-title fw-semibold" id="resumenPedidoLabel">
            Tu pedido
        </h4>

        <button type="button" class="btn-close"
                data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>

    <div class="offcanvas-body px-4">
        <h5 class="fw-semibold mb-4">Total de tu pedido</h5>

        <div class="d-flex justify-content-between mb-3">
            <span>2 artículos</span>
        </div>

        <hr>

        <div class="d-flex justify-content-between mb-3">
            <span class="text-secondary">Subtotal</span>
            <span>59,00 €</span>
        </div>

        <div class="d-flex justify-content-between mb-4">
            <span class="fw-semibold">Tu total:</span>
            <span class="fw-semibold">59,00 €</span>
        </div>

        <hr>

        <h5 class="fw-semibold mt-5 mb-4">Información del pedido</h5>

        <div class="mb-4">
            <small class="text-secondary fw-semibold">Modalidad</small>
            <p class="mb-0 mt-2" id="resumenModalidad">Para llevar</p>
        </div>

        <hr>

        <div class="mb-4">
            <small class="text-secondary fw-semibold">Fecha y hora</small>
            <p class="mb-0 mt-2" id="resumenFecha">Pendiente de seleccionar</p>
        </div>

        <hr>

        <div class="mb-4" id="resumenMesaContainer">
            <small class="text-secondary fw-semibold">Mesa</small>
            <p class="mb-0 mt-2" id="resumenMesa">No seleccionada</p>
        </div>
    </div>
</div>