<?php
require_once __DIR__ . '/../models/pedidos.php';

class pedidosDAO {
    private $conexion;

    public function __construct(mysqli $conexion) {
        $this->conexion = $conexion;
    }

    public function selectAll() {
        $sql = 'SELECT id, usuario_id, estado, fecha_pedido, subtotal, descuento, total, metodo_pago, estado_pago FROM pedidos ORDER BY id';
        $consulta = $this->conexion->query($sql);
        $resultados = $consulta->fetch_all(MYSQLI_ASSOC);

        $listaPedidos = [];
        foreach ($resultados as $fila) {
            $pedido = new pedidos();
            $pedido->setId($fila['id']);
            $pedido->setUsuarioId($fila['usuario_id']);
            $pedido->setEstado($fila['estado']);
            $pedido->setFechaPedido($fila['fecha_pedido']);
            $pedido->setSubtotal($fila['subtotal']);
            $pedido->setDescuento($fila['descuento']);
            $pedido->setTotal($fila['total']);
            $pedido->setMetodoPago($fila['metodo_pago']);
            $pedido->setEstadoPago($fila['estado_pago']);
            $listaPedidos[] = $pedido;
        }

        return $listaPedidos;
    }

    public function selectByID($id) {
        $sql = 'SELECT id, usuario_id, estado, fecha_pedido, subtotal, descuento, total, metodo_pago, estado_pago FROM pedidos WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $consulta->execute();
        $fila = $consulta->get_result()->fetch_assoc();
        $consulta->close();
        if (!$fila) {
            return null;
        }
        return new pedidos($fila['id'], $fila['usuario_id'], $fila['estado'], $fila['fecha_pedido'], $fila['subtotal'], $fila['descuento'], $fila['total'], $fila['metodo_pago'], $fila['estado_pago']);
    }

    public function selectByUsuarioID($usuarioId) {
        $sql = 'SELECT id, usuario_id, estado, fecha_pedido, subtotal, descuento, total, metodo_pago, estado_pago FROM pedidos WHERE usuario_id = ? ORDER BY fecha_pedido DESC';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $usuarioId);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $pedidos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $pedidos[] = new pedidos($fila['id'], $fila['usuario_id'], $fila['estado'], $fila['fecha_pedido'], $fila['subtotal'], $fila['descuento'], $fila['total'], $fila['metodo_pago'], $fila['estado_pago']);
        }
        $consulta->close();
        return $pedidos;
    }

    public function insert(pedidos $pedido) {
        $sql = 'INSERT INTO pedidos (usuario_id, estado, fecha_pedido, subtotal, descuento, total, metodo_pago, estado_pago) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $consulta = $this->conexion->prepare($sql);
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
        $id = $this->conexion->insert_id;
        $consulta->close();
        return $id;
    }

    public function update(pedidos $pedido) {
        $sql = 'UPDATE pedidos SET usuario_id = ?, estado = ?, fecha_pedido = ?, subtotal = ?, descuento = ?, total = ?, metodo_pago = ?, estado_pago = ? WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
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
        return $resultado;
    }

    public function delete($id) {
        $sql = 'DELETE FROM pedidos WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $resultado = $consulta->execute();
        $consulta->close();
        return $resultado;
    }
}
?>