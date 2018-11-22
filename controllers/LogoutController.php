<?php

namespace controllers;

/**
 * Controladora simple para cerrar sesión
 */
class LogoutController {

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Elimina el usuario de la sesión (y también, por ende, su carrito -si hubiera-)
     */
    public function index()
    {
        // borramos la sesión
        session_unset();
        session_destroy();

        header("Location: index");
    }
}

?>