<?php
require_once __DIR__ . '/../models/producto_ingrediente.php';

class producto_ingredienteDAO {
    private $conexion;

    public function __construct(mysqli $conexion) {
        $this->conexion = $conexion;
    }

    public function selectAll() {
        $sql = 'SELECT producto_id, ingrediente_id, cantidad FROM producto_ingrediente ORDER BY producto_id, ingrediente_id';
        $consulta = $this->conexion->query($sql);
        $resultados = $consulta->fetch_all(MYSQLI_ASSOC);

        $listaRelaciones = [];
        foreach ($resultados as $fila) {
            $relacion = new producto_ingrediente();
            $relacion->setProductoId($fila['producto_id']);
            $relacion->setIngredienteId($fila['ingrediente_id']);
            $relacion->setCantidad($fila['cantidad']);
            $listaRelaciones[] = $relacion;
        }

        return $listaRelaciones;
    }

    public function selectByIDs($productoId, $ingredienteId) {
        $sql = 'SELECT producto_id, ingrediente_id, cantidad FROM producto_ingrediente WHERE producto_id = ? AND ingrediente_id = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('ii', $productoId, $ingredienteId);
        $consulta->execute();
        $fila = $consulta->get_result()->fetch_assoc();
        $consulta->close();
        if (!$fila) {
            return null;
        }
        return new producto_ingrediente($fila['producto_id'], $fila['ingrediente_id'], $fila['cantidad']);
    }

    public function selectByProductoID($productoId) {
        $sql = 'SELECT producto_id, ingrediente_id, cantidad FROM producto_ingrediente WHERE producto_id = ? ORDER BY ingrediente_id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $productoId);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $relaciones = [];
        while ($fila = $resultado->fetch_assoc()) {
            $relaciones[] = new producto_ingrediente($fila['producto_id'], $fila['ingrediente_id'], $fila['cantidad']);
        }
        $consulta->close();
        return $relaciones;
    }

    public function selectByIngredienteID($ingredienteId) {
        $sql = 'SELECT producto_id, ingrediente_id, cantidad FROM producto_ingrediente WHERE ingrediente_id = ? ORDER BY producto_id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $ingredienteId);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $relaciones = [];
        while ($fila = $resultado->fetch_assoc()) {
            $relaciones[] = new producto_ingrediente($fila['producto_id'], $fila['ingrediente_id'], $fila['cantidad']);
        }
        $consulta->close();
        return $relaciones;
    }

    public function insert(producto_ingrediente $relacion) {
        $sql = 'INSERT INTO producto_ingrediente (producto_id, ingrediente_id, cantidad) VALUES (?, ?, ?)';
        $consulta = $this->conexion->prepare($sql);
        $productoId = $relacion->getProductoId();
        $ingredienteId = $relacion->getIngredienteId();
        $cantidad = $relacion->getCantidad();
        $consulta->bind_param('iid', $productoId, $ingredienteId, $cantidad);
        $resultado = $consulta->execute();
        $consulta->close();
        return $resultado;
    }

    public function update(producto_ingrediente $relacion) {
        $sql = 'UPDATE producto_ingrediente SET cantidad = ? WHERE producto_id = ? AND ingrediente_id = ?';
        $consulta = $this->conexion->prepare($sql);
        $cantidad = $relacion->getCantidad();
        $productoId = $relacion->getProductoId();
        $ingredienteId = $relacion->getIngredienteId();
        $consulta->bind_param('dii', $cantidad, $productoId, $ingredienteId);
        $resultado = $consulta->execute();
        $consulta->close();
        return $resultado;
    }

    public function delete($productoId, $ingredienteId) {
        $sql = 'DELETE FROM producto_ingrediente WHERE producto_id = ? AND ingrediente_id = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('ii', $productoId, $ingredienteId);
        $resultado = $consulta->execute();
        $consulta->close();
        return $resultado;
    }
}
?>