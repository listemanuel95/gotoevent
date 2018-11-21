<?php

namespace dao;

use interfaces\IDAO as IDAO;

use model\Invoice as Invoice;

class InvoiceDBDAO extends SingletonDAO implements IDAO {

    public function create($instance)
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        try {
            $statement = $conn->prepare("INSERT INTO `invoices` (`user_id`) VALUES (:u_id)");
            
            $statement->bindValue(':u_id', $instance->get_user()->getID());
            $statement->execute(); 

            $last_id = $conn->lastInsertID();

            return $last_id;
        } catch (PDOException $e) { // TODO: excepciones mas copadas
            echo "ERROR " . $e->getMessage();
        }
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

}

?>