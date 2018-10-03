<?php

namespace controllers;

use model\Site as Site;
use dao\SiteDBDAO as SiteDBDAO;

use model\Category as Category;
use dao\CategoryDBDAO as CategoryDBDAO;

use model\Artist as Artist;
use dao\ArtistDBDAO as ArtistDBDAO;

class EventController {

    public function index()
    {
        $lugares = array();

        $sitedao = SiteDBDAO::get_instance();
        $lugaresDB = $sitedao->retrieve_all();

        $catdao = CategoryDBDAO::get_instance();
        $categoriasDB = $catdao->retrieve_all();

        $artdao = ArtistDBDAO::get_instance();
        $artistasDB = $artdao->retrieve_all();

        require(ROOT . '/views/addevent.php');
    }

}

?>