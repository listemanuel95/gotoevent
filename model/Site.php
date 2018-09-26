<?php

namespace model;

class Site {

    private $id;
    private $city;
    private $province;
    private $address;
    private $establishment;

    public function __construct($city, $province, $address, $establishment, $id = null)
    {
        $this->id = $id;
        $this->city = $city;
        $this->province = $province;
        $this->address = $address;
        $this->establishment = $establishment;
    }

    public function getID()
    {
        return $this->id;
    }
    
    public function get_city()
    {
        return $this->city;
    }

    public function get_province()
    {
        return $this->province;
    }

    public function get_address()
    {
        return $this->address;
    }

    public function get_establishment()
    {
        return $this->establishment;
    }
}

?>