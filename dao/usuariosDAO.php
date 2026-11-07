<?php
require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/usuarios.php';

class usuariosDAO {
    public static function selectAll() {
        $sql = 'SELECT id, nombre, email, password, telefono, direccion, fecha_nacimiento, rol, fecha_registro FROM usuarios ORDER BY id';
        $conexion = DataBase::connect();
        $consulta = $conexion->query($sql);
        $usuarios = [];
        while ($fila = $consulta->fetch_object('usuarios')) {
            $listaUsuarios[] = $fila;
        }
        $consulta->close();
        $conexion->close();

        return $usuarios;
    }

    public static function selectByID($id) {
        $sql = 'SELECT id, nombre, email, telefono, direccion, fecha_nacimiento, rol, fecha_registro FROM usuarios WHERE id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $consulta->execute();
        $fila = $consulta->get_result()->fetch_object();
        $consulta->close();
        $conexion->close();
        return $fila;
    }

    public static function insert(usuarios $usuario) {
        $sql = 'INSERT INTO usuarios (nombre, email, password, telefono, direccion, fecha_nacimiento, rol) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $nombre = $usuario->getNombre();
        $email = $usuario->getEmail();
        $password = $usuario->getPassword();
        $telefono = $usuario->getTelefono();
        $direccion = $usuario->getDireccion();
        $fechaNacimiento = $usuario->getFechaNacimiento();
        $rol = $usuario->getRol();
        $consulta->bind_param('sssssss', $nombre, $email, $password, $telefono, $direccion, $fechaNacimiento, $rol);
        $consulta->execute();
        $id = $conexion->insert_id;
        $consulta->close();
        $conexion->close();
        return $id;
    }

    public static function update(usuarios $usuario) {
        $sql = 'UPDATE usuarios SET nombre = ?, email = ?, telefono = ?, direccion = ?, fecha_nacimiento = ?, rol = ? WHERE id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
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
        $conexion->close();
        return $resultado;
    }

    public static function delete($id) {
        $sql = 'DELETE FROM usuarios WHERE id = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('i', $id);
        $resultado = $consulta->execute();
        $consulta->close();
        $conexion->close();
        return $resultado;
    }

    public static function selectByEmail($email) {
        $sql = 'SELECT id, nombre, email, password, telefono, direccion, fecha_nacimiento, rol, fecha_registro FROM usuarios WHERE email = ?';
        $conexion = DataBase::connect();
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('s', $email);
        $consulta->execute();
        $fila = $consulta->get_result()->fetch_object();
        $consulta->close();
        $conexion->close();
        return $fila;
    }
}
?>