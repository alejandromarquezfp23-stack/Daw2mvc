<?php
require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/pedidos.php';

class pedidosDAO {
    public static function selectAll() {
        $sql = 'SELECT id, usuario_id, estado, fecha_pedido, subtotal, descuento, total, metodo_pago, estado_pago FROM pedidos ORDER BY id';
        $conexion = DataBase::connect();
        $consulta = $conexion->query($sql);
        $listaPedidos = [];
        while ($pedido = $consulta->fetch_object('pedidos')) {
            $listaPedidos[] = $pedido;
        }
        $consulta->close();
        $conexion->close();

        return $listaPedidos;
    }

    public static function selectByID($id) {
        $sql = 'SELECT id, usuario_id, estado, fecha_pedido, subtotal, descuento, total, metodo_pago, estado_pago FROM pedidos WHERE id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $consulta->execute();
        $pedido = $consulta->get_result()->fetch_object('pedidos');
        $consulta->close();
        $conexion->close();
        return $pedido ?: null;
    }

    public static function selectByUsuarioID($usuarioId) {
        $sql = 'SELECT id, usuario_id, estado, fecha_pedido, subtotal, descuento, total, metodo_pago, estado_pago FROM pedidos WHERE usuario_id = ? ORDER BY fecha_pedido DESC';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('i', $usuarioId);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $pedidos = [];
        while ($pedido = $resultado->fetch_object('pedidos')) {
            $pedidos[] = $pedido;
        }
        $consulta->close();
        $conexion->close();
        return $pedidos;
    }

    public static function insert(pedidos $pedido) {
        $sql = 'INSERT INTO pedidos (usuario_id, estado, fecha_pedido, subtotal, descuento, total, metodo_pago, estado_pago) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $usuarioId = $pedido->getUsuarioId();
        $estado = $pedido->getEstado();
        $fecha = $pedido->getFechaPedido();
        $subtotal = $pedido->getSubtotal();
        $descuento = $pedido->getDescuento();
        $total = $pedido->getTotal();
        $metodoPago = $pedido->getMetodoPago();
        $estadoPago = $pedido->getEstadoPago();
        $consulta->bind_param('issdddss', $usuarioId, $estado, $fecha, $subtotal, $descuento, $total, $metodoPago, $estadoPago);
        $consulta->execute();
        $id = $conexion->insert_id;
        $consulta->close();
        $conexion->close();
        return $id;
    }

    public static function update(pedidos $pedido) {
        $sql = 'UPDATE pedidos SET usuario_id = ?, estado = ?, fecha_pedido = ?, subtotal = ?, descuento = ?, total = ?, metodo_pago = ?, estado_pago = ? WHERE id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $usuarioId = $pedido->getUsuarioId();
        $estado = $pedido->getEstado();
        $fecha = $pedido->getFechaPedido();
        $subtotal = $pedido->getSubtotal();
        $descuento = $pedido->getDescuento();
        $total = $pedido->getTotal();
        $metodoPago = $pedido->getMetodoPago();
        $estadoPago = $pedido->getEstadoPago();
        $id = $pedido->getId();
        $consulta->bind_param('issdddssi', $usuarioId, $estado, $fecha, $subtotal, $descuento, $total, $metodoPago, $estadoPago, $id);
        $resultado = $consulta->execute();
        $consulta->close();
        $conexion->close();
        return $resultado;
    }

    public static function delete($id) {
        $sql = 'DELETE FROM pedidos WHERE id = ?';
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