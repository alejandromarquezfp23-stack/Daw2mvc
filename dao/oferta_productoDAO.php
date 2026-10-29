<?php
require_once __DIR__ . '/../models/oferta_producto.php';

class oferta_productoDAO {
    private $conexion;

    public function __construct(mysqli $conexion) {
        $this->conexion = $conexion;
    }

    public function selectAll() {
        $sql = 'SELECT oferta_id, producto_id FROM oferta_producto ORDER BY oferta_id, producto_id';
        $consulta = $this->conexion->query($sql);
        $resultados = $consulta->fetch_all(MYSQLI_ASSOC);

        $listaRelaciones = [];
        foreach ($resultados as $fila) {
            $relacion = new oferta_producto();
            $relacion->setOfertaId($fila['oferta_id']);
            $relacion->setProductoId($fila['producto_id']);
            $listaRelaciones[] = $relacion;
        }

        return $listaRelaciones;
    }

    public function selectByIDs($ofertaId, $productoId) {
        $sql = 'SELECT oferta_id, producto_id FROM oferta_producto WHERE oferta_id = ? AND producto_id = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('ii', $ofertaId, $productoId);
        $consulta->execute();
        $fila = $consulta->get_result()->fetch_assoc();
        $consulta->close();
        if (!$fila) {
            return null;
        }
        return new oferta_producto($fila['oferta_id'], $fila['producto_id']);
    }

    public function selectByOfertaID($ofertaId) {
        $sql = 'SELECT oferta_id, producto_id FROM oferta_producto WHERE oferta_id = ? ORDER BY producto_id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $ofertaId);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $relaciones = [];
        while ($fila = $resultado->fetch_assoc()) {
            $relaciones[] = new oferta_producto($fila['oferta_id'], $fila['producto_id']);
        }
        $consulta->close();
        return $relaciones;
    }

    public function selectByProductoID($productoId) {
        $sql = 'SELECT oferta_id, producto_id FROM oferta_producto WHERE producto_id = ? ORDER BY oferta_id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $productoId);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $relaciones = [];
        while ($fila = $resultado->fetch_assoc()) {
            $relaciones[] = new oferta_producto($fila['oferta_id'], $fila['producto_id']);
        }
        $consulta->close();
        return $relaciones;
    }

    public function insert(oferta_producto $relacion) {
        $sql = 'INSERT INTO oferta_producto (oferta_id, producto_id) VALUES (?, ?)';
        $consulta = $this->conexion->prepare($sql);
        $ofertaId = $relacion->getOfertaId();
        $productoId = $relacion->getProductoId();
        $consulta->bind_param('ii', $ofertaId, $productoId);
        $resultado = $consulta->execute();
        $consulta->close();
        return $resultado;
    }

    public function delete($ofertaId, $productoId) {
        $sql = 'DELETE FROM oferta_producto WHERE oferta_id = ? AND producto_id = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('ii', $ofertaId, $productoId);
        $resultado = $consulta->execute();
        $consulta->close();
        return $resultado;
    }
}
?>