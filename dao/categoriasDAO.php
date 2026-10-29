<?php
require_once __DIR__ . '/../models/categorias.php';

    class categoriasDAO {
        private $conexion;

        public function __construct(mysqli $conexion) {
            $this->conexion = $conexion;
        }

        public function selectAll() {
            $sql = 'SELECT id, nombre, descripcion, activa, imagenes FROM categorias ORDER BY id';
            $consulta = $this->conexion->query($sql);
            $resultados = $consulta->fetch_all(MYSQLI_ASSOC);

            $listaCategorias = [];
            foreach ($resultados as $fila) {
                $cat = new categorias();
                $cat->setId($fila['id']);
                $cat->setNombre($fila['nombre']);
                $cat->setDescripcion($fila['descripcion']);
                $cat->setActiva($fila['activa']);
                $cat->setImagenes($fila['imagenes']);
                $listaCategorias[] = $cat;
            }

            return $listaCategorias;
        }

        public function selectByID($id) {
            $sql = 'SELECT id, nombre, descripcion, activa, imagenes FROM categorias WHERE id = ?';
            $consulta = $this->conexion->prepare($sql);
            $consulta->bind_param("i", $id);
            $consulta->execute();
            $resultado = $consulta->get_result();
            $fila = $resultado->fetch_assoc();

            if ($fila) {
                $cat = new categorias();
                $cat->setId($fila['id']);
                $cat->setNombre($fila['nombre']);
                $cat->setDescripcion($fila['descripcion']);
                $cat->setActiva($fila['activa']);
                $cat->setImagenes($fila['imagenes']);
                return $cat;
            }

            return null;
        }

        public function insert(categorias $categoria) {
            $sql = 'INSERT INTO categorias (nombre, descripcion, activa, imagenes) VALUES (?, ?, ?, ?)';
            $consulta = $this->conexion->prepare($sql);
            $nombre = $categoria->getNombre();
            $descripcion = $categoria->getDescripcion();
            $activo = $categoria->getActiva();
            $imagenes = $categoria->getImagenes();
            
            $consulta->bind_param("ssis", $nombre, $descripcion, $activo, $imagenes);
            $consulta->execute();

            return $this->conexion->insert_id;
        }

        public function update(categorias $categoria) {
            $sql = 'UPDATE categorias SET nombre = ?, descripcion = ?, activa = ?, imagenes = ? WHERE id = ?';
            $consulta = $this->conexion->prepare($sql);
            
            $nombre = $categoria->getNombre();
            $descripcion = $categoria->getDescripcion();
            $activo = $categoria->getActiva();
            $imagenes = $categoria->getImagenes();
            $id = $categoria->getId();
            $consulta->bind_param("ssisi", $nombre, $descripcion, $activo, $imagenes, $id);
            
            return $consulta->execute();
        }

        public function delete($id) {
            $sql = 'DELETE FROM categorias WHERE id = ?';
            $consulta = $this->conexion->prepare($sql);
            
            $consulta->bind_param("i", $id);
            
            return $consulta->execute();
        }
    }
?>
