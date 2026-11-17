<div class="container py-5">
    <header class="mb-4">
        <h1 class="fw-bold mb-1">Panel de administración</h1>
        <p class="text-secondary mb-0">Selecciona una tabla para consultar sus registros.</p>
    </header>

    <div class="d-flex flex-wrap gap-2 mb-4" role="group" aria-label="Filtrar por tabla">
        <button type="button" class="btn btn-dark rounded-pill px-4" data-table-target="productos" aria-pressed="true">Productos</button>
        <button type="button" class="btn btn-outline-dark rounded-pill px-4" data-table-target="categorias" aria-pressed="false">Categorías</button>
        <button type="button" class="btn btn-outline-dark rounded-pill px-4" data-table-target="ingredientes" aria-pressed="false">Ingredientes</button>
        <button type="button" class="btn btn-outline-dark rounded-pill px-4" data-table-target="ofertas" aria-pressed="false">Ofertas</button>
        <button type="button" class="btn btn-outline-dark rounded-pill px-4" data-table-target="pedidos" aria-pressed="false">Pedidos</button>
        <button type="button" class="btn btn-outline-dark rounded-pill px-4" data-table-target="usuarios" aria-pressed="false">Usuarios</button>
    </div>

    <div id="tabla-productos" data-table-panel>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="h4 fw-bold mb-1">Productos</h2>
                <p class="text-secondary mb-0">Gestiona los productos de Appletito.</p>
            </div>
            <button type="button" class="btn btn-dark rounded-pill px-4">+ Añadir producto</button>
        </div>

        <div class="table-responsive border rounded-4">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4 py-3">Producto</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-4 py-3 fw-semibold">Burrata con tomate confitado</td>
                        <td>Entrantes</td>
                        <td>12,50 €</td>
                        <td><span class="badge rounded-pill text-bg-success">Activo</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-dark rounded-pill">Editar</button>
                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-4 py-3 fw-semibold">Arroz caldoso de bogavante</td>
                        <td>Platos principales</td>
                        <td>24,90 €</td>
                        <td><span class="badge rounded-pill text-bg-success">Activo</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-dark rounded-pill">Editar</button>
                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-4 py-3 fw-semibold">Crema catalana</td>
                        <td>Postres</td>
                        <td>6,50 €</td>
                        <td><span class="badge rounded-pill text-bg-secondary">Inactivo</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-dark rounded-pill">Editar</button>
                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="tabla-categorias" data-table-panel hidden>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 fw-bold mb-0">Categorías</h2>
            <button type="button" class="btn btn-dark rounded-pill px-4">+ Añadir categoría</button>
        </div>
        <div class="table-responsive border rounded-4">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr><th class="ps-4 py-3">Categoría</th><th>Descripción</th><th>Estado</th><th class="text-end pe-4">Acciones</th></tr>
                </thead>
                <tbody>
                    <tr><td class="ps-4 fw-semibold">Entrantes</td><td>Pequeños comienzos para compartir.</td><td><span class="badge rounded-pill text-bg-success">Activa</span></td><td class="text-end pe-4"><button type="button" class="btn btn-sm btn-outline-dark rounded-pill">Editar</button> <button type="button" class="btn btn-sm btn-outline-danger rounded-pill">Eliminar</button></td></tr>
                    <tr><td class="ps-4 fw-semibold">Platos principales</td><td>Platos principales de la casa.</td><td><span class="badge rounded-pill text-bg-success">Activa</span></td><td class="text-end pe-4"><button type="button" class="btn btn-sm btn-outline-dark rounded-pill">Editar</button> <button type="button" class="btn btn-sm btn-outline-danger rounded-pill">Eliminar</button></td></tr>
                    <tr><td class="ps-4 fw-semibold">Postres</td><td>Postres artesanales.</td><td><span class="badge rounded-pill text-bg-success">Activa</span></td><td class="text-end pe-4"><button type="button" class="btn btn-sm btn-outline-dark rounded-pill">Editar</button> <button type="button" class="btn btn-sm btn-outline-danger rounded-pill">Eliminar</button></td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="tabla-ingredientes" data-table-panel hidden>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 fw-bold mb-0">Ingredientes</h2>
            <button type="button" class="btn btn-dark rounded-pill px-4">+ Añadir ingrediente</button>
        </div>
        <div class="table-responsive border rounded-4">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr><th class="ps-4 py-3">Ingrediente</th><th>Precio extra</th><th>Estado</th><th class="text-end pe-4">Acciones</th></tr>
                </thead>
                <tbody>
                    <tr><td class="ps-4 fw-semibold">Aguacate</td><td>1,50 €</td><td><span class="badge rounded-pill text-bg-success">Activo</span></td><td class="text-end pe-4"><button type="button" class="btn btn-sm btn-outline-dark rounded-pill">Editar</button> <button type="button" class="btn btn-sm btn-outline-danger rounded-pill">Eliminar</button></td></tr>
                    <tr><td class="ps-4 fw-semibold">Boletus</td><td>2,50 €</td><td><span class="badge rounded-pill text-bg-success">Activo</span></td><td class="text-end pe-4"><button type="button" class="btn btn-sm btn-outline-dark rounded-pill">Editar</button> <button type="button" class="btn btn-sm btn-outline-danger rounded-pill">Eliminar</button></td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="tabla-ofertas" data-table-panel hidden>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 fw-bold mb-0">Ofertas</h2>
            <button type="button" class="btn btn-dark rounded-pill px-4">+ Añadir oferta</button>
        </div>
        <div class="table-responsive border rounded-4">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr><th class="ps-4 py-3">Oferta</th><th>Tipo</th><th>Código</th><th>Estado</th><th class="text-end pe-4">Acciones</th></tr>
                </thead>
                <tbody>
                    <tr><td class="ps-4 fw-semibold">Bienvenida Appletito</td><td>Descuento</td><td>BIENVENIDA10</td><td><span class="badge rounded-pill text-bg-success">Activa</span></td><td class="text-end pe-4"><button type="button" class="btn btn-sm btn-outline-dark rounded-pill">Editar</button> <button type="button" class="btn btn-sm btn-outline-danger rounded-pill">Eliminar</button></td></tr>
                    <tr><td class="ps-4 fw-semibold">Dulce final</td><td>Descuento</td><td>DULCE15</td><td><span class="badge rounded-pill text-bg-success">Activa</span></td><td class="text-end pe-4"><button type="button" class="btn btn-sm btn-outline-dark rounded-pill">Editar</button> <button type="button" class="btn btn-sm btn-outline-danger rounded-pill">Eliminar</button></td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="tabla-pedidos" data-table-panel hidden>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 fw-bold mb-0">Pedidos</h2>
        </div>
        <div class="table-responsive border rounded-4">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr><th class="ps-4 py-3">Pedido</th><th>Usuario</th><th>Fecha</th><th>Total</th><th>Estado</th><th class="text-end pe-4">Acciones</th></tr>
                </thead>
                <tbody>
                    <tr><td class="ps-4 fw-semibold">#1001</td><td>Usuario Demo</td><td>17/11/2026</td><td>55,00 €</td><td><span class="badge rounded-pill text-bg-success">Entregado</span></td><td class="text-end pe-4"><button type="button" class="btn btn-sm btn-outline-dark rounded-pill">Ver</button></td></tr>
                    <tr><td class="ps-4 fw-semibold">#1002</td><td>Cliente Appletito</td><td>17/11/2026</td><td>89,50 €</td><td><span class="badge rounded-pill text-bg-warning">Pendiente</span></td><td class="text-end pe-4"><button type="button" class="btn btn-sm btn-outline-dark rounded-pill">Ver</button></td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="tabla-usuarios" data-table-panel hidden>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 fw-bold mb-0">Usuarios</h2>
        </div>
        <div class="table-responsive border rounded-4">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr><th class="ps-4 py-3">Nombre</th><th>Correo</th><th>Rol</th><th>Estado</th><th class="text-end pe-4">Acciones</th></tr>
                </thead>
                <tbody>
                    <tr><td class="ps-4 fw-semibold">Usuario Demo</td><td>demo@example.com</td><td>Usuario</td><td><span class="badge rounded-pill text-bg-success">Activo</span></td><td class="text-end pe-4"><button type="button" class="btn btn-sm btn-outline-dark rounded-pill">Ver</button></td></tr>
                    <tr><td class="ps-4 fw-semibold">Admin Appletito</td><td>admin@example.com</td><td>Administrador</td><td><span class="badge rounded-pill text-bg-success">Activo</span></td><td class="text-end pe-4"><button type="button" class="btn btn-sm btn-outline-dark rounded-pill">Ver</button></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
