<?php
require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/productos.php';

    class productosDAO {
        public static function selectAll() {
            $sql = 'SELECT * FROM productos';
            $conexion = DataBase::connect();
            $consulta = $conexion->query($sql);
            $productos = [];
            while ($producto = $consulta->fetch_object('productos')) {
                $productos[] = $producto;
            }
            $consulta->close();
            $conexion->close();

            return $productos;
        }
        
        public static function selectByID($id) {
            $sql = 'SELECT id, categoria_id, nombre, descripcion, precio, imagen, activo FROM productos WHERE id = ?';
            $conexion = DataBase::connect();
            $consulta = $conexion->prepare($sql);
            $consulta->bind_param("i", $id);
            $consulta->execute();
            $resultado = $consulta->get_result();
            $producto = $resultado->fetch_object('productos');
            $consulta->close();
            $conexion->close();

            return $producto ?: null;
        }

        public static function insert(productos $producto) {
            $sql = 'INSERT INTO productos (categoria_id, nombre, descripcion, precio, imagen, activo) VALUES (?, ?, ?, ?, ?, ?)';
            $conexion = DataBase::connect();
            $consulta = $conexion->prepare($sql);
            $categoria_id = $producto->getCategoriaId();
            $nombre = $producto->getNombre();
            $descripcion = $producto->getDescripcion();
            $precio = $producto->getPrecio();
            $imagen = $producto->getImagen();
            $activo = $producto->getActivo();

            $consulta->bind_param("issdsi", $categoria_id, $nombre, $descripcion, $precio, $imagen, $activo);
            $consulta->execute();
            $id = $conexion->insert_id;
            $consulta->close();
            $conexion->close();

            return $id;
        }

        public static function update(productos $producto) {
            $sql = 'UPDATE productos SET categoria_id = ?, nombre = ?, descripcion = ?, precio = ?, imagen = ?, activo = ? WHERE id = ?';
            $conexion = DataBase::connect();
            $consulta = $conexion->prepare($sql);
            $categoria_id = $producto->getCategoriaId();
            $nombre = $producto->getNombre();
            $descripcion = $producto->getDescripcion();
            $precio = $producto->getPrecio();
            $imagen = $producto->getImagen();
            $activo = $producto->getActivo();
            $id = $producto->getId();

            $consulta->bind_param("issdsii", $categoria_id, $nombre, $descripcion, $precio, $imagen, $activo, $id);
            $resultado = $consulta->execute();
            $consulta->close();
            $conexion->close();
            return $resultado;
        }

        public static function delete($id) {
            $sql = 'DELETE FROM productos WHERE id = ?';
            $conexion = DataBase::connect();
            $consulta = $conexion->prepare($sql);
            $consulta->bind_param("i", $id);
            $resultado = $consulta->execute();
            $consulta->close();
            $conexion->close();
            return $resultado;
        }

        public static function selectMasPedido() {
            $sql = "SELECT p.id, p.categoria_id, p.nombre, p.descripcion, p.precio, p.imagen, p.activo
                FROM productos p
                INNER JOIN pedido_detalle pd ON pd.producto_id = p.id
                INNER JOIN pedidos pe ON pe.id = pd.pedido_id
                WHERE p.activo = 1 AND pe.estado_pago = 'pagado' AND pe.estado <> 'cancelado'
                GROUP BY p.id, p.categoria_id, p.nombre, p.descripcion, p.precio, p.imagen, p.activo
                ORDER BY SUM(pd.cantidad) DESC, p.id ASC
                LIMIT 1";

            $conexion = DataBase::connect();
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->get_result()->fetch_object('productos');
            $consulta->close();
            $conexion->close();

            return $resultado ?: null;
        }

        public static function selectRandom() {
            $sql = "SELECT * from productos WHERE activo = 1 ORDER BY RAND()";
            $conexion = DataBase::connect();
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->get_result();
            $productos = [];
            while ($producto = $resultado->fetch_object('productos')) {
                $productos[] = $producto;
            }
            $consulta->close();
            $conexion->close();

            return $productos;
        }

        public static function selectOrderID() {
            $sql = 'SELECT * FROM productos ORDER BY id';
            $conexion = DataBase::connect();
            $consulta = $conexion->query($sql);
            $productos = [];
            while ($producto = $consulta->fetch_object('productos')) {
                $productos[] = $producto;
            }
            $consulta->close();
            $conexion->close();

            return $productos;
        }

        public static function selectOrderNombre() {
            $sql = 'SELECT * FROM productos ORDER BY nombre';
            $conexion = DataBase::connect();
            $consulta = $conexion->query($sql);
            $productos = [];
            while ($producto = $consulta->fetch_object('productos')) {
                $productos[] = $producto;
            }
            $consulta->close();
            $conexion->close();

            return $productos;
        }

        public static function selectOrderPrecio() {
            $sql = 'SELECT * FROM productos ORDER BY precio';
            $conexion = DataBase::connect();
            $consulta = $conexion->query($sql);
            $productos = [];
            while ($producto = $consulta->fetch_object('productos')) {
                $productos[] = $producto;
            }
            $consulta->close();
            $conexion->close();

            return $productos;
        }
    } 
?>