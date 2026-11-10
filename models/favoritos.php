<?php
class favoritos {
    protected $producto_id;
    protected $usuario_id;

    public function __construct($producto_id = null, $usuario_id = null) {
        if ($producto_id !== null) {
            $this->producto_id = $producto_id;
        }

        if ($usuario_id !== null) {
            $this->usuario_id = $usuario_id;
        }
    }

    public function getProductoId() { 
        return $this->producto_id; 
    }

    public function setProductoId($producto_id) { 
        $this->producto_id = $producto_id; 
    }

    public function getUsuarioId() { 
        return $this->usuario_id; 
    }

    public function setUsuarioId($usuario_id) { 
        $this->usuario_id = $usuario_id; 
    }
}
?>
