<?php

namespace model;

class Calendar {

    private $id;
    private $desc;
    private $date;
    private $time;
    
    public function __construct($desc, $date, $time, $id = null)
    {
        $this->desc = $desc;
        $this->date = $date;
        $this->time = $time;
        $this->id = $id;
    }

    public function getID() 
    {
        return $this->id;
    }

    public function get_desc()
    {
        return $this->desc;
    }
    
    public function get_date()
    {
        return $this->date;
    }

    public function get_time()
    {
        return $this->time;
    }

}

?>