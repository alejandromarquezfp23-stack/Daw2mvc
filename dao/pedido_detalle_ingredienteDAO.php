<?php
require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/pedido_detalle_ingrediente.php';

class pedido_detalle_ingredienteDAO {
    public static function selectAll() {
        $sql = 'SELECT id, pedido_detalle_id, ingrediente_id, nombre_ingrediente, precio_extra, accion FROM pedido_detalle_ingrediente ORDER BY id';
        $conexion = DataBase::connect();
        $consulta = $conexion->query($sql);
        $listaIngredientes = [];
        while ($ingrediente = $consulta->fetch_object('pedido_detalle_ingrediente')) {
            $listaIngredientes[] = $ingrediente;
        }
        $consulta->close();
        $conexion->close();

        return $listaIngredientes;
    }

    public static function selectByID($id) {
        $sql = 'SELECT id, pedido_detalle_id, ingrediente_id, nombre_ingrediente, precio_extra, accion FROM pedido_detalle_ingrediente WHERE id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $consulta->execute();
        $ingrediente = $consulta->get_result()->fetch_object('pedido_detalle_ingrediente');
        $consulta->close();
        $conexion->close();
        return $ingrediente ?: null;
    }

    public static function selectByPedidoDetalleID($pedidoDetalleId) {
        $sql = 'SELECT id, pedido_detalle_id, ingrediente_id, nombre_ingrediente, precio_extra, accion FROM pedido_detalle_ingrediente WHERE pedido_detalle_id = ? ORDER BY id';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('i', $pedidoDetalleId);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $ingredientes = [];
        while ($ingrediente = $resultado->fetch_object('pedido_detalle_ingrediente')) {
            $ingredientes[] = $ingrediente;
        }
        $consulta->close();
        $conexion->close();
        return $ingredientes;
    }

    public static function insert(pedido_detalle_ingrediente $detalle) {
        $sql = 'INSERT INTO pedido_detalle_ingrediente (pedido_detalle_id, ingrediente_id, nombre_ingrediente, precio_extra, accion) VALUES (?, ?, ?, ?, ?)';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $pedidoDetalleId = $detalle->getPedidoDetalleId();
        $ingredienteId = $detalle->getIngredienteId();
        $nombre = $detalle->getNombreIngrediente();
        $precio = $detalle->getPrecioExtra();
        $accion = $detalle->getAccion();
        $consulta->bind_param('iisds', $pedidoDetalleId, $ingredienteId, $nombre, $precio, $accion);
        $consulta->execute();
        $id = $conexion->insert_id;
        $consulta->close();
        $conexion->close();
        return $id;
    }

    public static function update(pedido_detalle_ingrediente $detalle) {
        $sql = 'UPDATE pedido_detalle_ingrediente SET pedido_detalle_id = ?, ingrediente_id = ?, nombre_ingrediente = ?, precio_extra = ?, accion = ? WHERE id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $pedidoDetalleId = $detalle->getPedidoDetalleId();
        $ingredienteId = $detalle->getIngredienteId();
        $nombre = $detalle->getNombreIngrediente();
        $precio = $detalle->getPrecioExtra();
        $accion = $detalle->getAccion();
        $id = $detalle->getId();
        $consulta->bind_param('iisdsi', $pedidoDetalleId, $ingredienteId, $nombre, $precio, $accion, $id);
        $resultado = $consulta->execute();
        $consulta->close();
        $conexion->close();
        return $resultado;
    }

    public static function delete($id) {
        $sql = 'DELETE FROM pedido_detalle_ingrediente WHERE id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $resultado = $consulta->execute();
        $consulta->close();
        $conexion->close();
        return $resultado;
    }
}
?>