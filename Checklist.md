# CHECKLIST -- PROYECTO 1: RESTAURANTE (APPLETITO)

## 1. Análisis y planificación

-   [ ] Leer y analizar todos los requisitos del proyecto.
-   [ ] Definir las funcionalidades de la aplicación.
-   [ ] Definir los roles de usuario y administrador.
-   [ ] Organizar las tareas y fases de desarrollo.
-   [ ] Definir la estructura MVC del proyecto.

## 2. Diseño y prototipado

-   [ ] Crear un moodboard que defina colores, formas, tipografía y
    composición.
-   [ ] Diseñar el prototipo de escritorio (1080 px).
-   [ ] Diseñar el prototipo responsive para móvil (430 × 932 px).
-   [ ] Diseñar la página Home con header, cuatro secciones de
    información (o banner y tres secciones) y footer.
-   [ ] Diseñar la página de productos o carta.
-   [ ] Diseñar la página de detalle de producto.
-   [ ] Diseñar las páginas del proceso de compra.
-   [ ] Seleccionar y preparar las imágenes de la web.
-   [ ] Definir y aplicar una tipografía adecuada.
-   [ ] Aplicar el principio de semejanza.
-   [ ] Aplicar el principio de continuidad.
-   [ ] Aplicar el principio de simetría.
-   [ ] Aplicar el principio de proximidad.
-   [ ] Aplicar el principio de contraste.

## 3. Desarrollo de la web (PHP, HTML, CSS y Bootstrap)

### Estructura y arquitectura

-   [ ] Organizar el proyecto siguiendo el patrón
    Modelo-Vista-Controlador (MVC).
-   [ ] Crear los modelos necesarios.
-   [ ] Crear los DAO necesarios para acceder a la base de datos.
-   [ ] Crear los controladores necesarios.
-   [ ] Crear las vistas de la aplicación.
-   [ ] Implementar correctamente la integración PHP-HTML.
-   [ ] Aplicar programación orientada a objetos mediante clases,
    polimorfismo y clases estáticas adicionales.
-   [ ] Mantener el código comentado, optimizado, legible y con una
    estructura lógica.

### Página web y navegación

-   [ ] Desarrollar el header y la navegación.
-   [ ] Desarrollar la página Home.
-   [ ] Desarrollar la página de productos o carta.
-   [ ] Desarrollar la página de detalle de cada producto.
-   [ ] Desarrollar las diferentes páginas del proceso de compra.
-   [ ] Desarrollar el footer.
-   [ ] Adaptar la página Home a escritorio y móvil.

### Registro, inicio y cierre de sesión

-   [ ] Implementar el registro de usuarios.
-   [ ] Implementar el inicio de sesión.
-   [ ] Utilizar sesiones PHP para mantener la sesión iniciada durante
    la navegación.
-   [ ] Restringir la finalización de compras a usuarios con sesión
    iniciada.
-   [ ] Implementar el cierre de sesión.

### Productos, ingredientes y carrito

-   [ ] Mostrar los productos disponibles.
-   [ ] Permitir consultar el detalle de cada producto.
-   [ ] Mostrar los ingredientes de cada producto.
-   [ ] Permitir añadir ingredientes a un producto.
-   [ ] Permitir eliminar ingredientes de un producto.
-   [ ] Actualizar el precio del producto según los ingredientes
    añadidos o eliminados.
-   [ ] Implementar el carrito de compra.
-   [ ] Permitir consultar los productos del carrito.
-   [ ] Permitir modificar los productos del carrito.
-   [ ] Permitir eliminar productos del carrito.
-   [ ] Actualizar el precio del pedido al modificar los productos.
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

-   [ ] Diseñar el diagrama entidad-relación.
-   [ ] Diseñar el diagrama relacional.
-   [ ] Crear la base de datos.
-   [ ] Crear las tablas necesarias.
-   [ ] Definir las relaciones entre las tablas.
-   [ ] Definir las claves primarias y foráneas.
-   [ ] Introducir los datos iniciales necesarios.
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

-   [ ] Crear el repositorio de GitHub.
-   [ ] Subir el código fuente del proyecto.
-   [ ] Subir la base de datos.
-   [ ] Subir la documentación del proyecto.
-   [ ] Crear ramas de trabajo por funcionalidades, tareas o
    correcciones.
-   [ ] Evitar trabajar directamente sobre la rama main.
-   [ ] Realizar commits de los cambios realizados.
-   [ ] Fusionar correctamente las ramas de trabajo con main.
-   [ ] Comprobar que todos los cambios están subidos al repositorio.
-   [ ] Dar acceso a todos los profesores al repositorio.
-   [ ] Añadir el enlace del repositorio a la entrega.

## 8. Pruebas y comprobaciones finales

-   [ ] Comprobar el registro y el inicio de sesión.
-   [ ] Comprobar el funcionamiento de las sesiones PHP.
-   [ ] Comprobar el funcionamiento del carrito.
-   [ ] Comprobar la modificación de ingredientes y precios.
-   [ ] Comprobar las ofertas.
-   [ ] Comprobar la finalización de pedidos.
-   [ ] Comprobar la consulta del último pedido.
-   [ ] Comprobar la modificación de los datos del usuario.
-   [ ] Comprobar el acceso y las funcionalidades del administrador.
-   [ ] Comprobar todos los endpoints de la API.
-   [ ] Comprobar que el panel funciona sin recargar la página.
-   [ ] Comprobar la adaptación responsive de la web.
-   [ ] Revisar posibles errores de PHP, JavaScript, HTML y CSS.
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
