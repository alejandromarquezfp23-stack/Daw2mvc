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
            <button type="button" id="btnAnadirCategoria" class="btn btn-dark rounded-pill px-4">
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

    <div class="modal fade" id="modalCategoria" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4">

                <div class="modal-header border-0 px-4 pt-4">
                    <div>
                        <h2 class="modal-title fs-4 fw-bold" id="tituloModalCategoria">
                            Añadir categoría
                        </h2>
                        <p class="text-secondary mb-0">
                            Completa la información de la categoría.
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>

                <form id="formCategoria">
                    <div class="modal-body px-4">

                        <input type="hidden" id="categoriaId" name="id">

                        <div class="row g-3">

                            <div class="col-md-8">
                                <label for="nombreCategoria" class="form-label">
                                    Nombre
                                </label>
                                <input type="text" class="form-control rounded-3"
                                    id="nombreCategoria" name="nombre" required>
                            </div>

                            <div class="col-12">
                                <label for="descripcionCategoria" class="form-label">
                                    Descripción
                                </label>
                                <textarea class="form-control rounded-3"
                                    id="descripcionCategoria" name="descripcion"
                                    rows="3" required></textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="imagenCategoria" class="form-label">
                                    Imagen
                                </label>
                                <input type="text" class="form-control rounded-3"
                                    id="imagenCategoria" name="imagen"
                                    placeholder="imagenes/categorias/ejemplo.png"
                                    required>
                            </div>

                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="activoCategoria" name="activo" checked>
                                    <label class="form-check-label"
                                        for="activoCategoria">
                                        Categoría activa
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
                            Guardar categoría
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div id="tabla-ingredientes" data-table-panel hidden>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 fw-bold mb-0">Ingredientes</h2>
            <button type="button" id="btnAnadirIngrediente" class="btn btn-dark rounded-pill px-4">
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

    <!-- Modal de ingredientes -->
    <div class="modal fade" id="modalIngrediente" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4">

                <div class="modal-header border-0 px-4 pt-4">
                    <div>
                        <h2 class="modal-title fs-4 fw-bold" id="tituloModalIngrediente">
                            Añadir ingrediente
                        </h2>
                        <p class="text-secondary mb-0">
                            Completa la información del ingrediente.
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>

                <form id="formIngrediente">
                    <div class="modal-body px-4">

                        <input type="hidden" id="ingredienteId" name="id">

                        <div class="row g-3">

                            <div class="col-md-8">
                                <label for="nombreIngrediente" class="form-label">
                                    Nombre
                                </label>
                                <input type="text" class="form-control rounded-3"
                                    id="nombreIngrediente" name="nombre" required>
                            </div>

                            <div class="col-md-4">
                                <label for="precioIngrediente" class="form-label">
                                    Precio extra (€)
                                </label>
                                <input type="number" class="form-control rounded-3"
                                    id="precioIngrediente" name="precio_extra"
                                    min="0" step="0.01" required>
                            </div>

                            <div class="col-12">
                                <label for="imagenIngrediente" class="form-label">
                                    Imagen
                                </label>
                                <input type="text" class="form-control rounded-3"
                                    id="imagenIngrediente" name="imagen"
                                    placeholder="imagenes/ingredientes/ejemplo.webp">
                            </div>

                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="activoIngrediente" name="activo" checked>
                                    <label class="form-check-label"
                                        for="activoIngrediente">
                                        Ingrediente activo
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
                            Guardar ingrediente
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div id="tabla-ofertas" data-table-panel hidden>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 fw-bold mb-0">Ofertas</h2>
            <button type="button" id="btnAnadirOferta" class="btn btn-dark rounded-pill px-4">
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

    <!-- Modal de ofertas -->
    <div class="modal fade" id="modalOferta" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4">

                <div class="modal-header border-0 px-4 pt-4">
                    <div>
                        <h2 class="modal-title fs-4 fw-bold" id="tituloModalOferta">
                            Añadir oferta
                        </h2>
                        <p class="text-secondary mb-0">
                            Completa la información de la oferta.
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>

                <form id="formOferta">
                    <div class="modal-body px-4">

                        <input type="hidden" id="ofertaId" name="id">

                        <div class="row g-3">

                            <div class="col-12">
                                <label for="nombreOferta" class="form-label">
                                    Nombre
                                </label>
                                <input type="text" class="form-control rounded-3"
                                    id="nombreOferta" name="nombre" required>
                            </div>

                            <div class="col-12">
                                <label for="descripcionOferta" class="form-label">
                                    Descripción
                                </label>
                                <textarea class="form-control rounded-3"
                                    id="descripcionOferta" name="descripcion"
                                    rows="3"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="tipoOferta" class="form-label">
                                    Tipo de oferta
                                </label>
                                <select class="form-select rounded-3"
                                    id="tipoOferta" name="tipo" required>
                                    <option value="">Selecciona un tipo</option>
                                    <option value="descuento">Descuento</option>
                                    <option value="2x1">2x1</option>
                                    <option value="combo">Combo</option>
                                    <option value="codigo">Código</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="valorOferta" class="form-label">
                                    Valor
                                </label>
                                <input type="number" class="form-control rounded-3"
                                    id="valorOferta" name="valor"
                                    min="0" step="0.01">
                            </div>

                            <div class="col-md-6">
                                <label for="codigoOferta" class="form-label">
                                    Código promocional
                                </label>
                                <input type="text" class="form-control rounded-3"
                                    id="codigoOferta" name="codigo">
                            </div>

                            <div class="col-md-6">
                                <label for="fechaInicioOferta" class="form-label">
                                    Fecha de inicio
                                </label>
                                <input type="datetime-local"
                                    class="form-control rounded-3"
                                    id="fechaInicioOferta" name="fecha_inicio" required>
                            </div>

                            <div class="col-md-6">
                                <label for="fechaFinOferta" class="form-label">
                                    Fecha de finalización
                                </label>
                                <input type="datetime-local"
                                    class="form-control rounded-3"
                                    id="fechaFinOferta" name="fecha_fin">
                            </div>

                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="activaOferta" name="activa" checked>
                                    <label class="form-check-label"
                                        for="activaOferta">
                                        Oferta activa
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
                            Guardar oferta
                        </button>
                    </div>
                </form>

            </div>
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

    <!-- Modal de pedidos -->
    <div class="modal fade" id="modalPedido" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4">

                <div class="modal-header border-0 px-4 pt-4">
                    <div>
                        <h2 class="modal-title fs-4 fw-bold" id="tituloModalPedido">
                            Detalles del pedido
                        </h2>
                        <p class="text-secondary mb-0">
                            Consulta y gestiona la información del pedido.
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>

                <form id="formPedido">
                    <div class="modal-body px-4">

                        <input type="hidden" id="pedidoId" name="id">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label for="usuarioPedido" class="form-label">
                                    Usuario
                                </label>
                                <input type="text" class="form-control rounded-3"
                                    id="usuarioPedido" readonly>
                            </div>

                            <div class="col-md-6">
                                <label for="fechaPedido" class="form-label">
                                    Fecha del pedido
                                </label>
                                <input type="text" class="form-control rounded-3"
                                    id="fechaPedido" readonly>
                            </div>

                            <div class="col-md-4">
                                <label for="subtotalPedido" class="form-label">
                                    Subtotal (€)
                                </label>
                                <input type="text" class="form-control rounded-3"
                                    id="subtotalPedido" readonly>
                            </div>

                            <div class="col-md-4">
                                <label for="descuentoPedido" class="form-label">
                                    Descuento (€)
                                </label>
                                <input type="text" class="form-control rounded-3"
                                    id="descuentoPedido" readonly>
                            </div>

                            <div class="col-md-4">
                                <label for="totalPedido" class="form-label">
                                    Total (€)
                                </label>
                                <input type="text" class="form-control rounded-3"
                                    id="totalPedido" readonly>
                            </div>

                            <div class="col-md-6">
                                <label for="estadoPedido" class="form-label">
                                    Estado del pedido
                                </label>
                                <select class="form-select rounded-3"
                                    id="estadoPedido" name="estado" required>
                                    <option value="pendiente">Pendiente</option>
                                    <option value="confirmado">Confirmado</option>
                                    <option value="preparando">Preparando</option>
                                    <option value="enviado">Enviado</option>
                                    <option value="entregado">Entregado</option>
                                    <option value="cancelado">Cancelado</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="estadoPagoPedido" class="form-label">
                                    Estado del pago
                                </label>
                                <select class="form-select rounded-3"
                                    id="estadoPagoPedido" name="estado_pago" required>
                                    <option value="pendiente">Pendiente</option>
                                    <option value="pagado">Pagado</option>
                                    <option value="fallido">Fallido</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="metodoPagoPedido" class="form-label">
                                    Método de pago
                                </label>
                                <input type="text" class="form-control rounded-3"
                                    id="metodoPagoPedido" readonly>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="button" class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">
                            Cerrar
                        </button>

                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            Guardar cambios
                        </button>
                    </div>
                </form>

            </div>
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

    <!-- Modal de usuarios -->
    <div class="modal fade" id="modalUsuario" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4">

                <div class="modal-header border-0 px-4 pt-4">
                    <div>
                        <h2 class="modal-title fs-4 fw-bold" id="tituloModalUsuario">
                            Modificar usuario
                        </h2>
                        <p class="text-secondary mb-0">
                            Gestiona la información del usuario.
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>

                <form id="formUsuario">
                    <div class="modal-body px-4">

                        <input type="hidden" id="usuarioId" name="id">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label for="nombreUsuario" class="form-label">
                                    Nombre
                                </label>
                                <input type="text" class="form-control rounded-3"
                                    id="nombreUsuario" name="nombre" required>
                            </div>

                            <div class="col-md-6">
                                <label for="emailUsuario" class="form-label">
                                    Correo electrónico
                                </label>
                                <input type="email" class="form-control rounded-3"
                                    id="emailUsuario" name="email" required>
                            </div>

                            <div class="col-md-6">
                                <label for="telefonoUsuario" class="form-label">
                                    Teléfono
                                </label>
                                <input type="text" class="form-control rounded-3"
                                    id="telefonoUsuario" name="telefono">
                            </div>

                            <div class="col-md-6">
                                <label for="fechaNacimientoUsuario" class="form-label">
                                    Fecha de nacimiento
                                </label>
                                <input type="date" class="form-control rounded-3"
                                    id="fechaNacimientoUsuario" name="fecha_nacimiento">
                            </div>

                            <div class="col-12">
                                <label for="direccionUsuario" class="form-label">
                                    Dirección
                                </label>
                                <input type="text" class="form-control rounded-3"
                                    id="direccionUsuario" name="direccion">
                            </div>

                            <div class="col-md-6">
                                <label for="rolUsuario" class="form-label">
                                    Rol
                                </label>
                                <select class="form-select rounded-3"
                                    id="rolUsuario" name="rol" required>
                                    <option value="usuario">Usuario</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="button" class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            Guardar cambios
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>