<?php
class usuarios {
    protected $id;
    protected $nombre;
    protected $email;
    protected $password;
    protected $telefono;
    protected $direccion;
    protected $fecha_nacimiento;
    protected $rol;
    protected $fecha_registro;

    public function __construct($id = null, $nombre = null, $email = null, $password = null, $telefono = null, $direccion = null, $fecha_nacimiento = null, $rol = null, $fecha_registro = null) {
        if ($id !== null) {
            $this->id = $id;
        }

        if ($nombre !== null) {
            $this->nombre = $nombre;
        }

        if ($email !== null) {
            $this->email = $email;
        }

        if ($password !== null) {
            $this->password = $password;
        }

        if ($telefono !== null) {
            $this->telefono = $telefono;
        }

        if ($direccion !== null) {
            $this->direccion = $direccion;
        }

        if ($fecha_nacimiento !== null) {
            $this->fecha_nacimiento = $fecha_nacimiento;
        }

        if ($rol !== null) {
            $this->rol = $rol;
        }

        if ($fecha_registro !== null) {
            $this->fecha_registro = $fecha_registro;
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

    public function getEmail() { 
        return $this->email; 
    }

    public function setEmail($email) { 
        $this->email = $email; 
    }

    public function getPassword() { 
        return $this->password; 
    }

    public function setPassword($password) { 
        $this->password = $password; 
    }

    public function getTelefono() { 
        return $this->telefono; 
    }

    public function setTelefono($telefono) { 
        $this->telefono = $telefono; 
    }

    public function getDireccion() { 
        return $this->direccion; 
    }

    public function setDireccion($direccion) { 
        $this->direccion = $direccion; 
    }

    public function getFechaNacimiento() { 
        return $this->fecha_nacimiento; 
    }

    public function setFechaNacimiento($fecha_nacimiento) { 
        $this->fecha_nacimiento = $fecha_nacimiento; 
    }

    public function getRol() { 
        return $this->rol; 
    }

    public function setRol($rol) { 
        $this->rol = $rol; 
    }

    public function getFechaRegistro() { 
        return $this->fecha_registro; 
    }

    public function setFechaRegistro($fecha_registro) { 
        $this->fecha_registro = $fecha_registro; 
    }
}
?>
