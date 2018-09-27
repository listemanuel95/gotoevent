<?php

namespace dao;

class Connection {

    public function get_connection()
    {
        try {
            $conn = new\PDO("mysql:host=".HOST.";dbname=".DB,USER,PASS);
        } catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

        return $conn;
    }
}

?>