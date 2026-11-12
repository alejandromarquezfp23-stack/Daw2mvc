<?php
class PagarController {
    public function index() {
        $titulo = 'Pagar';
        $view = __DIR__ . '/../views/pagar.php';
        $css = 'pagar.css';
        require_once __DIR__ . '/../views/main3.php';
    }
}
?>