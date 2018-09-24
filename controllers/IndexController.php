<?php

namespace controllers;

class IndexController {

    public function index()
    {
        require(ROOT . '/views/index.php');
    }
}

?>