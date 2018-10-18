<?php

namespace model;

class Seat {

    private $id;
    private $number;
    private $price;
    private $type;
    private $calendar;

    public function __construct($number, $price, $type, $calendar, $id = null)
    {
        $this->id = $id;
        $this->number = $number;
        $this->price = $price;
        $this->type = $type;
        $this->calendar = $calendar;
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