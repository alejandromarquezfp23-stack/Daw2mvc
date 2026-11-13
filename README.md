# Daw2mvc / Appletito

Proyecto de una aplicación web de restaurante desarrollada en PHP con arquitectura MVC propia (sin framework). La app permite consultar la carta, ver detalles de los productos, añadirlos al carrito, gestionar favoritos y completar un pedido.

## Descripción

Appletito es una práctica de desarrollo web enfocada en:

- Separación por capas MVC
- Acceso a datos mediante clases DAO
- Enrutado por query string
- Gestión de productos, usuarios, pedidos y carrito
- Interfaz con HTML, CSS y JavaScript

## Requisitos

- PHP 8.2 o superior
- Extensión `mysqli` habilitada
- MySQL o MariaDB
- XAMPP, WAMP o cualquier entorno con Apache + MySQL
- Opcional: Docker para levantar la base de datos

## Puesta en marcha

### Opción 1: XAMPP / Apache + MySQL local

1. Clona o descarga el proyecto en la carpeta `htdocs` de XAMPP.
2. Crea la base de datos importando el archivo `sql/init.sql`:

   ```bash
   mysql -u root -p < sql/init.sql
   ```

   o bien importalo desde phpMyAdmin.

3. Comprueba la configuración de la conexión en `config/DataBase.php`.

   Por defecto la app usa:

   - host: `127.0.0.1`
   - usuario: `root`
   - contraseña: `root`
   - puerto: `3308`
   - base de datos: `daw2mvc`

   Ajusta estos valores si tu instalación usa otros datos.

4. Inicia Apache y MySQL en XAMPP.
5. Abre la aplicación en el navegador:

   ```text
   http://localhost/Daw2mvc/index.php?controller=home
   ```

   La aplicación calcula la URL base automáticamente a partir de la instalación, así que también funciona correctamente en otros servidores web.

### Opción 2: Docker

El repositorio incluye un `compose.yaml` que levanta la base de datos MySQL con el script `sql/init.sql` inicializado automáticamente al crear el volumen por primera vez.

```bash
docker compose up -d db
```

Ten en cuenta que este proyecto no incluye todavía un servicio web PHP en Docker Compose; si quieres ejecutar la app entera con Docker, tendrás que añadir un contenedor con Apache/PHP y montarlo sobre este proyecto. Para la práctica actual, lo más habitual es usar XAMPP o un servidor local con PHP + MySQL.

Si el volumen de MySQL ya existía antes, es posible que el script `init.sql` no vuelva a ejecutarse automáticamente. En ese caso, importa el SQL manualmente.

## Estructura del proyecto

- `index.php`: punto de entrada y enrutador principal.
- `controllers/`: clases que gestionan la lógica por pantalla.
- `models/`: entidades del dominio.
- `dao/`: acceso a datos y consultas SQL.
- `views/`: vistas y componentes de la interfaz.
- `config/`: configuración general y conexión a la base de datos.
- `sql/`: script de creación e inicialización de la base de datos.
- `css/`: estilos de la aplicación.
- `js/`: scripts JavaScript de cliente.
- `imagenes/`: imágenes de productos, categorías y otros recursos.
- `iconos/`: iconos utilizados en cabeceras y pie de página.

## Enrutado

La app utiliza el controlador y la acción por parámetros en la URL. Los nombres que aparecen en la URL son los que realmente usa el proyecto, y no coinciden exactamente con los nombres de archivo en el disco.

### Controladores reales del proyecto

- `home` → `HomeController` (`views/home.php`)
- `productos` → `ProductosController` (carta y detalle del producto)
- `producto` → `productoController` (CRUD de ejemplo/gestión directa de productos)
- `carrito` → `CarritoController`
- `usuario` → `UsuarioController`
- `pedidos` → `PedidosController`
- `favoritos` → `FavoritosController`

### Ejemplos de rutas usadas por la app

- Inicio: `?controller=home`
- Carta: `?controller=productos`
- Detalle del producto: `?controller=productos&action=show&id=123`
- Carrito: `?controller=carrito`
- Login / perfil: `?controller=usuario&action=login` o `?controller=usuario&action=show`
- Pedido: `?controller=pedidos&action=create`

La configuración por defecto está en `config/parameters.php` y define:

- `default_controller = "home"`
- `default_action = "index"`

Importante: no existe `cartaController` ni `detalleproductoController` en este proyecto; la app usa `productos` para la carta y `productos&action=show` para el detalle.
## Datos de la base de datos

La base de datos por defecto se llama `daw2mvc` y se inicializa con el archivo `sql/init.sql`.

Si cambias la configuración en `config/DataBase.php`, asegúrate de que coincida con la base que hayas creado en MySQL/MariaDB.

## Nota importante

Este proyecto está pensado como ejercicio académico para aprender MVC en PHP. La estructura es manual y no usa un framework ni Composer.

Si quieres, puedes ampliar esta información con una sección de funcionalidades detalladas, capturas de pantalla o una guía de contribución.