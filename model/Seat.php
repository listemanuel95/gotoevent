<?php

namespace model;

class Seat {

    private $id;
    private $number;
    private $price;
    private $type;
    private $availability;
    private $calendar;

    public function __construct($number, $price, $type, $calendar, $availability, $id = null)
    {
        $this->id = $id;
        $this->number = $number;
        $this->price = $price;
        $this->type = $type;
        $this->availability = $availability;
        $this->calendar = $calendar;
    }
    
    public function change_availability()
    {
        if($this->availability == 0)
            $this->availability = 1;
        else
            $this->availability = 0;
    }

    public function getID()
    {
        return $this->id;
    }
    
    public function get_price()
    {
        return $this->price;
    }

    public function get_type()
    {
        return $this->type;
    }

    public function get_availability()
    {
        return $this->availability;
    }

    public function get_calendar()
    {
        return $this->calendar;
    }

    public function get_number()
    {
        return $this->number;
    }
}
?>