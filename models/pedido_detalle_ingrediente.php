<?php
class pedido_detalle_ingrediente {
    protected $id;
    protected $pedido_detalle_id;
    protected $ingrediente_id;
    protected $nombre_ingrediente;
    protected $precio_extra;
    protected $accion;

    public function __construct($id = null, $pedido_detalle_id = null, $ingrediente_id = null, $nombre_ingrediente = null, $precio_extra = null, $accion = null) {
        $this->id = $id;
        $this->pedido_detalle_id = $pedido_detalle_id;
        $this->ingrediente_id = $ingrediente_id;
        $this->nombre_ingrediente = $nombre_ingrediente;
        $this->precio_extra = $precio_extra;
        $this->accion = $accion;
    }

    public function getId() { 
        return $this->id; 
    }

    public function setId($id) { 
        $this->id = $id; 
    }

    public function getPedidoDetalleId() { 
        return $this->pedido_detalle_id; 
    }

    public function setPedidoDetalleId($pedido_detalle_id) { 
        $this->pedido_detalle_id = $pedido_detalle_id; 
    }

    public function getIngredienteId() { 
        return $this->ingrediente_id; 
    }

    public function setIngredienteId($ingrediente_id) { 
        $this->ingrediente_id = $ingrediente_id; 
    }

    public function getNombreIngrediente() { 
        return $this->nombre_ingrediente; 
    }

    public function setNombreIngrediente($nombre_ingrediente) { 
        $this->nombre_ingrediente = $nombre_ingrediente; 
    }

    public function getPrecioExtra() { 
        return $this->precio_extra; 
    }

    public function setPrecioExtra($precio_extra) { 
        $this->precio_extra = $precio_extra; 
    }

    public function getAccion() { 
        return $this->accion; 
    }

    public function setAccion($accion) { 
        $this->accion = $accion; 
    }
}
?>
