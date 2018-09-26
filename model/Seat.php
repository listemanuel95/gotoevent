<?php

namespace model;

class Seat {

    private $id;
    /// Aca va un atributo que es el tipo de plaza.

    public function __construct($id = null)
    {
        $this->id = $id;
    }
    
    public function getID()
    {
        return $this->id;
    }
    
}
?>