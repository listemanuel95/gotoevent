<?php

namespace dao;

class Connection {

    public function get_connection()
    {
        $conn = null;
        
        try {
            $conn = new \PDO("mysql:host=".HOST.";dbname=".DB,USER,PASS);
            $conn->exec("set names utf8");
        } catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

        return $conn;
    }
}

?>