<?php
require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/categorias.php';

    class categoriasDAO {
        public static function selectAll() {
            $sql = 'SELECT id, nombre, descripcion, activa, imagenes FROM categorias ORDER BY id';
            $conexion = DataBase::connect();
            $consulta = $conexion->query($sql);
            $listaCategorias = [];
            while ($categoria = $consulta->fetch_object('categorias')) {
                $listaCategorias[] = $categoria;
            }
            $consulta->close();
            $conexion->close();

            return $listaCategorias;
        }

        public static function selectByID($id) {
            $sql = 'SELECT id, nombre, descripcion, activa, imagenes FROM categorias WHERE id = ?';
            $conexion = DataBase::connect();
            $consulta = $conexion->prepare($sql);
            $consulta->bind_param("i", $id);
            $consulta->execute();
            $categoria = $consulta->get_result()->fetch_object('categorias');
            $consulta->close();
            $conexion->close();
            return $categoria ?: null;
        }

        public static function insert(categorias $categoria) {
            $sql = 'INSERT INTO categorias (nombre, descripcion, activa, imagenes) VALUES (?, ?, ?, ?)';
            $conexion = DataBase::connect();
            $consulta = $conexion->prepare($sql);
            $nombre = $categoria->getNombre();
            $descripcion = $categoria->getDescripcion();
            $activo = $categoria->getActiva();
            $imagenes = $categoria->getImagenes();
            
            $consulta->bind_param("ssis", $nombre, $descripcion, $activo, $imagenes);
            $consulta->execute();
            $id = $conexion->insert_id;
            $consulta->close();
            $conexion->close();
            return $id;
        }

        public static function update(categorias $categoria) {
            $sql = 'UPDATE categorias SET nombre = ?, descripcion = ?, activa = ?, imagenes = ? WHERE id = ?';
            $conexion = DataBase::connect();
            $consulta = $conexion->prepare($sql);
            
            $nombre = $categoria->getNombre();
            $descripcion = $categoria->getDescripcion();
            $activo = $categoria->getActiva();
            $imagenes = $categoria->getImagenes();
            $id = $categoria->getId();
            $consulta->bind_param("ssisi", $nombre, $descripcion, $activo, $imagenes, $id);
            $resultado = $consulta->execute();
            $consulta->close();
            $conexion->close();
            return $resultado;
        }

        public static function delete($id) {
            $sql = 'DELETE FROM categorias WHERE id = ?';
            $conexion = DataBase::connect();
            $consulta = $conexion->prepare($sql);
            
            $consulta->bind_param("i", $id);
            $resultado = $consulta->execute();
            $consulta->close();
            $conexion->close();
            return $resultado;
        }
    }
?>
