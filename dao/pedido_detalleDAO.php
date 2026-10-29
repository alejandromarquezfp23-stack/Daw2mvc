<?php
require_once __DIR__ . '/../models/pedido_detalle.php';

class pedido_detalleDAO {
    private $conexion;

    public function __construct(mysqli $conexion) {
        $this->conexion = $conexion;
    }

    public function selectAll() {
        $sql = 'SELECT id, pedido_id, producto_id, nombre_producto, precio_unitario, cantidad, subtotal FROM pedido_detalle ORDER BY id';
        $consulta = $this->conexion->query($sql);
        $resultados = $consulta->fetch_all(MYSQLI_ASSOC);

        $listaDetalles = [];
        foreach ($resultados as $fila) {
            $detalle = new pedido_detalle();
            $detalle->setId($fila['id']);
            $detalle->setPedidoId($fila['pedido_id']);
            $detalle->setProductoId($fila['producto_id']);
            $detalle->setNombreProducto($fila['nombre_producto']);
            $detalle->setPrecioUnitario($fila['precio_unitario']);
            $detalle->setCantidad($fila['cantidad']);
            $detalle->setSubtotal($fila['subtotal']);
            $listaDetalles[] = $detalle;
        }

        return $listaDetalles;
    }

    public function selectByID($id) {
        $sql = 'SELECT id, pedido_id, producto_id, nombre_producto, precio_unitario, cantidad, subtotal FROM pedido_detalle WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $consulta->execute();
        $fila = $consulta->get_result()->fetch_assoc();
        $consulta->close();
        if (!$fila) {
            return null;
        }
        return new pedido_detalle($fila['id'], $fila['pedido_id'], $fila['producto_id'], $fila['nombre_producto'], $fila['precio_unitario'], $fila['cantidad'], $fila['subtotal']);
    }

    public function selectByPedidoID($pedidoId) {
        $sql = 'SELECT id, pedido_id, producto_id, nombre_producto, precio_unitario, cantidad, subtotal FROM pedido_detalle WHERE pedido_id = ? ORDER BY id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $pedidoId);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $detalles = [];
        while ($fila = $resultado->fetch_assoc()) {
            $detalles[] = new pedido_detalle($fila['id'], $fila['pedido_id'], $fila['producto_id'], $fila['nombre_producto'], $fila['precio_unitario'], $fila['cantidad'], $fila['subtotal']);
        }
        $consulta->close();
        return $detalles;
    }

    public function insert(pedido_detalle $detalle) {
        $sql = 'INSERT INTO pedido_detalle (pedido_id, producto_id, nombre_producto, precio_unitario, cantidad, subtotal) VALUES (?, ?, ?, ?, ?, ?)';
        $consulta = $this->conexion->prepare($sql);
        $pedidoId = $detalle->getPedidoId();
        $productoId = $detalle->getProductoId();
        $nombre = $detalle->getNombreProducto();
        $precio = $detalle->getPrecioUnitario();
        $cantidad = $detalle->getCantidad();
        $subtotal = $detalle->getSubtotal();
        $consulta->bind_param('iisdid', $pedidoId, $productoId, $nombre, $precio, $cantidad, $subtotal);
        $consulta->execute();
        $id = $this->conexion->insert_id;
        $consulta->close();
        return $id;
    }

    public function update(pedido_detalle $detalle) {
        $sql = 'UPDATE pedido_detalle SET pedido_id = ?, producto_id = ?, nombre_producto = ?, precio_unitario = ?, cantidad = ?, subtotal = ? WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
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
        return $resultado;
    }

    public function delete($id) {
        $sql = 'DELETE FROM pedido_detalle WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $resultado = $consulta->execute();
        $consulta->close();
        return $resultado;
    }
}
?>