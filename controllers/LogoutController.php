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

    public function index()
    {
        // borramos la sesión
        session_unset();
        session_destroy();

        header("Location: index.php");
    }
}

?>