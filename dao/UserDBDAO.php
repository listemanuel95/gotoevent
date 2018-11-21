<?php

namespace dao;

use interfaces\IDAO as IDAO;

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

                $last_id = $conn->lastInsertID();

                return $last_id;
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

    /**
     * Retrieve especial que recibe el user y la pass
     */
    public function retrieve_login($mail, $pass)
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {

                $statement = $conn->prepare("SELECT `U`.`id` AS `u_id`, `U`.`mail` AS `u_mail`, `U`.`password` AS `u_password`, `UR`.`id` AS `r_id`, `UR`.`name` AS `r_name` FROM `users` AS `U` JOIN `user_roles` AS `UR` ON `U`.`role_id` = `UR`.`id` WHERE `U`.`mail` = '$mail' AND `U`.`password` = '$pass'");
                $statement->execute();

                $res = $statement->fetch();

                if(isset($res['u_id']))
                    return new User($res['u_mail'], $res['u_password'], new UserRole($res['r_name'], $res['r_id']), $res['u_id']);

                return null;

            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }   
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