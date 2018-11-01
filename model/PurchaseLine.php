<?php

namespace model;

/**
 * Objeto para líneas de compra
 */
class PurchaseLine {

    private $id;
    private $seat;
    private $price;
    private $cant;

    public function __construct($seat, $price, $cant, $id = null)
    {
        $this->seat = $seat;
        $this->price = $price;
        $this->cant = $cant;
        $this->id = $id;
    }

    public function get_seat()
    {
        return $this->seat;
    }

    public function get_price()
    {
        return $this->price;
    }

    public function get_cant()
    {
        return $this->cant;
    }

    public function getID()
    {
        return $this->id;
    }
}

?>