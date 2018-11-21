<?php

namespace dao;

use interfaces\IDAO as IDAO;

use model\Site as Site;

class SiteDBDAO extends SingletonDAO implements IDAO {

    public function create($instance)
    {
        if($instance instanceof Site)
        {
            $conn = new Connection();
            $conn = $conn->get_connection();

            try {
                $statement = $conn->prepare("INSERT INTO `sites` (`city`, `province`, `address`, `establishment`, `capacity`) 
                    VALUES (:city, :province, :address, :establishment, :capacity)");

                $statement->bindValue(':city', $instance->get_city());
                $statement->bindValue(':province', $instance->get_province());
                $statement->bindValue(':address', $instance->get_address());
                $statement->bindValue(':establishment', $instance->get_establishment());
                $statement->bindValue(':capacity', $instance->get_capacity());

                $statement->execute();

                return true;
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }

        } else {
            throw new \Exception("Error en create Site");
        }

        return false;
    }

    public function retrieve($instance)
    {
        if($instance instanceof Site)
        {
            $conn = new Connection();
            $conn = $conn->get_connection();

            if($conn != null)
            {
                try {
                    $establishment = $instance->get_establishment();
                    $statement = $conn->prepare("SELECT * FROM `sites` WHERE `establishment` = '$establishment'");
                    $statement->execute();
                    $site = $statement->fetch();
                    $ret = new Site($site['city'], $site['province'], $site['address'], $site['establishment'], $site['capacity'], $site['id']);
                    
                    return $ret;
                } catch (PDOException $e) { // TODO: excepciones mas copadas
                    echo "ERROR " . $e->getMessage();
                }
            }
        } else {
            throw new \Exception("Error en retrieve Site");
        }
    }

    public function retrieve_by_establishment($establishment)
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {
                $statement = $conn->prepare("SELECT * FROM `sites` WHERE `establishment` = '$establishment'");
                $statement->execute();
                $site = $statement->fetch();
                $ret = new Site($site['city'], $site['province'], $site['address'], $site['establishment'], $site['capacity'], $site['id']);
                
                return $ret;
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }
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

                // hay que devolver objetos!!!
                $resultados = $statement->fetchAll();

                // esto voy a devolver                
                $ret = array();

                foreach($resultados as $site)
                    $ret[] = new Site($site['city'], $site['province'], $site['address'], $site['establishment'], $site['capacity'], $site['id']);

                return $ret;
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }    

        return null;
    }

}

?>