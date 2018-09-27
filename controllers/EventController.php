<?php

namespace controllers;

use model\Site as Site;
use dao\SiteDBDAO as SiteDBDAO;

class EventController {

    public function index()
    {
        $lugares = array();

        $sitedao = SiteDBDAO::get_instance();
        $lugaresDB = $sitedao->retrieve_all();

        require(ROOT . '/views/addevent.php');
    }

}

?>