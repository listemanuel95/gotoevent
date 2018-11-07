<?php

namespace model;

class Invoice {

    private $id;
    private $user;

    public function __construct($user, $id = null)
    {
        $this->id = $id;
        $this->user = $user;
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }
    
    public function get_user()
    {
        return $this->user;
    }

}

?>