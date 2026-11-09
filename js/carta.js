const animacionesCarrusel = new WeakMap();

function actualizarFlechas(carrusel) {
    const productos = carrusel.querySelector('.divProductos');
    const flechaIzquierda = carrusel.querySelector('.flecha-izquierda');
    const flechaDerecha = carrusel.querySelector('.flecha-derecha');
    const distanciaMaxima = productos.scrollWidth - productos.clientWidth;

    flechaIzquierda.classList.toggle('flecha-oculta', distanciaMaxima <= 0 || productos.scrollLeft <= 0);
    flechaDerecha.classList.toggle('flecha-oculta', distanciaMaxima <= 0 || productos.scrollLeft >= distanciaMaxima - 1);
}

function inicializarCarruseles() {
    const carruseles = document.querySelectorAll('.carruselProductos');

    carruseles.forEach((carrusel) => {
        const productos = carrusel.querySelector('.divProductos');
        productos.addEventListener('scroll', () => actualizarFlechas(carrusel));
        actualizarFlechas(carrusel);
    });

    window.addEventListener('resize', () => {
        carruseles.forEach(actualizarFlechas);
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', inicializarCarruseles);
} else {
    inicializarCarruseles();
}

function desplazarProductos(boton, direccion) {
    const carrusel = boton.closest('.carruselProductos');
    const productos = carrusel.querySelector('.divProductos');
    const inicio = productos.scrollLeft;
    const distanciaMaxima = productos.scrollWidth - productos.clientWidth;
    const destino = Math.max(0, Math.min(inicio + direccion * 350, distanciaMaxima));
    const duracion = 700;
    let tiempoInicial = null;
    const animacionActual = animacionesCarrusel.get(productos);

    if (animacionActual !== undefined) {
        cancelAnimationFrame(animacionActual);
    }

    function animar(tiempoActual) {
        if (tiempoInicial === null) {
            tiempoInicial = tiempoActual;
        }

        const progreso = Math.min((tiempoActual - tiempoInicial) / duracion, 1);
        const suavizado = 1 - Math.pow(1 - progreso, 4);
        productos.scrollLeft = inicio + (destino - inicio) * suavizado;

        if (progreso < 1) {
            animacionesCarrusel.set(productos, requestAnimationFrame(animar));
        } else {
            animacionesCarrusel.delete(productos);
            actualizarFlechas(carrusel);
        }
    }

    animacionesCarrusel.set(productos, requestAnimationFrame(animar));
}
