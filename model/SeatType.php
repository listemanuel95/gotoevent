<?php

namespace model;

class SeatType {

    private $id;
    private $type;

    public function __construct($type, $id = null)
    {
        $this->id = $id;
        $this->type = $type;
    }

    public function getID()
    {
        return $this->id;
    }
    
    public function get_type()
    {
        return $this->type;
    }

}

?>