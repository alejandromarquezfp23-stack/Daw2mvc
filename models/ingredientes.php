<?php
class Ingredientes {
    protected $id;
    protected $nombre;
    protected $precio_extra;
    protected $activo;

    public function __construct($id = null, $nombre = null, $precio_extra = null, $activo = null) {
        if ($id !== null) {
            $this->id = $id;
        }

        if($nombre !== null) {
            $this->nombre = $nombre;
        }

        if ($precio_extra !== null) {
            $this->precio_extra = $precio_extra;
        }

        if($activo !== null) {
            $this->activo = $activo;
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

    public function getPrecioExtra() {
            return $this->precio_extra;
        }

    public function setPrecioExtra($precio_extra) {
        $this->precio_extra = $precio_extra;
    }

    public function getActivo() {
            return $this->activo;
        }

    public function setActivo($activo) {
        $this->activo = $activo;
    }
}
?>