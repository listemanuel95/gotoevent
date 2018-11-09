<?php

namespace model;

class User {

    private $id;
    private $mail;
    private $password;
    private $role;

    public function __construct($mail, $password, $role, $id = null)
    {
        $this->id = $id;
        $this->mail = $mail;
        $this->password = $password;
        $this->role = $role;
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }
    
    public function get_mail()
    {
        return $this->mail;
    }

    public function get_password()
    {
        return $this->password;
    }

    public function get_role()
    {
        return $this->role;
    }
}

?>