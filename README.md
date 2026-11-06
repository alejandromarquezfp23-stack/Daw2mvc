# Daw2mvc/Appletito

Proyecto de una web de restaurante en PHP, creado para practicar el patrón MVC sin framework. Permite consultar la carta y los productos, y gestionar un carrito.

## Requisitos

- PHP 8.2 o superior con la extensión `mysqli`
- MySQL o MariaDB

## Puesta en marcha

1. Importa `sql/init.sql` desde phpMyAdmin o ejecuta:

   ```bash
   mysql -u root -p < sql/init.sql
   ```

   El volcado crea la base `daw2mvc` y reemplaza las tablas existentes.

2. Comprueba los datos de conexión en `config/dataBase.php`. Por defecto usa `root`, contraseña `root` y puerto `3308`; ajústalos a tu instalación de MySQL.

3. En XAMPP, coloca el proyecto en `htdocs` e inicia Apache y MySQL. La URL base está en `config/parameters.php`; por defecto es `http://localhost/Daw2mvc/`.

## Estructura

- `index.php`: punto de entrada y enrutador.
- `controllers/`: controladores.
- `models/` y `dao/`: entidades y acceso a datos.
- `views/`: páginas y componentes visuales.
- `config/`: configuración y conexión a la base de datos.
- `sql/`: inicialización de la base de datos.
- `css/`: CSS de las páginas.
- `js/`: JavaScript de las páginas.
- `imagenes/`: imágenes de las páginas.
- `iconos/`: iconos de las cabeceras y los pies de página; algunos también se usan en otras páginas.

El enrutador recibe el controlador y la acción por parámetros. Por ejemplo:

- Inicio: `?controller=home`
- Carta: `?controller=carta`
- Detalle del producto `?controller=detalleproducto`
- Carrito: `?controller=carrito`
- Productos: `?controller=producto`