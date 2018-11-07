<?php

namespace model;

class Ticket {

    private $id;
    private $seat;
    private $invoice;
    private $qrcode;

    public function __construct($seat, $invoice, $qrcode, $id = null)
    {
        $this->id = $id;
        $this->seat = $seat;
        $this->invoice = $invoice;
        $this->qrcode = $qrcode;
    }

    public function getID()
    {
        return $this->id;
    }
    
    public function get_seat()
    {
        return $this->seat;
    }
    
    public function get_invoice()
    {
        return $this->invoice;
    }

    public function get_qrcode()
    {
        return $this->qrcode;
    }

}

?>