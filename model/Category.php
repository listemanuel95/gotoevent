<?php

namespace model;

class Category {

    private $id;
    private $name;

    public function __construct($name, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getID()
    {
        return $this->id;
    }
    
    public function get_name()
    {
        return $this->name;
    }

}

?>