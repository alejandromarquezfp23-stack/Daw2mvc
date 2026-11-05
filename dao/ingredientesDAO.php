<?php
require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/ingredientes.php';

class ingredientesDAO {
    public static function selectAll() {
        $sql = 'SELECT id, nombre, imagen,precio_extra, activo FROM ingredientes ORDER BY id';
        $conexion = DataBase::connect();
        $consulta = $conexion->query($sql);
        $listaIngredientes = [];
        while ($ingrediente = $consulta->fetch_object('Ingredientes')) {
            $listaIngredientes[] = $ingrediente;
        }
        $consulta->close();
        $conexion->close();

        return $listaIngredientes;
    }

    public static function selectByID($id) {
        $sql = 'SELECT id, nombre, imagen, precio_extra, activo FROM ingredientes WHERE id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $consulta->execute();
        $ingrediente = $consulta->get_result()->fetch_object('Ingredientes');
        $consulta->close();
        $conexion->close();
        return $ingrediente ?: null;
    }

    public static function insert(ingredientes $ingrediente) {
        $sql = 'INSERT INTO ingredientes (nombre, imagen, precio_extra, activo) VALUES (?, ?, ?, ?)';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $nombre = $ingrediente->getNombre();
        $imagen = $ingrediente->getImagen();
        $precioExtra = $ingrediente->getPrecioExtra();
        $activo = $ingrediente->getActivo();
        $consulta->bind_param('ssdi', $nombre, $imagen, $precioExtra, $activo);
        $consulta->execute();
        $id = $conexion->insert_id;
        $consulta->close();
        $conexion->close();
        return $id;
    }

    public static function update(ingredientes $ingrediente) {
        $sql = 'UPDATE ingredientes SET nombre = ?, imagen = ?, precio_extra = ?, activo = ? WHERE id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $nombre = $ingrediente->getNombre();
        $imagen = $ingrediente->getImagen();
        $precioExtra = $ingrediente->getPrecioExtra();
        $activo = $ingrediente->getActivo();
        $id = $ingrediente->getId();
        $consulta->bind_param('ssdi', $nombre, $imagen, $precioExtra, $activo, $id);
        $resultado = $consulta->execute();
        $consulta->close();
        $conexion->close();
        return $resultado;
    }

    public static function delete($id) {
        $sql = 'DELETE FROM ingredientes WHERE id = ?';
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
