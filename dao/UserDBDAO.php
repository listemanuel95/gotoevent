<?php

namespace dao;

use model\User as User;
use model\UserRole as UserRole;

class UserDBDAO extends SingletonDAO implements IDAO {

    public function create($instance)
    {
        if($instance instanceof User)
        {
            $conn = new Connection();
            $conn = $conn->get_connection();

            try {

                $statement = $conn->prepare("INSERT INTO `users` (`mail`, `password`, `role_id`) 
                                                        VALUES   (:mail, :pass, :rol)");
                
                $statement->bindValue(':mail', $instance->get_mail());
                $statement->bindValue(':pass', $instance->get_password());
                $statement->bindValue(':rol', $instance->get_role()->getID());
                $statement->execute();

                return true;
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }

        } else {
            throw new \Exception("Error en create User");
        }

        return false;
    }

    public function retrieve($instance)
    {
        if($instance instanceof User)
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
            throw new \Exception("Error en retrieve User");
        }
    }

    public function update($instance)
    {

    }

    public function delete($instance)
    {
        
    }

    public function retrieve_by_mail_boolean($mail)
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {

                $statement = $conn->prepare("SELECT * FROM `users` WHERE `mail` = '$mail'");
                $statement->execute();

                $num_rows = $statement->fetchColumn(); 

                return($num_rows > 0);

            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }    
    }

    public function retrieve_all()
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

        return null;
    }

}

?>