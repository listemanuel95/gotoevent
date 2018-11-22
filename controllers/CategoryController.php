<?php

namespace controllers;

use model\Category as Category;
use dao\CategoryDBDAO as CategoryDBDAO;

/**
 * Controladora usada solamente para insertar categorías vía peticiones AJAX, por eso no tiene método index() (no dispara vistas)
 */
class CategoryController {

    /**
	 * Inserta una categoría a la base de datos vía una petición POST de AJAX (jQuery)
	 */
    public function ajax_insert($name = null)
    {
        if($name != null)
        {
            try {
                $categorydao = CategoryDBDAO::get_instance();

                // si ya existe no la agregamos
                $query = $categorydao->retrieve(new Category($name));

                if($query->getID() != null) 
                    echo "ajax_error"; // los errores de AJAX los comparamos con esta string (no usamos la función error())
                else
                    $query = $categorydao->create(new Category($name));
               
            } catch (Exception $e) {
                echo '[Controller->Category] ' . $e->getMessage();
            }
        }
    }

}

?>