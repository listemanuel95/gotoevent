<?php

namespace model;

class Calendar {

    private $id;
    private $desc;
    private $date;
    private $time;
    private $site;
    private $event;
    
    public function __construct($desc, $date, $time, $site, $event, $id = null)
    {
        $this->desc = $desc;
        $this->date = $date;
        $this->time = $time;
        $this->site = $site;
        $this->event = $event;
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

    public function get_event()
    {
        return $this->event();
    }

    public function get_site()
    {
        return $this->site;
    }
    
}

?>