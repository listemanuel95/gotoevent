<?php

namespace model;

/**
 * Objeto compra
 */
class Purchase {
    
    private $id;
    private $date;
    private $purchase_lines;

    public function __construct($date, $purchase_lines, $id = null) 
    {
        $this->id = $id;
        $this->purchase_lines = $purchase_lines;
        $this->date = $date;
    }

    public function getID()
    {
        return $this->id;
    }

    public function get_purchase_lines()
    {
        return $this->purchase_lines;
    }

    public function get_date()
    {
        return $this->date;
    }
    
}
?>