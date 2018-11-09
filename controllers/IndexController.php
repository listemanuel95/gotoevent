<?php

namespace controllers;

use model\Event as Event;
use dao\EventDBDAO as EventDBDAO;

use model\Category as Category;
use dao\CategoryDBDAO as CategoryDBDAO;

use model\Genre as Genre;
use dao\GenreDBDAO as GenreDBDAO;

/**
 * Controladora de la página de inicio
 */
class IndexController {

    private $evtdao;
    private $catdao;
    private $gendao;

    /**
     * Constructor para obtener los DAOs
     */
    public function __construct()
    {
        $this->evtdao = EventDBDAO::get_instance();
        $this->catdao = CategoryDBDAO::get_instance();
        $this->gendao = GenreDBDAO::get_instance();
    }

    /**
     *  Página de inicio (atributos auxiliares para parámetros de búsqueda, recibidos por POST)
     */
    public function index($gen = null, $cat = null)
    {
        try {
            $eventosDB = array();
            $categoriasDB = $this->catdao->retrieve_all();
            $generosDB = $this->gendao->retrieve_all();
            $destacados = $this->evtdao->retrieve_last();

            if($gen != null && $gen != 'genero')
            {
                if($cat != null && $cat != 'categoria')
                {
                    // filtro x genero y categoria
                    $eventosDB = $this->evtdao->retrieve_by_genre_and_category($gen, $cat);
                } else {
                    // filtro x genero unicamente
                    $eventosDB = $this->evtdao->retrieve_by_genre($gen);
                }
            } else {
                if($cat != null && $cat != 'categoria')
                {
                    // filtro x categoria unicamente
                    $eventosDB = $this->evtdao->retrieve_by_category($cat);
                } else {
                    // sin filtro
                    $eventosDB = $this->evtdao->retrieve_all();
                }
            }

        } catch(\Exception $e) {
            echo '[Controller->Index] ' . $e->getMessage();
        }

        require(ROOT . '/views/index.php');
    }
}

?>