<?php
require_once __DIR__ . '/../models/pedido_detalle_ingrediente.php';

class pedido_detalle_ingredienteDAO {
    private $conexion;

    public function __construct(mysqli $conexion) {
        $this->conexion = $conexion;
    }

    public function selectAll() {
        $sql = 'SELECT id, pedido_detalle_id, ingrediente_id, nombre_ingrediente, precio_extra, accion FROM pedido_detalle_ingrediente ORDER BY id';
        $consulta = $this->conexion->query($sql);
        $resultados = $consulta->fetch_all(MYSQLI_ASSOC);

        $listaIngredientes = [];
        foreach ($resultados as $fila) {
            $ingrediente = new pedido_detalle_ingrediente();
            $ingrediente->setId($fila['id']);
            $ingrediente->setPedidoDetalleId($fila['pedido_detalle_id']);
            $ingrediente->setIngredienteId($fila['ingrediente_id']);
            $ingrediente->setNombreIngrediente($fila['nombre_ingrediente']);
            $ingrediente->setPrecioExtra($fila['precio_extra']);
            $ingrediente->setAccion($fila['accion']);
            $listaIngredientes[] = $ingrediente;
        }

        return $listaIngredientes;
    }

    public function selectByID($id) {
        $sql = 'SELECT id, pedido_detalle_id, ingrediente_id, nombre_ingrediente, precio_extra, accion FROM pedido_detalle_ingrediente WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $consulta->execute();
        $fila = $consulta->get_result()->fetch_assoc();
        $consulta->close();
        if (!$fila) {
            return null;
        }
        return new pedido_detalle_ingrediente($fila['id'], $fila['pedido_detalle_id'], $fila['ingrediente_id'], $fila['nombre_ingrediente'], $fila['precio_extra'], $fila['accion']);
    }

    public function selectByPedidoDetalleID($pedidoDetalleId) {
        $sql = 'SELECT id, pedido_detalle_id, ingrediente_id, nombre_ingrediente, precio_extra, accion FROM pedido_detalle_ingrediente WHERE pedido_detalle_id = ? ORDER BY id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $pedidoDetalleId);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $ingredientes = [];
        while ($fila = $resultado->fetch_assoc()) {
            $ingredientes[] = new pedido_detalle_ingrediente($fila['id'], $fila['pedido_detalle_id'], $fila['ingrediente_id'], $fila['nombre_ingrediente'], $fila['precio_extra'], $fila['accion']);
        }
        $consulta->close();
        return $ingredientes;
    }

    public function insert(pedido_detalle_ingrediente $detalle) {
        $sql = 'INSERT INTO pedido_detalle_ingrediente (pedido_detalle_id, ingrediente_id, nombre_ingrediente, precio_extra, accion) VALUES (?, ?, ?, ?, ?)';
        $consulta = $this->conexion->prepare($sql);
        $pedidoDetalleId = $detalle->getPedidoDetalleId();
        $ingredienteId = $detalle->getIngredienteId();
        $nombre = $detalle->getNombreIngrediente();
        $precio = $detalle->getPrecioExtra();
        $accion = $detalle->getAccion();
        $consulta->bind_param('iisds', $pedidoDetalleId, $ingredienteId, $nombre, $precio, $accion);
        $consulta->execute();
        $id = $this->conexion->insert_id;
        $consulta->close();
        return $id;
    }

    public function update(pedido_detalle_ingrediente $detalle) {
        $sql = 'UPDATE pedido_detalle_ingrediente SET pedido_detalle_id = ?, ingrediente_id = ?, nombre_ingrediente = ?, precio_extra = ?, accion = ? WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
        $pedidoDetalleId = $detalle->getPedidoDetalleId();
        $ingredienteId = $detalle->getIngredienteId();
        $nombre = $detalle->getNombreIngrediente();
        $precio = $detalle->getPrecioExtra();
        $accion = $detalle->getAccion();
        $id = $detalle->getId();
        $consulta->bind_param('iisdsi', $pedidoDetalleId, $ingredienteId, $nombre, $precio, $accion, $id);
        $resultado = $consulta->execute();
        $consulta->close();
        return $resultado;
    }

    public function delete($id) {
        $sql = 'DELETE FROM pedido_detalle_ingrediente WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $resultado = $consulta->execute();
        $consulta->close();
        return $resultado;
    }
}
?>