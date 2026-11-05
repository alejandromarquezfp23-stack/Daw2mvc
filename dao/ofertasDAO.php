<?php
require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/ofertas.php';

class ofertasDAO {
    public static function selectAll() {
        $sql = 'SELECT id, nombre, descripcion, tipo, valor, codigo, fecha_inicio, fecha_fin, activa FROM ofertas ORDER BY id';
        $conexion = DataBase::connect();
        $consulta = $conexion->query($sql);
        $listaOfertas = [];
        while ($oferta = $consulta->fetch_object('ofertas')) {
            $listaOfertas[] = $oferta;
        }
        $consulta->close();
        $conexion->close();

        return $listaOfertas;
    }

    public static function selectByID($id) {
        $sql = 'SELECT id, nombre, descripcion, tipo, valor, codigo, fecha_inicio, fecha_fin, activa FROM ofertas WHERE id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $consulta->execute();
        $oferta = $consulta->get_result()->fetch_object('ofertas');
        $consulta->close();
        $conexion->close();
        return $oferta ?: null;
    }

    public static function selectByCodigo($codigo) {
        $sql = 'SELECT id, nombre, descripcion, tipo, valor, codigo, fecha_inicio, fecha_fin, activa FROM ofertas WHERE codigo = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('s', $codigo);
        $consulta->execute();
        $oferta = $consulta->get_result()->fetch_object('ofertas');
        $consulta->close();
        $conexion->close();
        return $oferta ?: null;
    }

    public static function insert(ofertas $oferta) {
        $sql = 'INSERT INTO ofertas (nombre, descripcion, tipo, valor, codigo, fecha_inicio, fecha_fin, activa) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
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
        $id = $conexion->insert_id;
        $consulta->close();
        $conexion->close();
        return $id;
    }

    public static function update(ofertas $oferta) {
        $sql = 'UPDATE ofertas SET nombre = ?, descripcion = ?, tipo = ?, valor = ?, codigo = ?, fecha_inicio = ?, fecha_fin = ?, activa = ? WHERE id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
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
        $conexion->close();
        return $resultado;
    }

    public static function delete($id) {
        $sql = 'DELETE FROM ofertas WHERE id = ?';
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