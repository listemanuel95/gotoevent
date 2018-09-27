<?php

namespace model;

class Artist {

    private $id;
    private $name;
    private $genre;

    public function __construct($n, $g, $id = null)
    {
        $this->name = $n;
        $this->genre = $g;
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

    public function set_name($n)
    {
        $this->name = $n;
    }

    public function set_genre($g)
    {
        $this->genre = $g;
    }
}

?>