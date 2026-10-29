<?php
class pedido_detalle {
    protected $id;
    protected $pedido_id;
    protected $producto_id;
    protected $nombre_producto;
    protected $precio_unitario;
    protected $cantidad;
    protected $subtotal;

    public function __construct($id = null, $pedido_id = null, $producto_id = null, $nombre_producto = null, $precio_unitario = null, $cantidad = null, $subtotal = null) {
        $this->id = $id;
        $this->pedido_id = $pedido_id;
        $this->producto_id = $producto_id;
        $this->nombre_producto = $nombre_producto;
        $this->precio_unitario = $precio_unitario;
        $this->cantidad = $cantidad;
        $this->subtotal = $subtotal;
    }

    public function getId() { 
        return $this->id; 
    }

    public function setId($id) { 
        $this->id = $id; 
    }

    public function getPedidoId() { 
        return $this->pedido_id; 
    }

    public function setPedidoId($pedido_id) { 
        $this->pedido_id = $pedido_id; 
    }

    public function getProductoId() { 
        return $this->producto_id; 
    }

    public function setProductoId($producto_id) { 
        $this->producto_id = $producto_id; 
    }

    public function getNombreProducto() { 
        return $this->nombre_producto; 
    }
    public function setNombreProducto($nombre_producto) { 
        $this->nombre_producto = $nombre_producto; 
    }

    public function getPrecioUnitario() { 
        return $this->precio_unitario; 
    }

    public function setPrecioUnitario($precio_unitario) { 
        $this->precio_unitario = $precio_unitario; 
    }

    public function getCantidad() { 
        return $this->cantidad; 
    }

    public function setCantidad($cantidad) { 
        $this->cantidad = $cantidad; 
    }

    public function getSubtotal() { 
        return $this->subtotal; 
    }
    public function setSubtotal($subtotal) { 
        $this->subtotal = $subtotal; 
    }
}
?>
