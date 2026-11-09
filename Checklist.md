# CHECKLIST -- PROYECTO 1: RESTAURANTE (APPLETITO)

## 1. Análisis y planificación

-   [x] Leer y analizar todos los requisitos del proyecto.
-   [x] Definir las funcionalidades de la aplicación.
-   [x] Definir los roles de usuario y administrador.
-   [x] Organizar las tareas y fases de desarrollo.
-   [x] Definir la estructura MVC del proyecto.

## 2. Diseño y prototipado

-   [x] Crear un moodboard que defina colores, formas, tipografía y
    composición.
-   [x] Diseñar el prototipo de escritorio (1080 px).
-   [x] Diseñar el prototipo responsive para móvil (430 × 932 px).
-   [x] Diseñar la página Home con header, cuatro secciones de
    información (o banner y tres secciones) y footer.
-   [x] Diseñar la página de productos o carta.
-   [x] Diseñar la página de detalle de producto.
-   [x] Diseñar las páginas del proceso de compra.
-   [x] Seleccionar y preparar las imágenes de la web.
-   [x] Definir y aplicar una tipografía adecuada.
-   [x] Aplicar el principio de semejanza.
-   [x] Aplicar el principio de continuidad.
-   [x] Aplicar el principio de simetría.
-   [x] Aplicar el principio de proximidad.
-   [x] Aplicar el principio de contraste.

## 3. Desarrollo de la web (PHP, HTML, CSS y Bootstrap)

### Estructura y arquitectura

-   [x] Organizar el proyecto siguiendo el patrón
    Modelo-Vista-Controlador (MVC).
-   [x] Crear los modelos necesarios.
-   [x] Crear los DAO necesarios para acceder a la base de datos.
-   [x] Crear los controladores necesarios.
-   [x] Crear las vistas de la aplicación.
-   [x] Implementar correctamente la integración PHP-HTML.
-   [x] Aplicar programación orientada a objetos mediante clases,
    polimorfismo y clases estáticas adicionales.
-   [x] Mantener el código comentado, optimizado, legible y con una
    estructura lógica.

### Página web y navegación

-   [x] Desarrollar el header y la navegación.
-   [x] Desarrollar la página Home.
-   [x] Desarrollar la página de productos o carta.
-   [x] Desarrollar la página de detalle de cada producto.
-   [ ] Desarrollar las diferentes páginas del proceso de compra.
-   [x] Desarrollar el footer.
-   [x] Adaptar la página Home a escritorio y móvil.

### Registro, inicio y cierre de sesión

-   [x] Implementar el registro de usuarios.
-   [x] Implementar el inicio de sesión.
-   [x] Utilizar sesiones PHP para mantener la sesión iniciada durante
    la navegación.
-   [ ] Restringir la finalización de compras a usuarios con sesión
    iniciada.
-   [x] Implementar el cierre de sesión.

### Productos, ingredientes y carrito

-   [x] Mostrar los productos disponibles.
-   [x] Permitir consultar el detalle de cada producto.
-   [x] Mostrar los ingredientes de cada producto.
-   [ ] Permitir añadir ingredientes a un producto.
-   [ ] Permitir eliminar ingredientes de un producto.
-   [ ] Actualizar el precio del producto según los ingredientes
    añadidos o eliminados.
-   [x] Implementar el carrito de compra.
-   [x] Permitir consultar los productos del carrito.
-   [ ] Permitir modificar los productos del carrito.
-   [x] Permitir eliminar productos del carrito.
-   [x] Actualizar el precio del pedido al modificar los productos.
-   [ ] Mostrar las ofertas disponibles.
-   [ ] Permitir añadir ofertas al carrito.
-   [ ] Diseñar diferentes ofertas individualmente.
-   [ ] Mostrar el precio final y los impuestos durante el proceso de
    compra.
-   [ ] Permitir confirmar y finalizar el pedido.

### Pedidos y cuenta de usuario

-   [ ] Guardar los pedidos realizados en la base de datos.
-   [ ] Mostrar los datos del último pedido cuando el usuario vuelva a
    acceder a la aplicación.
-   [ ] Permitir consultar los datos personales del usuario.
-   [ ] Permitir modificar los datos personales del usuario.
-   [ ] Permitir consultar el historial de pedidos del usuario.

## 4. Panel de administración

### Acceso y comunicación con la API

-   [ ] Crear el rol de administrador.
-   [ ] Implementar el inicio de sesión del administrador mediante un
    endpoint de la API.
-   [ ] Desarrollar los endpoints de la API utilizando PHP.
-   [ ] Desarrollar el panel exclusivamente con HTML, CSS y JavaScript.
-   [ ] Implementar la comunicación asíncrona entre el panel y el
    backend.
-   [ ] Gestionar la sesión del administrador mediante localStorage o
    sessionStorage.

### Gestión de productos

-   [ ] Listar los productos.
-   [ ] Modificar los productos.
-   [ ] Ordenar los productos.
-   [ ] Filtrar productos por nombre.
-   [ ] Filtrar productos por ID.
-   [ ] Filtrar productos por precio.
-   [ ] Añadir productos.
-   [ ] Eliminar productos.

### Gestión de pedidos

-   [ ] Listar los pedidos.
-   [ ] Ordenar los pedidos.
-   [ ] Filtrar pedidos por diferentes campos.
-   [ ] Añadir productos a un pedido.
-   [ ] Eliminar productos de un pedido.
-   [ ] Modificar el precio final de un pedido.

### Gestión de usuarios

