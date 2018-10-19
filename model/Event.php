<?php

namespace model;

class Event {

    private $id;
    private $name;
    private $desc;
    private $cat;
    private $img;

    public function __construct($name, $desc, $cat, $img, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;
        $this->cat = $cat;
        $this->img = $img;
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

    public function get_category()
    {
        return $this->cat;
    }
    
    public function get_image_link()
    {
        return $this->img;
    }
}

?>