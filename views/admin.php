<div class="container py-5">
    <header class="mb-4">
        <h1 class="fw-bold mb-1">Panel de administración</h1>
        <p class="text-secondary mb-0">Selecciona una tabla para consultar sus registros.</p>
    </header>

    <div class="d-flex flex-wrap gap-2 mb-4" role="group" aria-label="Filtrar por tabla">
        <button type="button" class="btn btn-dark rounded-pill px-4" data-table-target="productos" aria-pressed="true">
            Productos
        </button>
        <button type="button" class="btn btn-outline-dark rounded-pill px-4" data-table-target="categorias" aria-pressed="false">
            Categorías
        </button>
        <button type="button" class="btn btn-outline-dark rounded-pill px-4" data-table-target="ingredientes" aria-pressed="false">
            Ingredientes
        </button>
        <button type="button" class="btn btn-outline-dark rounded-pill px-4" data-table-target="ofertas" aria-pressed="false">
            Ofertas
        </button>
        <button type="button" class="btn btn-outline-dark rounded-pill px-4" data-table-target="pedidos" aria-pressed="false">
            Pedidos
        </button>
        <button type="button" class="btn btn-outline-dark rounded-pill px-4" data-table-target="usuarios" aria-pressed="false">
            Usuarios
        </button>
    </div>

    <div id="tabla-productos" data-table-panel>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="h4 fw-bold mb-1">Productos</h2>
                <p class="text-secondary mb-0">Gestiona los productos de Appletito.</p>
            </div>
            <button type="button" class="btn btn-dark rounded-pill px-4">
                + Añadir producto
            </button>
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
                <tbody id="productos">
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="tabla-categorias" data-table-panel hidden>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 fw-bold mb-0">Categorías</h2>
            <button type="button" class="btn btn-dark rounded-pill px-4">
                + Añadir categoría
            </button>
        </div>
        <div class="table-responsive border rounded-4">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4 py-3">Categoría</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody id="categorias">
                </tbody>
            </table>
        </div>
    </div>

    <div id="tabla-ingredientes" data-table-panel hidden>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 fw-bold mb-0">Ingredientes</h2>
            <button type="button" class="btn btn-dark rounded-pill px-4">
                + Añadir ingrediente
            </button>
        </div>
        <div class="table-responsive border rounded-4">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4 py-3">Ingrediente</th>
                        <th>Precio extra</th>
                        <th>Estado</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody id="ingredientes">
                </tbody>
            </table>
        </div>
    </div>

    <div id="tabla-ofertas" data-table-panel hidden>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 fw-bold mb-0">Ofertas</h2>
            <button type="button" class="btn btn-dark rounded-pill px-4">
                + Añadir oferta
            </button>
        </div>
        <div class="table-responsive border rounded-4">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4 py-3">Oferta</th>
                        <th>Tipo</th>
                        <th>Código</th>
                        <th>Estado</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody id="ofertas">
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
                    <tr>
                        <th class="ps-4 py-3">Pedido</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody id="pedidos">
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
                    <tr>
                        <th class="ps-4 py-3">Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Registro</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody id="usuarios">
                </tbody>
            </table>
        </div>
    </div>
</div>