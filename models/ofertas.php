<?php
class ofertas {
    protected $id;
    protected $nombre;
    protected $descripcion;
    protected $tipo;
    protected $valor;
    protected $codigo;
    protected $fecha_inicio;
    protected $fecha_fin;
    protected $activa;

    public function __construct($id = null, $nombre = null, $descripcion = null, $tipo = null, $valor = null, $codigo = null, $fecha_inicio = null, $fecha_fin = null, $activa = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->tipo = $tipo;
        $this->valor = $valor;
        $this->codigo = $codigo;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->activa = $activa;
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

    public function getTipo() { 
        return $this->tipo; 
    }

    public function setTipo($tipo) { 
        $this->tipo = $tipo; 
    }

    public function getValor() { 
        return $this->valor; 
    }

    public function setValor($valor) { 
        $this->valor = $valor; 
    }

    public function getCodigo() { 
        return $this->codigo; 
    }

    public function setCodigo($codigo) { 
        $this->codigo = $codigo; 
    }

    public function getFechaInicio() { 
        return $this->fecha_inicio; 
    }

    public function setFechaInicio($fecha_inicio) { 
        $this->fecha_inicio = $fecha_inicio; 
    }

    public function getFechaFin() { 
        return $this->fecha_fin; 
    }

    public function setFechaFin($fecha_fin) { 
        $this->fecha_fin = $fecha_fin; 
    }

    public function getActiva() { 
        return $this->activa; 
    }

    public function setActiva($activa) { 
        $this->activa = $activa; 
    }
}
?>
