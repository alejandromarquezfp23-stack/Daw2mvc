<?php
    class productosDAO {
        private $conexion;

        public function __construct(mysqli $conexion) {
            $this->conexion = $conexion;
        }

        public function selectAll() {
            $sql = 'SELECT id, categoria_id, nombre, descripcion, precio, imagen, activo FROM productos ORDER BY id';
            $consulta = $this->conexion->query($sql);
            $resultados = $consulta->fetch_all(MYSQLI_ASSOC);

            $listaProductos = [];
            foreach ($resultados as $fila) {
                $prod = new productos();
                $prod->setId($fila['id']);
                $prod->setCategoriaId($fila['categoria_id']);
                $prod->setNombre($fila['nombre']);
                $prod->setDescripcion($fila['descripcion']);
                $prod->setPrecio($fila['precio']);
                $prod->setImagen($fila['imagen']);
                $prod->setActivo($fila['activo']);
                $listaProductos[] = $prod;
            }

            return $listaProductos;
        }

        public function selectByID($id) {
            $sql = 'SELECT id, categoria_id, nombre, descripcion, precio, imagen, activo FROM productos WHERE id = ?';
            $consulta = $this->conexion->prepare($sql);
            $consulta->bind_param("i", $id);
            $consulta->execute();
            $resultado = $consulta->get_result();
            $fila = $resultado->fetch_assoc();

            if ($fila) {
                $prod = new productos();
                $prod->setId($fila['id']);
                $prod->setCategoriaId($fila['categoria_id']);
                $prod->setNombre($fila['nombre']);
                $prod->setDescripcion($fila['descripcion']);
                $prod->setPrecio($fila['precio']);
                $prod->setImagen($fila['imagen']);
                $prod->setActivo($fila['activo']);
                return $prod;
            }

            return null;
        }

        public function insert(productos $producto) {
            $sql = 'INSERT INTO productos (categoria_id, nombre, descripcion, precio, imagen, activo) VALUES (?, ?, ?, ?, ?, ?)';
            $consulta = $this->conexion->prepare($sql);
            $categoria_id = $producto->getCategoriaId();
            $nombre = $producto->getNombre();
            $descripcion = $producto->getDescripcion();
            $precio = $producto->getPrecio();
            $imagen = $producto->getImagen();
            $activo = $producto->getActivo();

            $consulta->bind_param("issdsi", $categoria_id, $nombre, $descripcion, $precio, $imagen, $activo);
            $consulta->execute();

            return $this->conexion->insert_id;
        }

        public function update(productos $producto) {
            $sql = 'UPDATE productos SET categoria_id = ?, nombre = ?, descripcion = ?, precio = ?, imagen = ?, activo = ? WHERE id = ?';
            $consulta = $this->conexion->prepare($sql);
            $categoria_id = $producto->getCategoriaId();
            $nombre = $producto->getNombre();
            $descripcion = $producto->getDescripcion();
            $precio = $producto->getPrecio();
            $imagen = $producto->getImagen();
            $activo = $producto->getActivo();
            $id = $producto->getId();

            $consulta->bind_param("issdsii", $categoria_id, $nombre, $descripcion, $precio, $imagen, $activo, $id);
            return $consulta->execute();
        }

        public function delete($id) {
            $sql = 'DELETE FROM productos WHERE id = ?';
            $consulta = $this->conexion->prepare($sql);
            $consulta->bind_param("i", $id);
            return $consulta->execute();
        }
    } 
?>