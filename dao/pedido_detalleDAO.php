<?php
require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/pedido_detalle.php';

class pedido_detalleDAO {
    public static function selectAll() {
        $sql = 'SELECT id, pedido_id, producto_id, nombre_producto, precio_unitario, cantidad, subtotal FROM pedido_detalle ORDER BY id';
        $conexion = DataBase::connect();
        $consulta = $conexion->query($sql);
        $listaDetalles = [];
        while ($detalle = $consulta->fetch_object('pedido_detalle')) {
            $listaDetalles[] = $detalle;
        }
        $consulta->close();
        $conexion->close();

        return $listaDetalles;
    }

    public static function selectByID($id) {
        $sql = 'SELECT id, pedido_id, producto_id, nombre_producto, precio_unitario, cantidad, subtotal FROM pedido_detalle WHERE id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $consulta->execute();
        $detalle = $consulta->get_result()->fetch_object('pedido_detalle');
        $consulta->close();
        $conexion->close();
        return $detalle ?: null;
    }

    public static function selectByPedidoID($pedidoId) {
        $sql = 'SELECT id, pedido_id, producto_id, nombre_producto, precio_unitario, cantidad, subtotal FROM pedido_detalle WHERE pedido_id = ? ORDER BY id';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('i', $pedidoId);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $detalles = [];
        while ($detalle = $resultado->fetch_object('pedido_detalle')) {
            $detalles[] = $detalle;
        }
        $consulta->close();
        $conexion->close();
        return $detalles;
    }

    public static function insert(pedido_detalle $detalle) {
        $sql = 'INSERT INTO pedido_detalle (pedido_id, producto_id, nombre_producto, precio_unitario, cantidad, subtotal) VALUES (?, ?, ?, ?, ?, ?)';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $pedidoId = $detalle->getPedidoId();
        $productoId = $detalle->getProductoId();
        $nombre = $detalle->getNombreProducto();
        $precio = $detalle->getPrecioUnitario();
        $cantidad = $detalle->getCantidad();
        $subtotal = $detalle->getSubtotal();
        $consulta->bind_param('iisdid', $pedidoId, $productoId, $nombre, $precio, $cantidad, $subtotal);
        $consulta->execute();
        $id = $conexion->insert_id;
        $consulta->close();
        $conexion->close();
        return $id;
    }

    public static function update(pedido_detalle $detalle) {
        $sql = 'UPDATE pedido_detalle SET pedido_id = ?, producto_id = ?, nombre_producto = ?, precio_unitario = ?, cantidad = ?, subtotal = ? WHERE id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $pedidoId = $detalle->getPedidoId();
        $productoId = $detalle->getProductoId();
        $nombre = $detalle->getNombreProducto();
        $precio = $detalle->getPrecioUnitario();
        $cantidad = $detalle->getCantidad();
        $subtotal = $detalle->getSubtotal();
        $id = $detalle->getId();
        $consulta->bind_param('iisdidi', $pedidoId, $productoId, $nombre, $precio, $cantidad, $subtotal, $id);
        $resultado = $consulta->execute();
        $consulta->close();
        $conexion->close();
        return $resultado;
    }

    public static function delete($id) {
        $sql = 'DELETE FROM pedido_detalle WHERE id = ?';
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