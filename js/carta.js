let animacionActual = null;

function desplazarProductos(direccion) {
    const productos = document.querySelector('.divProductos');
    const inicio = productos.scrollLeft;
    const distanciaMaxima = productos.scrollWidth - productos.clientWidth;
    const destino = Math.max(0, Math.min(inicio + direccion * 350, distanciaMaxima));
    const duracion = 700;
    let tiempoInicial = null;

    if (animacionActual !== null) {
        cancelAnimationFrame(animacionActual);
    }

    function animar(tiempoActual) {
        if (tiempoInicial === null) {
            tiempoInicial = tiempoActual;
        }

        let progreso = Math.min((tiempoActual - tiempoInicial) / duracion, 1);
        let suavizado = 1 - Math.pow(1 - progreso, 4);

        productos.scrollLeft = inicio + (destino - inicio) * suavizado;

        if (progreso < 1) {
            animacionActual = requestAnimationFrame(animar);
        } else {
            animacionActual = null;
            actualizarFlechas();
        }
    }

    animacionActual = requestAnimationFrame(animar);
}

const productos = document.querySelector('.divProductos');
const izquierda = document.querySelector('.flecha-izquierda');
const derecha = document.querySelector('.flecha-derecha');

function actualizarFlechas() {
    const posicion = productos.scrollLeft;
    const maximo = productos.scrollWidth - productos.clientWidth;

    izquierda.classList.toggle('flecha-oculta', posicion < maximo - 1);
    derecha.classList.toggle('flecha-oculta', posicion >= maximo - 1);
}

productos.addEventListener('scroll', actualizarFlechas);
window.addEventListener('resize', actualizarFlechas);

const observador = new ResizeObserver(actualizarFlechas);
observador.observe(productos);

actualizarFlechas();