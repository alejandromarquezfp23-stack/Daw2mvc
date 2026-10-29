<?php
require_once __DIR__ . '/../models/ofertas.php';

class ofertasDAO {
    private $conexion;

    public function __construct(mysqli $conexion) {
        $this->conexion = $conexion;
    }

    public function selectAll() {
        $sql = 'SELECT id, nombre, descripcion, tipo, valor, codigo, fecha_inicio, fecha_fin, activa FROM ofertas ORDER BY id';
        $consulta = $this->conexion->query($sql);
        $resultados = $consulta->fetch_all(MYSQLI_ASSOC);

        $listaOfertas = [];
        foreach ($resultados as $fila) {
            $oferta = new ofertas();
            $oferta->setId($fila['id']);
            $oferta->setNombre($fila['nombre']);
            $oferta->setDescripcion($fila['descripcion']);
            $oferta->setTipo($fila['tipo']);
            $oferta->setValor($fila['valor']);
            $oferta->setCodigo($fila['codigo']);
            $oferta->setFechaInicio($fila['fecha_inicio']);
            $oferta->setFechaFin($fila['fecha_fin']);
            $oferta->setActiva($fila['activa']);
            $listaOfertas[] = $oferta;
        }

        return $listaOfertas;
    }

    public function selectByID($id) {
        $sql = 'SELECT id, nombre, descripcion, tipo, valor, codigo, fecha_inicio, fecha_fin, activa FROM ofertas WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $consulta->execute();
        $fila = $consulta->get_result()->fetch_assoc();
        $consulta->close();
        if (!$fila) {
            return null;
        }
        return new ofertas($fila['id'], $fila['nombre'], $fila['descripcion'], $fila['tipo'], $fila['valor'], $fila['codigo'], $fila['fecha_inicio'], $fila['fecha_fin'], $fila['activa']);
    }

    public function selectByCodigo($codigo) {
        $sql = 'SELECT id, nombre, descripcion, tipo, valor, codigo, fecha_inicio, fecha_fin, activa FROM ofertas WHERE codigo = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('s', $codigo);
        $consulta->execute();
        $fila = $consulta->get_result()->fetch_assoc();
        $consulta->close();
        if (!$fila) {
            return null;
        }
        return new ofertas($fila['id'], $fila['nombre'], $fila['descripcion'], $fila['tipo'], $fila['valor'], $fila['codigo'], $fila['fecha_inicio'], $fila['fecha_fin'], $fila['activa']);
    }

    public function insert(ofertas $oferta) {
        $sql = 'INSERT INTO ofertas (nombre, descripcion, tipo, valor, codigo, fecha_inicio, fecha_fin, activa) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $consulta = $this->conexion->prepare($sql);
        $nombre = $oferta->getNombre();
        $descripcion = $oferta->getDescripcion();
        $tipo = $oferta->getTipo();
        $valor = $oferta->getValor();
        $codigo = $oferta->getCodigo();
        $fechaInicio = $oferta->getFechaInicio();
        $fechaFin = $oferta->getFechaFin();
        $activa = $oferta->getActiva();
        $consulta->bind_param('sssdsssi', $nombre, $descripcion, $tipo, $valor, $codigo, $fechaInicio, $fechaFin, $activa);
        $consulta->execute();
        $id = $this->conexion->insert_id;
        $consulta->close();
        return $id;
    }

    public function update(ofertas $oferta) {
        $sql = 'UPDATE ofertas SET nombre = ?, descripcion = ?, tipo = ?, valor = ?, codigo = ?, fecha_inicio = ?, fecha_fin = ?, activa = ? WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
        $nombre = $oferta->getNombre();
        $descripcion = $oferta->getDescripcion();
        $tipo = $oferta->getTipo();
        $valor = $oferta->getValor();
        $codigo = $oferta->getCodigo();
        $fechaInicio = $oferta->getFechaInicio();
        $fechaFin = $oferta->getFechaFin();
        $activa = $oferta->getActiva();
        $id = $oferta->getId();
        $consulta->bind_param('sssdsssii', $nombre, $descripcion, $tipo, $valor, $codigo, $fechaInicio, $fechaFin, $activa, $id);
        $resultado = $consulta->execute();
        $consulta->close();
        return $resultado;
    }

    public function delete($id) {
        $sql = 'DELETE FROM ofertas WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $resultado = $consulta->execute();
        $consulta->close();
        return $resultado;
    }
}
?>