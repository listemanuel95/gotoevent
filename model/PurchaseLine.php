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

    public function get_subtotal()
    {
        if(count($this->seats) > 0)
            return count($this->seats) * $this->seats[0]->get_price();
    
        return 0;
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