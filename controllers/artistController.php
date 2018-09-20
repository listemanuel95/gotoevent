<?php

namespace controllers;

class ArtistController {

    public function __construct()
    {
    }

    public function index()
    {
        require(ROOT . '/views/addartist.php');
    }
}

?>