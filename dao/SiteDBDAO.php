<?php

namespace dao;

use model\Site as Site;

class SiteDBDAO extends SingletonDAO implements IDAO {

    public function create($instance)
    {

    }

    public function retrieve($instance)
    {

    }

    public function update($instance)
    {

    }

    public function delete($instance)
    {
        
    }

    /**
     * Devuelve todos los sites :D
     */
    public function retrieve_all()
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {

                $statement = $conn->prepare("SELECT * FROM sites");
                $statement->execute();

                return $statement->fetchAll();
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }    

        return null;
    }

}

?>