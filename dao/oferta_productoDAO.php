<?php
require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/oferta_producto.php';

class oferta_productoDAO {
    public static function selectAll() {
        $sql = 'SELECT oferta_id, producto_id FROM oferta_producto ORDER BY oferta_id, producto_id';
        $conexion = DataBase::connect();
        $consulta = $conexion->query($sql);
        $listaRelaciones = [];
        while ($relacion = $consulta->fetch_object('oferta_producto')) {
            $listaRelaciones[] = $relacion;
        }
        $consulta->close();
        $conexion->close();

        return $listaRelaciones;
    }

    public static function selectByIDs($ofertaId, $productoId) {
        $sql = 'SELECT oferta_id, producto_id FROM oferta_producto WHERE oferta_id = ? AND producto_id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('ii', $ofertaId, $productoId);
        $consulta->execute();
        $relacion = $consulta->get_result()->fetch_object('oferta_producto');
        $consulta->close();
        $conexion->close();
        return $relacion ?: null;
    }

    public static function selectByOfertaID($ofertaId) {
        $sql = 'SELECT oferta_id, producto_id FROM oferta_producto WHERE oferta_id = ? ORDER BY producto_id';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('i', $ofertaId);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $relaciones = [];
        while ($relacion = $resultado->fetch_object('oferta_producto')) {
            $relaciones[] = $relacion;
        }
        $consulta->close();
        $conexion->close();
        return $relaciones;
    }

    public static function selectByProductoID($productoId) {
        $sql = 'SELECT oferta_id, producto_id FROM oferta_producto WHERE producto_id = ? ORDER BY oferta_id';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('i', $productoId);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $relaciones = [];
        while ($relacion = $resultado->fetch_object('oferta_producto')) {
            $relaciones[] = $relacion;
        }
        $consulta->close();
        $conexion->close();
        return $relaciones;
    }

    public static function insert(oferta_producto $relacion) {
        $sql = 'INSERT INTO oferta_producto (oferta_id, producto_id) VALUES (?, ?)';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $ofertaId = $relacion->getOfertaId();
        $productoId = $relacion->getProductoId();
        $consulta->bind_param('ii', $ofertaId, $productoId);
        $resultado = $consulta->execute();
        $consulta->close();
        $conexion->close();
        return $resultado;
    }

    public static function delete($ofertaId, $productoId) {
        $sql = 'DELETE FROM oferta_producto WHERE oferta_id = ? AND producto_id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('ii', $ofertaId, $productoId);
        $resultado = $consulta->execute();
        $consulta->close();
        $conexion->close();
        return $resultado;
    }
}
?>