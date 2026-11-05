<?php
class producto_ingrediente {
    protected $producto_id;
    protected $ingrediente_id;
    protected $cantidad;

    public function __construct($producto_id = null, $ingrediente_id = null, $cantidad = null) {
        if ($producto_id !== null) {
            $this->producto_id = $producto_id;
        }

        if ($ingrediente_id !== null) {
            $this->ingrediente_id = $ingrediente_id;
        }

        if ($cantidad !== null) {
            $this->cantidad = $cantidad;
        }
    }

    public function getProductoId() { 
        return $this->producto_id; 
    }

    public function setProductoId($producto_id) { 
        $this->producto_id = $producto_id; 
    }

    public function getIngredienteId() { 
        return $this->ingrediente_id; 
    }

    public function setIngredienteId($ingrediente_id) { 
        $this->ingrediente_id = $ingrediente_id; 
    }

    public function getCantidad() { 
        return $this->cantidad; 
    }

    public function setCantidad($cantidad) { 
        $this->cantidad = $cantidad; 
    }
}
?>
