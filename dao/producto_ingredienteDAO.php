<?php
require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/producto_ingrediente.php';

class producto_ingredienteDAO {
    public static function selectAll() {
        $sql = 'SELECT producto_id, ingrediente_id, cantidad FROM producto_ingrediente ORDER BY producto_id, ingrediente_id';
        $conexion = DataBase::connect();
        $consulta = $conexion->query($sql);
        $listaRelaciones = [];
        while ($relacion = $consulta->fetch_object('producto_ingrediente')) {
            $listaRelaciones[] = $relacion;
        }
        $consulta->close();
        $conexion->close();

        return $listaRelaciones;
    }

    public static function selectByIDs($productoId, $ingredienteId) {
        $sql = 'SELECT producto_id, ingrediente_id, cantidad FROM producto_ingrediente WHERE producto_id = ? AND ingrediente_id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('ii', $productoId, $ingredienteId);
        $consulta->execute();
        $relacion = $consulta->get_result()->fetch_object('producto_ingrediente');
        $consulta->close();
        $conexion->close();
        return $relacion ?: null;
    }

    public static function selectByProductoID($productoId) {
        $sql = 'SELECT producto_id, ingrediente_id, cantidad FROM producto_ingrediente WHERE producto_id = ? ORDER BY ingrediente_id';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('i', $productoId);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $relaciones = [];
        while ($relacion = $resultado->fetch_object('producto_ingrediente')) {
            $relaciones[] = $relacion;
        }
        $consulta->close();
        $conexion->close();
        return $relaciones;
    }

    public static function selectByIngredienteID($ingredienteId) {
        $sql = 'SELECT producto_id, ingrediente_id, cantidad FROM producto_ingrediente WHERE ingrediente_id = ? ORDER BY producto_id';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('i', $ingredienteId);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $relaciones = [];
        while ($relacion = $resultado->fetch_object('producto_ingrediente')) {
            $relaciones[] = $relacion;
        }
        $consulta->close();
        $conexion->close();
        return $relaciones;
    }

    public static function insert(producto_ingrediente $relacion) {
        $sql = 'INSERT INTO producto_ingrediente (producto_id, ingrediente_id, cantidad) VALUES (?, ?, ?)';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $productoId = $relacion->getProductoId();
        $ingredienteId = $relacion->getIngredienteId();
        $cantidad = $relacion->getCantidad();
        $consulta->bind_param('iid', $productoId, $ingredienteId, $cantidad);
        $resultado = $consulta->execute();
        $consulta->close();
        $conexion->close();
        return $resultado;
    }

    public static function update(producto_ingrediente $relacion) {
        $sql = 'UPDATE producto_ingrediente SET cantidad = ? WHERE producto_id = ? AND ingrediente_id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $cantidad = $relacion->getCantidad();
        $productoId = $relacion->getProductoId();
        $ingredienteId = $relacion->getIngredienteId();
        $consulta->bind_param('dii', $cantidad, $productoId, $ingredienteId);
        $resultado = $consulta->execute();
        $consulta->close();
        $conexion->close();
        return $resultado;
    }

    public static function delete($productoId, $ingredienteId) {
        $sql = 'DELETE FROM producto_ingrediente WHERE producto_id = ? AND ingrediente_id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('ii', $productoId, $ingredienteId);
        $resultado = $consulta->execute();
        $consulta->close();
        $conexion->close();
        return $resultado;
    }
}
?>