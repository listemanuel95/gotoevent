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

    public function getName()
    {
        return $this->name;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setName($n)
    {
        $this->name = $n;
    }

    public function setGenre($g)
    {
        $this->genre = $g;
    }
}

?>