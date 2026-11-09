<div class="padre">
    <div class="py-5 divArriba">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold">Cuenta</h5>
            <form method="post" action="/Daw2mvc/index.php?controller=login&action=logout">
                <button type="submit" class="btn btn-secondary rounded-3">
                    Cerrar sesión
                </button>
            </form>
        </div>

        <hr>

        <div>
            <h2 class="fw-semibold">Hola, <?php echo $usuario->nombre ?></h2>
        </div>
    </div>

    <div class="d-flex flex-column flex-md-row gap-3 gap-md-0 p-3 p-md-5 divMedio my-5">
        <div id="divBlancos" class="rounded-3 m-md-3 p-3">
            <h2 class="fw-semibold">Saldo de tu cuenta de Appletito: 0,00 €</h2>
            <p>Canjea tarjetas regalo de Apple en tu cuenta o añade dinero directamente cuando tú quieras. Tras hacerlo, podrás usar tu saldo para todo lo que necesites en Apple: productos, accesorios, apps, juegos, música, películas, series, iCloud y mucho más.</p>
            <button type="submit" class="btn btn-outline-primary rounded-3">
                Gestionar saldo
            </button>
        </div>

        <div id="divBlancos" class="rounded-3 m-md-3 p-3">
            <h2 class="fw-semibold">Tus pedidos</h2>
            <p>Sigue, modifica o cancela un pedido para hacer una devolución.</p>
            <button type="submit" class="btn btn-outline-primary rounded-3">
                Consulta tu historial de pedidos
            </button>
        </div>

        <div id="divBlancos" class="rounded-3 m-md-3 p-3">
            <h2 class="fw-semibold">Tus favoritos</h2>
            <p>Tanto si compras online o en un Apple Store, puedes guardar de forma sencilla los productos que te interesen y hacer un seguimiento de tu progreso aquí.</p>
            <button type="submit" class="btn btn-outline-primary rounded-3">
                Ver Tus favoritos
            </button>
        </div>
    </div>
</div>