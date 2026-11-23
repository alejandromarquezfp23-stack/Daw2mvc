class AdminVista {
    constructor() {
        document.addEventListener('DOMContentLoaded', () => this.inicializar());
    }

    inicializar() {
        this.configurarPestanas();
        this.configurarModalProducto();

        this.cargarProductos();
        this.cargarCategorias();
        this.cargarIngredientes();
        this.cargarOfertas();
        this.cargarPedidos();
        this.cargarUsuarios();
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

    cargarProductos() {
        fetch("http://localhost/daw2mvc/index.php?controller=admin&action=apiProducto")
        .then(respuesta => respuesta.json())
        .then(r => {
            this.productos = r;
            const tablaProductos = document.getElementById("productos");
            tablaProductos.replaceChildren();

            this.productos.forEach(producto => {
                const tr = document.createElement("tr");

                const productoTd = document.createElement("td");
                productoTd.className = "ps-4 py-3 fw-semibold";
                productoTd.textContent = producto.nombre;

                const categoriaTd = document.createElement("td");
                categoriaTd.textContent = producto.categoria_id;

                const precioTd = document.createElement("td");
                precioTd.textContent = `${Number(producto.precio).toFixed(2)} €`;

                const estadoTd = document.createElement("td");
                const estado = document.createElement("span");
                const activo = Number(producto.activo) === 1;
                estado.className = `badge rounded-pill text-bg-${activo ? "success" : "secondary"}`;
                estado.textContent = activo ? "Activo" : "Inactivo";
                estadoTd.append(estado);

                const accionesTd = document.createElement("td");
                accionesTd.className = "text-end pe-4";

                const modificarBtn = document.createElement("button");
                modificarBtn.type = "button";
                modificarBtn.className = "btn btn-sm btn-outline-dark rounded-pill me-2";
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
                    fetch("http://localhost/daw2mvc/index.php?controller=admin&action=apiProducto", {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json"
                        },
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
    }

    cargarCategorias() {
        fetch("http://localhost/daw2mvc/index.php?controller=admin&action=apiCategoria")
        .then(respuesta => respuesta.json())
        .then(r => {
            this.categorias = r;

            const selector = document.getElementById("categoriaProducto");
            this.categorias.forEach(categoria => {
                if (Number(categoria.activa) === 1) {
                    const opcion = document.createElement("option");

                    opcion.value = categoria.id;
                    opcion.textContent = categoria.nombre;

                    selector.append(opcion);
                }
            });

            const tablaCategorias = document.getElementById("categorias");
            tablaCategorias.replaceChildren();

            this.categorias.forEach(categoria => {
                const tr = document.createElement("tr");

                const categoriaTd = document.createElement("td");
                categoriaTd.className = "ps-4 py-3 fw-semibold";
                categoriaTd.textContent = categoria.nombre;

                const descripcionTd = document.createElement("td");
                descripcionTd.textContent = categoria.descripcion;

                const estadoTd = document.createElement("td");
                const estado = document.createElement("span");
                const activa = Number(categoria.activa) === 1;
                estado.className = `badge rounded-pill text-bg-${activa ? "success" : "secondary"}`;
                estado.textContent = activa ? "Activa" : "Inactiva";
                estadoTd.append(estado);

                const accionesTd = document.createElement("td");
                accionesTd.className = "text-end pe-4";

                const modificarBtn = document.createElement("button");
                modificarBtn.type = "button";
                modificarBtn.className = "btn btn-sm btn-outline-dark rounded-pill me-2";
                modificarBtn.textContent = "Modificar";

                const eliminarBtn = document.createElement("button");
                eliminarBtn.type = "button";
                eliminarBtn.className = "btn btn-sm btn-outline-danger rounded-pill";
                eliminarBtn.textContent = "Eliminar";

                accionesTd.append(modificarBtn, eliminarBtn);
                tr.append(categoriaTd, descripcionTd, estadoTd, accionesTd);
                tablaCategorias.append(tr);
            });
        })
    }

    cargarIngredientes() {
        fetch("http://localhost/daw2mvc/index.php?controller=admin&action=apiIngrediente")
        .then(respuesta => respuesta.json())
        .then(r => {
            this.ingredientes = r;
            const tablaIngredientes = document.getElementById("ingredientes");
            tablaIngredientes.replaceChildren();

            this.ingredientes.forEach(ingrediente => {
                const tr = document.createElement("tr");

                const nombreTd = document.createElement("td");
                nombreTd.className = "ps-4 py-3 fw-semibold";
                nombreTd.textContent = ingrediente.nombre;

                const precioTd = document.createElement("td");
                precioTd.textContent = `${Number(ingrediente.precio_extra).toFixed(2)} €`;

                const estadoTd = document.createElement("td");
                const estado = document.createElement("span");
                const activo = Number(ingrediente.activo) === 1;
                estado.className = `badge rounded-pill text-bg-${activo ? "success" : "secondary"}`;
                estado.textContent = activo ? "Activo" : "Inactivo";
                estadoTd.append(estado);

                const accionesTd = document.createElement("td");
                accionesTd.className = "text-end pe-4";

                const modificarBtn = document.createElement("button");
                modificarBtn.type = "button";
                modificarBtn.className = "btn btn-sm btn-outline-dark rounded-pill me-2";
                modificarBtn.textContent = "Modificar";

                const eliminarBtn = document.createElement("button");
                eliminarBtn.type = "button";
                eliminarBtn.className = "btn btn-sm btn-outline-danger rounded-pill";
                eliminarBtn.textContent = "Eliminar";

                accionesTd.append(modificarBtn, eliminarBtn);
                tr.append(nombreTd, precioTd, estadoTd, accionesTd);
                tablaIngredientes.append(tr);
            });
        })
    }

    cargarOfertas() {
        fetch("http://localhost/daw2mvc/index.php?controller=admin&action=apiOferta")
        .then(respuesta => respuesta.json())
        .then(r => {
            this.ofertas = r;
            const tablaOfertas = document.getElementById("ofertas");
            tablaOfertas.replaceChildren();

            this.ofertas.forEach(oferta => {
                const tr = document.createElement("tr");

                const nombreTd = document.createElement("td");
                nombreTd.className = "ps-4 py-3 fw-semibold";
                nombreTd.textContent = oferta.nombre;

                const tipoTd = document.createElement("td");
                tipoTd.textContent = oferta.tipo;

                const codigoTd = document.createElement("td");
                codigoTd.textContent = oferta.codigo;

                const estadoTd = document.createElement("td");
                const estado = document.createElement("span");
                const activa = Number(oferta.activa) === 1;
                estado.className = `badge rounded-pill text-bg-${activa ? "success" : "secondary"}`;
                estado.textContent = activa ? "Activa" : "Inactiva";
                estadoTd.append(estado);

                const accionesTd = document.createElement("td");
                accionesTd.className = "text-end pe-4";

                const modificarBtn = document.createElement("button");
                modificarBtn.type = "button";
                modificarBtn.className = "btn btn-sm btn-outline-dark rounded-pill me-2";
                modificarBtn.textContent = "Modificar";

                const eliminarBtn = document.createElement("button");
                eliminarBtn.type = "button";
                eliminarBtn.className = "btn btn-sm btn-outline-danger rounded-pill";
                eliminarBtn.textContent = "Eliminar";

                accionesTd.append(modificarBtn, eliminarBtn);
                tr.append(nombreTd, tipoTd, codigoTd, estadoTd, accionesTd);
                tablaOfertas.append(tr);
            });
        })
    }

    cargarPedidos() {
        fetch("http://localhost/daw2mvc/index.php?controller=admin&action=apiPedido")
        .then(respuesta => respuesta.json())
        .then(r => {
            this.pedidos = r;
            const tablaPedidos = document.getElementById("pedidos");
            tablaPedidos.replaceChildren();

            this.pedidos.forEach(pedido => {
                const tr = document.createElement("tr");

                const pedidoTd = document.createElement("td");
                pedidoTd.className = "ps-4 py-3 fw-semibold";
                pedidoTd.textContent = `#${pedido.id}`;

                const usuarioTd = document.createElement("td");
                usuarioTd.textContent = `Usuario #${pedido.usuario_id}`;

                const fechaTd = document.createElement("td");
                fechaTd.textContent = pedido.fecha_pedido;

                const totalTd = document.createElement("td");
                totalTd.textContent = `${Number(pedido.total).toFixed(2)} €`;

                const estadoTd = document.createElement("td");
                const estado = document.createElement("span");
                estado.className = "badge rounded-pill text-bg-secondary";
                estado.textContent = pedido.estado;
                estadoTd.append(estado);

                const accionesTd = document.createElement("td");
                accionesTd.className = "text-end pe-4";

                const modificarBtn = document.createElement("button");
                modificarBtn.type = "button";
                modificarBtn.className = "btn btn-sm btn-outline-dark rounded-pill me-2";
                modificarBtn.textContent = "Modificar";

                const eliminarBtn = document.createElement("button");
                eliminarBtn.type = "button";
                eliminarBtn.className = "btn btn-sm btn-outline-danger rounded-pill";
                eliminarBtn.textContent = "Eliminar";

                accionesTd.append(modificarBtn, eliminarBtn);
                tr.append(pedidoTd, usuarioTd, fechaTd, totalTd, estadoTd, accionesTd);
                tablaPedidos.append(tr);
            });
        })
    }

    cargarUsuarios() {
        fetch("http://localhost/daw2mvc/index.php?controller=admin&action=apiUsuario")
        .then(respuesta => respuesta.json())
        .then(r => {
            this.usuarios = r;
            const tablaUsuarios = document.getElementById("usuarios");
            tablaUsuarios.replaceChildren();

            this.usuarios.forEach(usuario => {
                const tr = document.createElement("tr");

                const nombreTd = document.createElement("td");
                nombreTd.className = "ps-4 py-3 fw-semibold";
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
                modificarBtn.className = "btn btn-sm btn-outline-dark rounded-pill me-2";
                modificarBtn.textContent = "Modificar";

                const eliminarBtn = document.createElement("button");
                eliminarBtn.type = "button";
                eliminarBtn.className = "btn btn-sm btn-outline-danger rounded-pill";
                eliminarBtn.textContent = "Eliminar";

                accionesTd.append(modificarBtn, eliminarBtn);
                tr.append(nombreTd, emailTd, rolTd, registroTd, accionesTd);
                tablaUsuarios.append(tr);
            });
        })
    }

    configurarModalProducto() {
        this.modalProducto = new bootstrap.Modal(
            document.getElementById("modalProducto")
        );

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

            if(id !== "") {
                fetch("http://localhost/daw2mvc/index.php?controller=admin&action=apiProducto", {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json"
                    },
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

            } else {
                fetch("http://localhost/daw2mvc/index.php?controller=admin&action=apiProducto", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
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
            }
        });
    }

}

new AdminVista();