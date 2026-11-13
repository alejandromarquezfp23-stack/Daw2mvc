<?php
    require_once __DIR__ . '/../models/favoritos.php';
    require_once __DIR__ . '/../dao/favoritosDAO.php';

    class FavoritosController {
        public function store() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $usuarioID = $_SESSION['usuario']->id ?? null;
            $id = filter_input(INPUT_POST, 'producto_id', FILTER_VALIDATE_INT);

            if (!$id || $id < 1) {
                showError(400, 'El producto indicado no es válido.');
            }

            if (!$usuarioID) {
                $_SESSION['mensaje_favoritos'] = 'Debes iniciar sesión para guardar productos en favoritos.';
                $_SESSION['tipo_mensaje_favoritos'] = 'danger';
            } elseif (!favoritosDAO::selectByIDs($id, (int) $usuarioID)) {
                $productoFavorito = new favoritos($id, (int) $usuarioID);
                favoritosDAO::insert($productoFavorito);

                $_SESSION['mensaje_favoritos'] = 'Producto añadido a favoritos.';
                $_SESSION['tipo_mensaje_favoritos'] = 'success';
            }

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        public function destroy() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $usuarioID = $_SESSION['usuario']->id ?? null;
            $id = filter_input(INPUT_POST, 'producto_id', FILTER_VALIDATE_INT);

            if (!$id || $id < 1) {
                showError(400, 'El producto indicado no es válido.');
            }

            if (!$usuarioID) {
                $_SESSION['mensaje_favoritos'] = 'Debes iniciar sesión para modificar tus favoritos.';
                $_SESSION['tipo_mensaje_favoritos'] = 'danger';
            } else {
                favoritosDAO::delete($id, (int) $usuarioID);

                $_SESSION['mensaje_favoritos'] = 'Producto eliminado de favoritos.';
                $_SESSION['tipo_mensaje_favoritos'] = 'success';
            }

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
?>