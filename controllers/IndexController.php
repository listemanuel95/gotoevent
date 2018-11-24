<?php

namespace controllers;

use model\Event as Event;
use dao\EventDBDAO as EventDBDAO;

use model\Category as Category;
use dao\CategoryDBDAO as CategoryDBDAO;

use model\Genre as Genre;
use dao\GenreDBDAO as GenreDBDAO;

use model\User as User;

use model\UserRole as UserRole;
use dao\UserRoleDBDAO as UserRoleDBDAO;

/**
 * Controladora de la página de inicio
 */
class IndexController {

    private $evtdao;
    private $catdao;
    private $gendao;
    private $roldao;

    /**
     * Constructor para obtener los DAOs
     */
    public function __construct()
    {
        $this->evtdao = EventDBDAO::get_instance();
        $this->catdao = CategoryDBDAO::get_instance();
        $this->gendao = GenreDBDAO::get_instance();
        $this->roldao = UserRoleDBDAO::get_instance();

        // si me llegó el "fblogin" por $_GET, logeo el usuario
        if(isset($_GET['fblogin']))
        {
            if(!isset($_SESSION['logged-user']))
            {
                $mail = $_GET['fblogin'];
                $_SESSION['logged-user'] = new User($mail, '', $this->roldao->retrieve_role('Usuario')); // siempre que se loguea x FB el rol es "1" (usuario normal)
            }
        }
    }

    /**
     *  Página de inicio (atributos auxiliares para parámetros de búsqueda, recibidos por POST)
     */
    public function index($gen = null, $cat = null)
    {
        // variable par ano usar sesiones en las vistas
        $logged_user = isset($_SESSION['logged-user']) ? $_SESSION['logged-user'] : null;
        $gte_cart = isset($_SESSION['gte-cart']) ? $_SESSION['gte-cart'] : null;
        
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