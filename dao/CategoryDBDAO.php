<?php

namespace dao;

use model\Category as Category;

class CategoryDBDAO extends SingletonDAO implements IDAO {

    public function create($instance)
    {
        if($instance instanceof Category)
        {
            $conn = new Connection();
            $conn = $conn->get_connection();
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

    public function retrieve_all()
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {
                $statement = $conn->prepare("SELECT * FROM event_categories");
                $statement->execute();

                $results = $statement->fetchAll();
            
                $ret = array();
                foreach($results as $cat)
                    $ret[] = new Category($cat['name'], $cat['id']);

                return $ret;
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }
    }

}

?>