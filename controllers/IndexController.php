<?php

namespace controllers;

use model\Event as Event;
use dao\EventDBDAO as EventDBDAO;

/**
 * Controladora de la página de inicio
 */
class IndexController {

    /**
     *  Página de inicio
     */
    public function index()
    {
        require(ROOT . '/views/index.php');
    }
}

?>