<?php
    class categorias {
        protected $id;
        protected $nombre;
        protected $descripcion;
        protected $activa;
        protected $imagenes;

        public function __construct($id = null, $nombre = null, $descripcion = null, $activa = null, $imagenes = null) {
            if($id !== null) {
                $this->id = $id;
            }

            if ($nombre !== null) {
                $this->nombre = $nombre;
            }

            if ($descripcion !== null) {
                $this->descripcion = $descripcion;
            }

            if ($activa !== null) {
                $this->activa = $activa;
            }

            if ($imagenes !== null) {
                $this->imagenes = $imagenes;
            }
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        public function getDescripcion() {
            return $this->descripcion;
        }

        public function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }

        public function getActiva() {
            return $this->activa;
        }

        public function setActiva($activa) {
            $this->activa = $activa;
        }

        public function getImagenes() {
            return $this->imagenes;
        }

        public function setImagenes($imagenes) {
            $this->imagenes = $imagenes;
        }
    }
?>