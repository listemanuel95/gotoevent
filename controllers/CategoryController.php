<?php

namespace controllers;

use model\Category as Category;

use dao\CategoryDBDAO as CategoryDBDAO;

class CategoryController {

    /* esta controladora solo se usa para cargar nuevas categorias (no dispara vistas)
     entonces usamos el index directamente para eso */
    public function index($name = null)
    {
        if($name != null)
        {
            try {
                $categorydao = CategoryDBDAO::get_instance();

                // Si ya existe no agregamos un pingo
                $query = $categorydao->retrieve(new Category($name));

                if($query->getID() != null) 
                {
                    echo "ajax_error";
                } else {
                    $query = $categorydao->create(new Category($name));
                }
               
            } catch (Exception $e) {
                echo '[Controller->Category] ' . $e->getMessage();
            }
            
        } else {
            header("Location: index");
        }
    }

}

?>