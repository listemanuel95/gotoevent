<?php

namespace model;

/**
 * Objeto para líneas de compra
 */
class PurchaseLine {

    private $id;
    private $seats;

    public function __construct($seats, $id = null)
    {
        $this->seats = $seats;
        $this->id = $id;
    }
    
    public function get_seats()
    {
        return $this->seats;
    }

    public function getID()
    {
        return $this->id;
    }
}

?>