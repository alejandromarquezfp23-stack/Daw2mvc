<?php
class oferta_producto {
    protected $oferta_id;
    protected $producto_id;

    public function __construct($oferta_id = null, $producto_id = null) {
        $this->oferta_id = $oferta_id;
        $this->producto_id = $producto_id;
    }

    public function getOfertaId() { 
        return $this->oferta_id; 
    }

    public function setOfertaId($oferta_id) { 
        $this->oferta_id = $oferta_id; 
    }

    public function getProductoId() { 
        return $this->producto_id; 
    }

    public function setProductoId($producto_id) { 
        $this->producto_id = $producto_id; 
    }
}
?>
