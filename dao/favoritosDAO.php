<?php
require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/favoritos.php';
require_once __DIR__ . '/../models/productos.php';

class favoritosDAO {
    public static function selectAll() {
        $sql = 'SELECT producto_id, usuario_id FROM favoritos';
        $conexion = DataBase::connect();
        $consulta = $conexion->query($sql);
        $listaRelaciones = [];
        while ($relacion = $consulta->fetch_object('favoritos')) {
            $listaRelaciones[] = $relacion;
        }
        $consulta->close();
        $conexion->close();

        return $listaRelaciones;
    }

    public static function selectByIDs($productoId, $usuarioId) {
        $sql = 'SELECT producto_id, usuario_id FROM favoritos WHERE producto_id = ? AND usuario_id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('ii', $productoId, $usuarioId);
        $consulta->execute();
        $relacion = $consulta->get_result()->fetch_object('favoritos');
        $consulta->close();
        $conexion->close();
        return $relacion ?: null;
    }

    public static function selectByUsuarioID($usuarioId) {
        $sql = 'SELECT p.id, p.categoria_id, p.nombre, p.descripcion, p.precio, p.imagen, p.activo
                FROM favoritos f
                INNER JOIN productos p ON p.id = f.producto_id
                WHERE f.usuario_id = ?
                ORDER BY p.nombre';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('i', $usuarioId);
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

    public static function insert(favoritos $relacion) {
        $sql = 'INSERT INTO favoritos (producto_id, usuario_id) VALUES (?, ?)';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $productoId = $relacion->getProductoId();
        $usuarioId = $relacion->getUsuarioId();
        $consulta->bind_param('ii', $productoId, $usuarioId);
        $resultado = $consulta->execute();
        $consulta->close();
        $conexion->close();
        return $resultado;
    }

    public static function delete($productoId, $usuarioId) {
        $sql = 'DELETE FROM favoritos WHERE producto_id = ? AND usuario_id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('ii', $productoId, $usuarioId);
        $resultado = $consulta->execute();
        $consulta->close();
        $conexion->close();
        return $resultado;
    }
}
?>