-   [ ] Listar los usuarios registrados.
-   [ ] Consultar el historial de pedidos de cada usuario.

### Requisitos técnicos del panel

-   [ ] Utilizar el DOM para obtener, crear y modificar elementos HTML
    dinámicamente.
-   [ ] Gestionar las acciones del usuario mediante eventos de
    JavaScript.
-   [ ] Utilizar funciones de orden superior como map, filter y reduce.
-   [ ] Crear un mínimo de dos clases JavaScript.
-   [ ] Crear una clase específica para gestionar las diferentes vistas
    del panel.
-   [ ] Cambiar entre vistas sin recargar la página.
-   [ ] Utilizar localStorage o sessionStorage para almacenar la sesión.
-   [ ] Utilizar storage una segunda vez para otra funcionalidad y
    justificar su uso.
-   [ ] Utilizar fetch o axios para enviar y recibir datos de forma
    asíncrona.
-   [ ] Comprobar que las acciones del panel no requieren recargar la
    página.

## 5. Base de datos y Docker

-   [x] Diseñar el diagrama entidad-relación.
-   [x] Diseñar el diagrama relacional.
-   [x] Crear la base de datos.
-   [x] Crear las tablas necesarias.
-   [x] Definir las relaciones entre las tablas.
-   [x] Definir las claves primarias y foráneas.
-   [x] Introducir los datos iniciales necesarios.
-   [ ] Configurar la base de datos dentro de un contenedor Docker.
-   [ ] Comprobar la conexión entre PHP y MySQL.
-   [ ] Comprobar que todas las funcionalidades guardan y recuperan
    correctamente los datos.

## 6. Servicios web y entorno de desarrollo

-   [ ] Instalar y configurar los plugins necesarios en el IDE.
-   [ ] Configurar el entorno de ejecución local.
-   [ ] Instalar y configurar el depurador de PHP.
-   [ ] Seleccionar un servidor web.
-   [ ] Configurar y administrar el servidor web.
-   [ ] Configurar el acceso FTP para subir los sitios locales.
-   [ ] Configurar un dominio público.
-   [ ] Comprobar que la aplicación funciona correctamente en el entorno
    de despliegue.

## 7. Git y GitHub

-   [x] Crear el repositorio de GitHub.
-   [x] Subir el código fuente del proyecto.
-   [x] Subir la base de datos.
-   [x] Subir la documentación del proyecto.
-   [x] Crear ramas de trabajo por funcionalidades, tareas o
    correcciones.
-   [x] Evitar trabajar directamente sobre la rama main.
-   [x] Realizar commits de los cambios realizados.
-   [x] Fusionar correctamente las ramas de trabajo con main.
-   [x] Comprobar que todos los cambios están subidos al repositorio.
-   [x] Dar acceso a todos los profesores al repositorio.
-   [x] Añadir el enlace del repositorio a la entrega.

## 8. Pruebas y comprobaciones finales

-   [x] Comprobar el registro y el inicio de sesión.
-   [x] Comprobar el funcionamiento de las sesiones PHP.
-   [x] Comprobar el funcionamiento del carrito.
-   [ ] Comprobar la modificación de ingredientes y precios.
-   [ ] Comprobar las ofertas.
-   [ ] Comprobar la finalización de pedidos.
-   [ ] Comprobar la consulta del último pedido.
-   [ ] Comprobar la modificación de los datos del usuario.
-   [ ] Comprobar el acceso y las funcionalidades del administrador.
-   [ ] Comprobar todos los endpoints de la API.
-   [ ] Comprobar que el panel funciona sin recargar la página.
-   [x] Comprobar la adaptación responsive de la web.
-   [x] Revisar posibles errores de PHP, JavaScript, HTML y CSS.
-   [ ] Comprobar que el proyecto funciona correctamente en el servidor.

## 9. Documentación y memoria final

-   [ ] Crear la portada de la memoria.
-   [ ] Crear el índice.
-   [ ] Redactar la introducción del proyecto.
-   [ ] Explicar los objetivos y funcionalidades de la aplicación.
-   [ ] Documentar la estructura MVC.
-   [ ] Incluir el diagrama de clases y explicar cómo interactúan las
    clases.
-   [ ] Incluir el diagrama entidad-relación.
-   [ ] Incluir el diagrama relacional.
-   [ ] Documentar el diseño y el prototipado.
-   [ ] Documentar el desarrollo de la aplicación.
-   [ ] Documentar el funcionamiento del panel de administración.
-   [ ] Documentar la API y sus endpoints.
-   [ ] Documentar la instalación y configuración de Docker.
-   [ ] Documentar los servicios web y el despliegue.
-   [ ] Documentar el uso de Git y GitHub.
-   [ ] Añadir capturas de pantalla del proyecto.
-   [ ] Añadir la bibliografía o webgrafía.
-   [ ] Añadir los anexos necesarios.
-   [ ] Revisar la ortografía, el vocabulario y la estructura de la
    memoria.
-   [ ] Entregar la memoria final junto con el proyecto.

## 10. Presentación del proyecto

-   [ ] Preparar una explicación general del proyecto.
-   [ ] Preparar una demostración de las funcionalidades de la web.
-   [ ] Preparar una demostración del panel de administración.
-   [ ] Explicar la arquitectura MVC.
-   [ ] Explicar el funcionamiento de la base de datos y Docker.
-   [ ] Explicar las tecnologías utilizadas.
-   [ ] Comprobar que todo funciona antes de la presentación.
