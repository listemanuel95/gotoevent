<?php

namespace model;

use model\PurchaseLine as PurchaseLine;

/**
 * Objeto compra
 */
class Purchase {
    
    private $id;
    private $date;
    private $purchase_lines;
    private $user;

    public function __construct($date, $purchase_lines, $user, $id = null) 
    {
        $this->id = $id;
        $this->purchase_lines = $purchase_lines;
        $this->user = $user;
        $this->date = $date;
    }

    public function add_purchase_line($line)
    {
        if($line instanceof PurchaseLine)
            $this->purchase_lines[] = $line;
    }

    public function getID()
    {
        return $this->id;
    }

    public function get_purchase_lines()
    {
        return $this->purchase_lines;
    }

    public function get_user()
    {
        return $this->user;
    }

    public function get_date()
    {
        return $this->date;
    }

    public function get_total()
    {
        $total = 0;
        foreach($this->purchase_lines as $pl)
        {
            $total += $pl->get_subtotal();
        }

        return $total;
    }

    public function remove_line($index)
    {
        array_splice($this->purchase_lines, $index, 1);
    }
    
}
?>