<?php

namespace model;

class Event {

    private $id;
    private $name;
    private $desc;

    public function __construct($name, $desc, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;
    }

    public function getID()
    {
        return $this->id;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_desc()
    {
        return $this->desc;
    }
    
}

?>