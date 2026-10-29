<?php
class pedidos {
    protected $id;
    protected $usuario_id;
    protected $estado;
    protected $fecha_pedido;
    protected $subtotal;
    protected $descuento;
    protected $total;
    protected $metodo_pago;
    protected $estado_pago;

    public function __construct($id = null, $usuario_id = null, $estado = null, $fecha_pedido = null, $subtotal = null, $descuento = null, $total = null, $metodo_pago = null, $estado_pago = null) {
        $this->id = $id;
        $this->usuario_id = $usuario_id;
        $this->estado = $estado;
        $this->fecha_pedido = $fecha_pedido;
        $this->subtotal = $subtotal;
        $this->descuento = $descuento;
        $this->total = $total;
        $this->metodo_pago = $metodo_pago;
        $this->estado_pago = $estado_pago;
    }

    public function getId() { 
        return $this->id; 
    }

    public function setId($id) { 
        $this->id = $id; 
    }

    public function getUsuarioId() { 
        return $this->usuario_id; 
    }

    public function setUsuarioId($usuario_id) { 
        $this->usuario_id = $usuario_id; 
    }

    public function getEstado() { 
        return $this->estado; 
    }

    public function setEstado($estado) { 
        $this->estado = $estado; 
    }

    public function getFechaPedido() { 
        return $this->fecha_pedido; 
    }

    public function setFechaPedido($fecha_pedido) { 
        $this->fecha_pedido = $fecha_pedido; 
    }

    public function getSubtotal() { 
        return $this->subtotal; 
    }

    public function setSubtotal($subtotal) { 
        $this->subtotal = $subtotal; 
    }

    public function getDescuento() { 
        return $this->descuento; 
    }

    public function setDescuento($descuento) { 
        $this->descuento = $descuento; 
    }

    public function getTotal() { 
        return $this->total; 
    }

    public function setTotal($total) { 
        $this->total = $total; 
    }

    public function getMetodoPago() { 
        return $this->metodo_pago; 
    }

    public function setMetodoPago($metodo_pago) { 
        $this->metodo_pago = $metodo_pago; 
    }

    public function getEstadoPago() { 
        return $this->estado_pago; 
    }

    public function setEstadoPago($estado_pago) { 
        $this->estado_pago = $estado_pago; 
    }
}
?>
