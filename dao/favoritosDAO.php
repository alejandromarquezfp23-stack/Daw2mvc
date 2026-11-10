<?php
require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/favoritos.php';

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