<?php

namespace controllers;

use model\Event as Event;
use dao\EventDBDAO as EventDBDAO;

/**
 * Controladora de la página de inicio
 */
class IndexController {

    private $eventdao;

    /**
     * Constructor para obtener los DAOs
     */
    public function __construct()
    {
        $this->eventdao = EventDBDAO::get_instance();
    }

    /**
     *  Página de inicio
     */
    public function index()
    {
        $eventosDB = $this->eventdao->retrieve_all();
        require(ROOT . '/views/index.php');
    }
}

?>