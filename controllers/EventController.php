<?php

namespace controllers;

use model\Artist as Artist;
use dao\ArtistDBDAO as ArtistDBDAO;

class EventController {

    public function index()
    {
        require(ROOT . '/views/addevent.php');
    }

    // PARA TESTEAR
    public function saveartist()
    {
        $test = ArtistDBDAO::get_instance();
        $test->create(new Artist('asd', 'qwe'));
    }
}

?>