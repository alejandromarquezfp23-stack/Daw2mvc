<?php
require_once __DIR__ . '/../models/usuarios.php';

class usuariosDAO {
    private $conexion;

    public function __construct(mysqli $conexion) {
        $this->conexion = $conexion;
    }

    public function selectAll() {
        $sql = 'SELECT id, nombre, email, telefono, direccion, fecha_nacimiento, rol, fecha_registro FROM usuarios ORDER BY id';
        $consulta = $this->conexion->query($sql);
        $resultados = $consulta->fetch_all(MYSQLI_ASSOC);

        $listaUsuarios = [];
        foreach ($resultados as $fila) {
            $usuario = new usuarios();
            $usuario->setId($fila['id']);
            $usuario->setNombre($fila['nombre']);
            $usuario->setEmail($fila['email']);
            $usuario->setTelefono($fila['telefono']);
            $usuario->setDireccion($fila['direccion']);
            $usuario->setFechaNacimiento($fila['fecha_nacimiento']);
            $usuario->setRol($fila['rol']);
            $usuario->setFechaRegistro($fila['fecha_registro']);
            $listaUsuarios[] = $usuario;
        }

        return $listaUsuarios;
    }

    public function selectByID($id) {
        $sql = 'SELECT id, nombre, email, telefono, direccion, fecha_nacimiento, rol, fecha_registro FROM usuarios WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $consulta->execute();
        $fila = $consulta->get_result()->fetch_assoc();
        $consulta->close();
        if (!$fila) {
            return null;
        }
        return new usuarios($fila['id'], $fila['nombre'], $fila['email'], null, $fila['telefono'], $fila['direccion'], $fila['fecha_nacimiento'], $fila['rol'], $fila['fecha_registro']);
    }

    public function selectByEmail($email) {
        $sql = 'SELECT id, nombre, email, password, telefono, direccion, fecha_nacimiento, rol, fecha_registro FROM usuarios WHERE email = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('s', $email);
        $consulta->execute();
        $fila = $consulta->get_result()->fetch_assoc();
        $consulta->close();
        if (!$fila) {
            return null;
        }
        return new usuarios($fila['id'], $fila['nombre'], $fila['email'], $fila['password'], $fila['telefono'], $fila['direccion'], $fila['fecha_nacimiento'], $fila['rol'], $fila['fecha_registro']);
    }

    public function insert(usuarios $usuario) {
        $sql = 'INSERT INTO usuarios (nombre, email, password, telefono, direccion, fecha_nacimiento, rol) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $consulta = $this->conexion->prepare($sql);
        $nombre = $usuario->getNombre();
        $email = $usuario->getEmail();
        $password = $usuario->getPassword();
        $telefono = $usuario->getTelefono();
        $direccion = $usuario->getDireccion();
        $fechaNacimiento = $usuario->getFechaNacimiento();
        $rol = $usuario->getRol();
        $consulta->bind_param('sssssss', $nombre, $email, $password, $telefono, $direccion, $fechaNacimiento, $rol);
        $consulta->execute();
        $id = $this->conexion->insert_id;
        $consulta->close();
        return $id;
    }

    public function update(usuarios $usuario) {
        $sql = 'UPDATE usuarios SET nombre = ?, email = ?, telefono = ?, direccion = ?, fecha_nacimiento = ?, rol = ? WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
        $nombre = $usuario->getNombre();
        $email = $usuario->getEmail();
        $telefono = $usuario->getTelefono();
        $direccion = $usuario->getDireccion();
        $fechaNacimiento = $usuario->getFechaNacimiento();
        $rol = $usuario->getRol();
        $id = $usuario->getId();
        $consulta->bind_param('ssssssi', $nombre, $email, $telefono, $direccion, $fechaNacimiento, $rol, $id);
        $resultado = $consulta->execute();
        $consulta->close();
        return $resultado;
    }

    public function updatePassword($id, $password) {
        $sql = 'UPDATE usuarios SET password = ? WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('si', $password, $id);
        $resultado = $consulta->execute();
        $consulta->close();
        return $resultado;
    }

    public function delete($id) {
        $sql = 'DELETE FROM usuarios WHERE id = ?';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $resultado = $consulta->execute();
        $consulta->close();
        return $resultado;
    }
}
?>