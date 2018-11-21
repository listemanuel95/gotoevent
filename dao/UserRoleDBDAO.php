<?php

namespace dao;

use interfaces\IDAO as IDAO;

use model\UserRole as UserRole;

class UserRoleDBDAO extends SingletonDAO implements IDAO {

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
     * FUNCIONES AUXILIARES PARA OBTENER ROLES ESPECÍFICOS
     */

    public function retrieve_role($role)
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        try {

            // agarramos el rol de usuario
            $statement = $conn->prepare("SELECT * FROM `user_roles` WHERE `name` = '$role'");
            $statement->execute(); 

            $res = $statement->fetch();

            return new UserRole($res['name'], $res['id']);
        } catch (PDOException $e) { // TODO: excepciones mas copadas
            echo "ERROR " . $e->getMessage();
        }
    }

}

?>