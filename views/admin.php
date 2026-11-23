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
            <button type="button" id="btnAnadirProducto" class="btn btn-dark rounded-pill px-4">
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
    <!-- Modal de productos -->
    <div class="modal fade" id="modalProducto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4">

                <div class="modal-header border-0 px-4 pt-4">
                    <div>
                        <h2 class="modal-title fs-4 fw-bold" id="tituloModalProducto">
                            Añadir producto
                        </h2>
                        <p class="text-secondary mb-0">
                            Completa la información del producto.
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>

                <form id="formProducto">
                    <div class="modal-body px-4">

                        <input type="hidden" id="productoId" name="id">

                        <div class="row g-3">

                            <div class="col-md-8">
                                <label for="nombreProducto" class="form-label">
                                    Nombre
                                </label>
                                <input type="text" class="form-control rounded-3"
                                    id="nombreProducto" name="nombre" required>
                            </div>

                            <div class="col-md-4">
                                <label for="precioProducto" class="form-label">
                                    Precio (€)
                                </label>
                                <input type="number" class="form-control rounded-3"
                                    id="precioProducto" name="precio"
                                    min="0" step="0.01" required>
                            </div>

                            <div class="col-12">
                                <label for="descripcionProducto" class="form-label">
                                    Descripción
                                </label>
                                <textarea class="form-control rounded-3"
                                    id="descripcionProducto" name="descripcion"
                                    rows="3" required></textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="categoriaProducto" class="form-label">
                                    Categoría
                                </label>
                                <select class="form-select rounded-3"
                                    id="categoriaProducto" name="categoria_id"
                                    required>
                                    <option value="">Selecciona una categoría</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="imagenProducto" class="form-label">
                                    Imagen
                                </label>
                                <input type="text" class="form-control rounded-3"
                                    id="imagenProducto" name="imagen"
                                    placeholder="imagenes/productos/ejemplo.png"
                                    required>
                            </div>

                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="activoProducto" name="activo" checked>
                                    <label class="form-check-label"
                                        for="activoProducto">
                                        Producto activo
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="button" class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            Guardar producto
                        </button>
                    </div>
                </form>

            </div>
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