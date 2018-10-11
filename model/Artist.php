<?php

namespace model;

class Artist {

    private $id;
    private $name;
    private $genre;

    public function __construct($name, $genre, $id = null)
    {
        $this->name = $name;
        $this->genre = $genre;
        $this->id = $id;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_genre()
    {
        return $this->genre;
    }

    public function getID()
    {
        return $this->id;
    }
}

?>