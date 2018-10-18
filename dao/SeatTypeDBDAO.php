<?php

namespace dao;

use model\SeatType as SeatType;

class SeatTypeDBDAO extends SingletonDAO implements IDAO {

    public function create($instance)
    {
        if($instance instanceof SeatType)
        {
            $conn = new Connection();
            $conn = $conn->get_connection();

            try {

            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }

        } else {
            throw new \Exception("Error en create Seat");
        }

        return false;
    }

    public function retrieve($instance)
    {
        if($instance instanceof SeatType)
        {
            $conn = new Connection();
            $conn = $conn->get_connection();

            if($conn != null)
            {
                try {
                    

                } catch (PDOException $e) { // TODO: excepciones mas copadas
                    echo "ERROR " . $e->getMessage();
                }
            }
        } else {
            throw new \Exception("Error en retrieve Seat");
        }
    }

    public function update($instance)
    {

    }

    public function delete($instance)
    {
        
    }

    public function retrieve_all()
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {

                $statement = $conn->prepare("SELECT * FROM `seat_types`");
                $statement->execute();

                // hay que devolver objetos!!!
                $resultados = $statement->fetchAll();

                // esto voy a devolver                
                $ret = array();

                foreach($resultados as $st)
                    $ret[] = new SeatType($st['type'], $st['id']);

                return $ret;

            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }    

        return null;
    }

}

?>