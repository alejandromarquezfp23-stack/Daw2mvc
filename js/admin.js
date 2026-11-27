class AdminVista {
    constructor() {
        this.productos = new Productos();
        this.categorias = new Categorias();
        this.ingredientes = new Ingredientes();
        this.ofertas = new Ofertas();
        this.pedidos = new Pedidos();
        this.usuarios = new Usuarios();

        this.inicializar();
    }

    inicializar() {
        this.configurarPestanas();

        this.productos.cargarProductos();
        this.categorias.cargarCategorias();
        this.ingredientes.cargarIngredientes();
        this.ofertas.cargarOfertas();
        this.pedidos.cargarPedidos();
        this.usuarios.cargarUsuarios();

        this.productos.configurarModalProducto();
        this.categorias.configurarModalCategoria();
        this.ingredientes.configurarModalIngrediente();
        this.ofertas.configurarModalOferta();
        this.pedidos.configurarModalPedido();
        this.usuarios.configurarModalUsuario();
    }

    configurarPestanas() {
        const botones = document.querySelectorAll('[data-table-target]');
        const paneles = document.querySelectorAll('[data-table-panel]');

        botones.forEach(boton => {
            boton.addEventListener('click', () => {
                const tablaSeleccionada = boton.dataset.tableTarget;

                paneles.forEach(panel => {
                    panel.hidden = panel.id !== `tabla-${tablaSeleccionada}`;
                });

                botones.forEach(item => {
                    const seleccionado = item === boton;

                    item.classList.toggle('btn-dark', seleccionado);
                    item.classList.toggle('btn-outline-dark', !seleccionado);
                    item.setAttribute('aria-pressed', String(seleccionado));
                });
            });
        });
    }
}

class Productos {
    constructor() {
    }

