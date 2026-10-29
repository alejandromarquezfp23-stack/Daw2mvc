<?php
require_once __DIR__ . '/../models/ingredientes.php';

class ingredientesDAO {
    private $conexion;

    public function __construct(mysqli $conexion) {
        $this->conexion = $conexion;
    }

    public function selectAll() {
        $sql = 'SELECT id, nombre, precio_extra, activo FROM ingredientes ORDER BY id';
        $consulta = $this->conexion->query($sql);
        $resultados = $consulta->fetch_all(MYSQLI_ASSOC);

        $listaIngredientes = [];
        foreach ($resultados as $fila) {
            $ingrediente = new ingredientes();
            $ingrediente->setId($fila['id']);
            $ingrediente->setNombre($fila['nombre']);
            $ingrediente->setPrecioExtra($fila['precio_extra']);
            $ingrediente->setActivo($fila['activo']);
            $listaIngredientes[] = $ingrediente;
        }

        return $listaIngredientes;
    }

    public function selectByID($id) {
        $sql = 'SELECT id, nombre, precio_extra, activo FROM ingredientes WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $consulta->execute();
        $fila = $consulta->get_result()->fetch_assoc();
        $consulta->close();
        if (!$fila) {
            return null;
        }
        return new ingredientes($fila['id'], $fila['nombre'], $fila['precio_extra'], $fila['activo']);
    }

    public function insert(ingredientes $ingrediente) {
        $sql = 'INSERT INTO ingredientes (nombre, precio_extra, activo) VALUES (?, ?, ?)';
        $consulta = $this->conexion->prepare($sql);
        $nombre = $ingrediente->getNombre();
        $precioExtra = $ingrediente->getPrecioExtra();
        $activo = $ingrediente->getActivo();
        $consulta->bind_param('sdi', $nombre, $precioExtra, $activo);
        $consulta->execute();
        $id = $this->conexion->insert_id;
        $consulta->close();
        return $id;
    }

    public function update(ingredientes $ingrediente) {
        $sql = 'UPDATE ingredientes SET nombre = ?, precio_extra = ?, activo = ? WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
        $nombre = $ingrediente->getNombre();
        $precioExtra = $ingrediente->getPrecioExtra();
        $activo = $ingrediente->getActivo();
        $id = $ingrediente->getId();
        $consulta->bind_param('sdii', $nombre, $precioExtra, $activo, $id);
        $resultado = $consulta->execute();
        $consulta->close();
        return $resultado;
    }

    public function delete($id) {
        $sql = 'DELETE FROM ingredientes WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $resultado = $consulta->execute();
        $consulta->close();
        return $resultado;
    }
}
?>