    cargarProductos() {
        fetch("index.php?controller=admin&action=apiProducto")
        .then(respuesta => respuesta.json())
        .then(r => {
            this.productos = r;
            const tablaProductos = document.getElementById("productos");
            tablaProductos.innerHTML = "";

            this.productos.forEach(producto => {
                const tr = document.createElement("tr");

                const productoTd = document.createElement("td");
                productoTd.className = "fw-semibold";
                productoTd.textContent = producto.nombre;

                const categoriaTd = document.createElement("td");
                categoriaTd.textContent = producto.categoria_id;

                const precioTd = document.createElement("td");
                precioTd.textContent = `${Number(producto.precio).toFixed(2)} €`;

                const estadoTd = document.createElement("td");
                const estado = document.createElement("span");
                const activo = Number(producto.activo) === 1;

                estado.textContent = activo ? "Activo" : "Inactivo";
                estadoTd.append(estado);

                const accionesTd = document.createElement("td");
                accionesTd.className = "text-end";

                const modificarBtn = document.createElement("button");
                modificarBtn.type = "button";
                modificarBtn.className = "btn btn-sm btn-outline-dark rounded-pill";
                modificarBtn.textContent = "Modificar";

                modificarBtn.addEventListener("click", () => {
                    document.getElementById("productoId").value = producto.id;
                    document.getElementById("nombreProducto").value = producto.nombre;
                    document.getElementById("precioProducto").value = producto.precio;
                    document.getElementById("descripcionProducto").value = producto.descripcion;
                    document.getElementById("categoriaProducto").value = producto.categoria_id;
                    document.getElementById("imagenProducto").value = producto.imagen;
                    document.getElementById("activoProducto").checked = Number(producto.activo) === 1;

                    document.getElementById("tituloModalProducto").textContent = "Modificar producto";

                    this.modalProducto.show();
                });

                const eliminarBtn = document.createElement("button");
                eliminarBtn.type = "button";
                eliminarBtn.className = "btn btn-sm btn-outline-danger rounded-pill";
                eliminarBtn.textContent = "Eliminar";

                eliminarBtn.addEventListener("click", () => {
                    const datos = { id: producto.id };

                    fetch("index.php?controller=admin&action=apiProducto", {
                        method: "DELETE",
                        headers: {"Content-Type": "application/json"},
                        body: JSON.stringify(datos)
                    })
                    .then(respuesta => respuesta.json())
                    .then(r => {
                        if (r.success) {
                            this.cargarProductos();
                            console.log(r);
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    });
                });

                accionesTd.append(modificarBtn, eliminarBtn);
                tr.append(productoTd, categoriaTd, precioTd, estadoTd, accionesTd);
                tablaProductos.append(tr);
            });
        })
        .catch(error => console.error("Error:", error));
    }

    configurarModalProducto() {
        this.modalProducto = new bootstrap.Modal(document.getElementById("modalProducto"));

        const formulario = document.getElementById("formProducto");

        document.getElementById("btnAnadirProducto").addEventListener("click", () => {
            formulario.reset();
            document.getElementById("productoId").value = "";
            document.getElementById("tituloModalProducto").textContent = "Añadir producto";
            this.modalProducto.show();
        });

        formulario.addEventListener("submit", (evento) => {
            evento.preventDefault();

            const datos = {
                id: Number(document.getElementById("productoId").value),
                categoria_id: Number(document.getElementById("categoriaProducto").value),
                nombre: document.getElementById("nombreProducto").value,
                descripcion: document.getElementById("descripcionProducto").value,
                precio: Number(document.getElementById("precioProducto").value),
                imagen: document.getElementById("imagenProducto").value,
                activo: document.getElementById("activoProducto").checked ? 1 : 0
            };

            const id = document.getElementById("productoId").value;
            const metodo = id !== "" ? "PUT" : "POST";

            fetch("index.php?controller=admin&action=apiProducto", {
                method: metodo,
                headers: {"Content-Type": "application/json"},
                body: JSON.stringify(datos)
            })
            .then(respuesta => respuesta.json())
            .then(r => {
                if (r.success) {
                    this.modalProducto.hide();
                    formulario.reset();
                    this.cargarProductos();
                    console.log(r);
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
        });
    }
}

class Categorias {
    constructor() {
    }

    cargarCategorias() {
        fetch("index.php?controller=admin&action=apiCategoria")
        .then(respuesta => respuesta.json())
        .then(r => {
            this.categorias = r;

            const selector = document.getElementById("categoriaProducto");
            selector.innerHTML = '<option value="">Selecciona una categoría</option>';

            this.categorias.forEach(categoria => {
                if (Number(categoria.activa) === 1) {
                    const opcion = document.createElement("option");

                    opcion.value = categoria.id;
                    opcion.textContent = categoria.nombre;

                    selector.append(opcion);
                }
            });

            const tablaCategorias = document.getElementById("categorias");
            tablaCategorias.innerHTML = "";

            this.categorias.forEach(categoria => {
                const tr = document.createElement("tr");

                const categoriaTd = document.createElement("td");
                categoriaTd.className = "fw-semibold";
                categoriaTd.textContent = categoria.nombre;

                const descripcionTd = document.createElement("td");
                descripcionTd.textContent = categoria.descripcion;

                const estadoTd = document.createElement("td");
                const estado = document.createElement("span");
                const activa = Number(categoria.activa) === 1;

                estado.textContent = activa ? "Activa" : "Inactiva";
                estadoTd.append(estado);

                const accionesTd = document.createElement("td");
                accionesTd.className = "text-end pe-4";

                const modificarBtn = document.createElement("button");
                modificarBtn.type = "button";
                modificarBtn.className = "btn btn-sm btn-outline-dark rounded-pill";
                modificarBtn.textContent = "Modificar";

                modificarBtn.addEventListener("click", () => {
                    document.getElementById("categoriaId").value = categoria.id;
                    document.getElementById("nombreCategoria").value = categoria.nombre;
                    document.getElementById("descripcionCategoria").value = categoria.descripcion;
                    document.getElementById("imagenCategoria").value = categoria.imagen;
                    document.getElementById("activoCategoria").checked = Number(categoria.activa) === 1;

                    document.getElementById("tituloModalCategoria").textContent = "Modificar categoria";

                    this.modalCategoria.show();
                });

                const eliminarBtn = document.createElement("button");
                eliminarBtn.type = "button";
                eliminarBtn.className = "btn btn-sm btn-outline-danger rounded-pill";
                eliminarBtn.textContent = "Eliminar";

                eliminarBtn.addEventListener("click", () => {
                    const datos = { id: categoria.id };

                    fetch("index.php?controller=admin&action=apiCategoria", {
                        method: "DELETE",
                        headers: {"Content-Type": "application/json"},
                        body: JSON.stringify(datos)
                    })
                    .then(respuesta => respuesta.json())
                    .then(r => {
                        if (r.success) {
                            this.cargarCategorias();
                            console.log(r);
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    });
                });

                accionesTd.append(modificarBtn, eliminarBtn);
                tr.append(categoriaTd, descripcionTd, estadoTd, accionesTd);

                tablaCategorias.append(tr);
            });
        })
        .catch(error => console.error("Error:", error));
    }

    configurarModalCategoria() {
        this.modalCategoria = new bootstrap.Modal(document.getElementById("modalCategoria"));

        const formulario = document.getElementById("formCategoria");

        document.getElementById("btnAnadirCategoria").addEventListener("click", () => {
            formulario.reset();
            document.getElementById("categoriaId").value = "";
            document.getElementById("tituloModalCategoria").textContent = "Añadir categoria";
            this.modalCategoria.show();
        });

        formulario.addEventListener("submit", (evento) => {
            evento.preventDefault();

            const datos = {
                id: Number(document.getElementById("categoriaId").value),
                nombre: document.getElementById("nombreCategoria").value,
                descripcion: document.getElementById("descripcionCategoria").value,
                imagen: document.getElementById("imagenCategoria").value,
                activa: document.getElementById("activoCategoria").checked ? 1 : 0
            };

            const id = document.getElementById("categoriaId").value;
            const metodo = id !== "" ? "PUT" : "POST";

            fetch("index.php?controller=admin&action=apiCategoria", {
                method: metodo,
                headers: {"Content-Type": "application/json"},
                body: JSON.stringify(datos)
            })
            .then(respuesta => respuesta.json())
            .then(r => {
                if (r.success) {
                    this.modalCategoria.hide();
                    formulario.reset();
                    this.cargarCategorias();
                    console.log(r);
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
        });
    }
}

class Ingredientes {
    constructor() {
    }

    cargarIngredientes() {
        fetch("index.php?controller=admin&action=apiIngrediente")
        .then(respuesta => respuesta.json())
        .then(r => {
            this.ingredientes = r;

            const tablaIngredientes = document.getElementById("ingredientes");
            tablaIngredientes.innerHTML = "";

            this.ingredientes.forEach(ingrediente => {
                const tr = document.createElement("tr");

                const nombreTd = document.createElement("td");
                nombreTd.className = "fw-semibold";
                nombreTd.textContent = ingrediente.nombre;

                const precioTd = document.createElement("td");
                precioTd.textContent = `${Number(ingrediente.precio_extra).toFixed(2)} €`;

                const estadoTd = document.createElement("td");
                const estado = document.createElement("span");
                const activo = Number(ingrediente.activo) === 1;

                estado.textContent = activo ? "Activo" : "Inactivo";
                estadoTd.append(estado);

                const accionesTd = document.createElement("td");
                accionesTd.className = "text-end pe-4";

                const modificarBtn = document.createElement("button");
                modificarBtn.type = "button";
                modificarBtn.className = "btn btn-sm btn-outline-dark rounded-pill";
                modificarBtn.textContent = "Modificar";

                modificarBtn.addEventListener("click", () => {
                    document.getElementById("ingredienteId").value = ingrediente.id;
                    document.getElementById("nombreIngrediente").value = ingrediente.nombre;
                    document.getElementById("precioIngrediente").value = ingrediente.precio_extra;
                    document.getElementById("imagenIngrediente").value = ingrediente.imagen;
                    document.getElementById("activoIngrediente").checked = Number(ingrediente.activo) === 1;

                    document.getElementById("tituloModalIngrediente").textContent = "Modificar ingrediente";

                    this.modalIngrediente.show();
                });

                const eliminarBtn = document.createElement("button");
                eliminarBtn.type = "button";
                eliminarBtn.className = "btn btn-sm btn-outline-danger rounded-pill";
                eliminarBtn.textContent = "Eliminar";

                eliminarBtn.addEventListener("click", () => {
                    const datos = { id: ingrediente.id };

                    fetch("index.php?controller=admin&action=apiIngrediente", {
                        method: "DELETE",
                        headers: {"Content-Type": "application/json"},
                        body: JSON.stringify(datos)
                    })
                    .then(respuesta => respuesta.json())
                    .then(r => {
                        if (r.success) {
                            this.cargarIngredientes();
                        }
                    })
                    .catch(error => console.error("Error:", error));
                });

                accionesTd.append(modificarBtn, eliminarBtn);
                tr.append(nombreTd, precioTd, estadoTd, accionesTd);

                tablaIngredientes.append(tr);
            });
        })
        .catch(error => console.error("Error:", error));
    }

    configurarModalIngrediente() {
        this.modalIngrediente = new bootstrap.Modal(document.getElementById("modalIngrediente"));

        const formulario = document.getElementById("formIngrediente");

        document.getElementById("btnAnadirIngrediente").addEventListener("click", () => {
            formulario.reset();
            document.getElementById("ingredienteId").value = "";
            document.getElementById("tituloModalIngrediente").textContent = "Añadir ingrediente";

            this.modalIngrediente.show();
        });

        formulario.addEventListener("submit", (evento) => {
            evento.preventDefault();

            const datos = {
                id: Number(document.getElementById("ingredienteId").value),
                nombre: document.getElementById("nombreIngrediente").value,
                precio_extra: Number(document.getElementById("precioIngrediente").value),
                imagen: document.getElementById("imagenIngrediente").value,
                activo: document.getElementById("activoIngrediente").checked ? 1 : 0
            };

            const id = document.getElementById("ingredienteId").value;
            const metodo = id !== "" ? "PUT" : "POST";

            fetch("index.php?controller=admin&action=apiIngrediente", {
                method: metodo,
                headers: {"Content-Type": "application/json"},
                body: JSON.stringify(datos)
            })
            .then(respuesta => respuesta.json())
            .then(r => {
                if (r.success) {
                    this.modalIngrediente.hide();
                    formulario.reset();
                    this.cargarIngredientes();
                }
            })
            .catch(error => console.error("Error:", error));
        });
    }
}

class Ofertas {
    constructor() {
    }

    cargarOfertas() {
        fetch("index.php?controller=admin&action=apiOferta")
        .then(respuesta => respuesta.json())
        .then(r => {
            this.ofertas = r;

            const tablaOfertas = document.getElementById("ofertas");
            tablaOfertas.innerHTML = "";

            this.ofertas.forEach(oferta => {
                const tr = document.createElement("tr");

                const nombreTd = document.createElement("td");
                nombreTd.className = "fw-semibold";
                nombreTd.textContent = oferta.nombre;

                const tipoTd = document.createElement("td");
                tipoTd.textContent = oferta.tipo;

                const codigoTd = document.createElement("td");
                codigoTd.textContent = oferta.codigo ?? "-";

                const estadoTd = document.createElement("td");
                const estado = document.createElement("span");
                const activa = Number(oferta.activa) === 1;

                estado.textContent = activa ? "Activa" : "Inactiva";
                estadoTd.append(estado);

                const accionesTd = document.createElement("td");
                accionesTd.className = "text-end pe-4";

                const modificarBtn = document.createElement("button");
                modificarBtn.type = "button";
                modificarBtn.className = "btn btn-sm btn-outline-dark rounded-pill";
                modificarBtn.textContent = "Modificar";

                modificarBtn.addEventListener("click", () => {
                    document.getElementById("ofertaId").value = oferta.id;
                    document.getElementById("nombreOferta").value = oferta.nombre;
                    document.getElementById("descripcionOferta").value = oferta.descripcion ?? "";
                    document.getElementById("tipoOferta").value = oferta.tipo;
                    document.getElementById("valorOferta").value = oferta.valor ?? "";
                    document.getElementById("codigoOferta").value = oferta.codigo ?? "";
                    document.getElementById("fechaInicioOferta").value = oferta.fecha_inicio ? oferta.fecha_inicio.replace(" ", "T") : "";
                    document.getElementById("fechaFinOferta").value = oferta.fecha_fin ? oferta.fecha_fin.replace(" ", "T") : "";
                    document.getElementById("activaOferta").checked = Number(oferta.activa) === 1;

                    document.getElementById("tituloModalOferta").textContent = "Modificar oferta";

                    this.modalOferta.show();
                });

                const eliminarBtn = document.createElement("button");
                eliminarBtn.type = "button";
                eliminarBtn.className = "btn btn-sm btn-outline-danger rounded-pill";
                eliminarBtn.textContent = "Eliminar";

                eliminarBtn.addEventListener("click", () => {
                    const datos = { id: oferta.id };

                    fetch("index.php?controller=admin&action=apiOferta", {
                        method: "DELETE",
                        headers: {"Content-Type": "application/json"},
                        body: JSON.stringify(datos)
                    })
                    .then(respuesta => respuesta.json())
                    .then(r => {
                        if (r.success) {
                            this.cargarOfertas();
                        }
                    })
                    .catch(error => console.error("Error:", error));
                });

                accionesTd.append(modificarBtn, eliminarBtn);
                tr.append(nombreTd, tipoTd, codigoTd, estadoTd, accionesTd);

                tablaOfertas.append(tr);
            });
        })
        .catch(error => console.error("Error:", error));
    }

    configurarModalOferta() {
        this.modalOferta = new bootstrap.Modal(document.getElementById("modalOferta"));

        const formulario = document.getElementById("formOferta");

        document.getElementById("btnAnadirOferta").addEventListener("click", () => {
            formulario.reset();
            document.getElementById("ofertaId").value = "";
            document.getElementById("tituloModalOferta").textContent = "Añadir oferta";

            this.modalOferta.show();
        });

        formulario.addEventListener("submit", (evento) => {
            evento.preventDefault();

            const datos = {
                id: Number(document.getElementById("ofertaId").value),
                nombre: document.getElementById("nombreOferta").value,
                descripcion: document.getElementById("descripcionOferta").value,
                tipo: document.getElementById("tipoOferta").value,
                valor: document.getElementById("valorOferta").value !== ""
                    ? Number(document.getElementById("valorOferta").value)
                    : null,
                codigo: document.getElementById("codigoOferta").value,
                fecha_inicio: document.getElementById("fechaInicioOferta").value.replace("T", " "),
                fecha_fin: document.getElementById("fechaFinOferta").value !== ""
                    ? document.getElementById("fechaFinOferta").value.replace("T", " ")
                    : null,
                activa: document.getElementById("activaOferta").checked ? 1 : 0
            };

            const id = document.getElementById("ofertaId").value;
            const metodo = id !== "" ? "PUT" : "POST";

            fetch("index.php?controller=admin&action=apiOferta", {
                method: metodo,
                headers: {"Content-Type": "application/json"},
                body: JSON.stringify(datos)
            })
            .then(respuesta => respuesta.json())
            .then(r => {
                if (r.success) {
                    this.modalOferta.hide();
                    formulario.reset();
                    this.cargarOfertas();
                }
            })
            .catch(error => console.error("Error:", error));
        });
    }
}

class Pedidos {
    constructor() {
    }

    cargarPedidos() {
        fetch("index.php?controller=admin&action=apiPedido")
        .then(respuesta => respuesta.json())
        .then(r => {
            this.pedidos = r;

            const tablaPedidos = document.getElementById("pedidos");
            tablaPedidos.innerHTML = "";

            this.pedidos.forEach(pedido => {
                const tr = document.createElement("tr");

                const pedidoTd = document.createElement("td");
                pedidoTd.textContent = `#${pedido.id}`;

                const usuarioTd = document.createElement("td");
                usuarioTd.textContent = `Usuario #${pedido.usuario_id}`;

                const fechaTd = document.createElement("td");
                fechaTd.textContent = pedido.fecha_pedido;

                const totalTd = document.createElement("td");
                totalTd.textContent = `${Number(pedido.total).toFixed(2)} €`;

                const estadoTd = document.createElement("td");
                const estado = document.createElement("span");

                estado.textContent = pedido.estado;
                estadoTd.append(estado);

                const accionesTd = document.createElement("td");
                accionesTd.className = "text-end pe-4";

                const modificarBtn = document.createElement("button");
                modificarBtn.type = "button";
                modificarBtn.className = "btn btn-sm btn-outline-dark rounded-pill";
                modificarBtn.textContent = "Modificar";

                modificarBtn.addEventListener("click", () => {
                    document.getElementById("pedidoId").value = pedido.id;
                    document.getElementById("usuarioPedido").value = `Usuario #${pedido.usuario_id}`;
                    document.getElementById("fechaPedido").value = pedido.fecha_pedido;
                    document.getElementById("subtotalPedido").value = `${Number(pedido.subtotal).toFixed(2)} €`;
                    document.getElementById("descuentoPedido").value = `${Number(pedido.descuento).toFixed(2)} €`;
                    document.getElementById("totalPedido").value = `${Number(pedido.total).toFixed(2)} €`;
                    document.getElementById("estadoPedido").value = pedido.estado;
                    document.getElementById("estadoPagoPedido").value = pedido.estado_pago;
                    document.getElementById("metodoPagoPedido").value = pedido.metodo_pago;

                    this.modalPedido.show();
                });

                accionesTd.append(modificarBtn);
                tr.append(pedidoTd, usuarioTd, fechaTd, totalTd, estadoTd, accionesTd);

                tablaPedidos.append(tr);
            });
        })
        .catch(error => console.error("Error:", error));
    }

    configurarModalPedido() {
        this.modalPedido = new bootstrap.Modal(document.getElementById("modalPedido"));

        const formulario = document.getElementById("formPedido");

        formulario.addEventListener("submit", (evento) => {
            evento.preventDefault();

            const datos = {
                id: Number(document.getElementById("pedidoId").value),
                estado: document.getElementById("estadoPedido").value,
                estado_pago: document.getElementById("estadoPagoPedido").value
            };

            fetch("index.php?controller=admin&action=apiPedido", {
                method: "PUT",
                headers: {"Content-Type": "application/json"},
                body: JSON.stringify(datos)
            })
            .then(respuesta => respuesta.json())
            .then(r => {
                if (r.success) {
                    this.modalPedido.hide();
                    this.cargarPedidos();
                }
            })
            .catch(error => console.error("Error:", error));
        });
    }
}

class Usuarios {
    constructor() {
    }

    cargarUsuarios() {
        fetch("index.php?controller=admin&action=apiUsuario")
        .then(respuesta => respuesta.json())
        .then(r => {
            this.usuarios = r;

            const tablaUsuarios = document.getElementById("usuarios");
            tablaUsuarios.innerHTML = "";

            this.usuarios.forEach(usuario => {
                const tr = document.createElement("tr");

                const nombreTd = document.createElement("td");
                nombreTd.className = "fw-semibold";
                nombreTd.textContent = usuario.nombre;

                const emailTd = document.createElement("td");
                emailTd.textContent = usuario.email;

                const rolTd = document.createElement("td");
                rolTd.textContent = usuario.rol;

                const registroTd = document.createElement("td");
                registroTd.textContent = usuario.fecha_registro;

                const accionesTd = document.createElement("td");
                accionesTd.className = "text-end pe-4";

                const modificarBtn = document.createElement("button");
                modificarBtn.type = "button";
                modificarBtn.className = "btn btn-sm btn-outline-dark rounded-pill";
                modificarBtn.textContent = "Modificar";

                modificarBtn.addEventListener("click", () => {
                    document.getElementById("usuarioId").value = usuario.id;
                    document.getElementById("nombreUsuario").value = usuario.nombre;
                    document.getElementById("emailUsuario").value = usuario.email;
                    document.getElementById("telefonoUsuario").value = usuario.telefono ?? "";
                    document.getElementById("direccionUsuario").value = usuario.direccion ?? "";
                    document.getElementById("fechaNacimientoUsuario").value = usuario.fecha_nacimiento ?? "";
                    document.getElementById("rolUsuario").value = usuario.rol;

                    this.modalUsuario.show();
                });

                accionesTd.append(modificarBtn);
                tr.append(nombreTd, emailTd, rolTd, registroTd, accionesTd);

                tablaUsuarios.append(tr);
            });
        })
        .catch(error => console.error("Error:", error));
    }

    configurarModalUsuario() {
        this.modalUsuario = new bootstrap.Modal(document.getElementById("modalUsuario"));

        const formulario = document.getElementById("formUsuario");

        formulario.addEventListener("submit", (evento) => {
            evento.preventDefault();

            const datos = {
                id: Number(document.getElementById("usuarioId").value),
                nombre: document.getElementById("nombreUsuario").value,
                email: document.getElementById("emailUsuario").value,
                telefono: document.getElementById("telefonoUsuario").value,
                direccion: document.getElementById("direccionUsuario").value,
                fecha_nacimiento: document.getElementById("fechaNacimientoUsuario").value || null,
                rol: document.getElementById("rolUsuario").value
            };

            fetch("index.php?controller=admin&action=apiUsuario", {
                method: "PUT",
                headers: {"Content-Type": "application/json"},
                body: JSON.stringify(datos)
            })
            .then(respuesta => respuesta.json())
            .then(r => {
                if (r.success) {
                    this.modalUsuario.hide();
                    this.cargarUsuarios();
                }
            })
            .catch(error => console.error("Error:", error));
        });
    }
}

new AdminVista();