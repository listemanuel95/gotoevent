<?php

namespace controllers;

use model\Site as Site;
use dao\SiteDBDAO as SiteDBDAO;

use model\Category as Category;
use dao\CategoryDBDAO as CategoryDBDAO;

use model\Artist as Artist;
use dao\ArtistDBDAO as ArtistDBDAO;

use model\Event as Event;
use dao\EventDBDAO as EventDBDAO;

use model\Calendar as Calendar;
use dao\CalendarDBDAO as CalendarDBDAO;

use model\Genre as Genre;
use dao\GenreDBDAO as GenreDBDAO;

/**
 * Controladora para la creación de eventos. Los eventos se crean en una sola vista, agregándoseles artista, calendario, lugar, fecha y hora.
 * La creación de nuevos artistas, lugares, categorías, etc. se hace en la misma vista (addevent.php) vía peticiones AJAX a los métodos
 * ajax_insert() de las controladoras correspondientes. Se puede ver ésto en los action de los métodos de los Modales para cada caso.
 */
class EventController {

    private $sitedao;
    private $catdao;
    private $artdao;
    private $gendao;
    private $evtdao;
    private $caldao;

    /**
     * Obtenemos las instancias de los DAOs en el constructor y después las usamos como atributos
     */
    public function __construct()
    {
        $this->sitedao = SiteDBDAO::get_instance();
        $this->catdao = CategoryDBDAO::get_instance();
        $this->gendao = GenreDBDAO::get_instance();
        $this->artdao = ArtistDBDAO::get_instance();
        $this->evtdao = EventDBDAO::get_instance();
        $this->caldao = CalendarDBDAO::get_instance();
    }

    /**
     * Obtenemos de la base de datos los artistas, lugares, categorías y géneros para disparar la vista de creación de eventos
     */
    public function index()
    {
        try {
            $lugaresDB = $this->sitedao->retrieve_all();
            $categoriasDB = $this->catdao->retrieve_all();
            $artistasDB = $this->artdao->retrieve_all();
            $generosDB = $this->gendao->retrieve_all();

        } catch (\Exception $e) {
            echo '[Controller->Event] ' . $e->getMessage();
        }

        require(ROOT . '/views/addevent.php');
    }

    /**
     * Método encargado de crear un evento. (En cuanto a vistas lo único que tendría que hacer es mostrar un mensaje de éxito y volver al index)
     */
    public function add($nombre = null, $desc = null, $cat = null, $fecha = null, $hora = null, $desc_cal = null, $lugar = null, $artistas = null)
    {
        if($nombre != null && $desc != null && $cat != null && $fecha != null && $hora != null && $desc_cal != null
            && $lugar != null && $artistas != null)
        {
            // aca me llegan todos los datos, puedo cargar el evento en la BD
            try {
                // creamos la categoria correspondiente al evento
                $cat_aux = new Category($cat); 
                $cat_objeto = $this->catdao->retrieve($cat_aux);

                $evento_a_guardar = new Event($nombre, $desc, $cat_objeto);
                $this->evtdao->create($evento_a_guardar);

                // ahora hay que guardar el calendario (TODO: VARIOS CALENDARIOS, NO SE COMO LO VAMOS A HACER JEJE XD)
                $cal_evento = $this->evtdao->retrieve($evento_a_guardar); // para que me de la ID
                $cal_lugar = $this->sitedao->retrieve_by_establishment($lugar); // para que me de la ID
                
                // guardamos OBJETOS ARTISTA en un arreglo para el constructor de Calendar
                $array_artistas = array();
                foreach($artistas as $art)
                    $array_artistas[] = $this->artdao->retrieve_by_name($art);

                $calendario_objeto = new Calendar($desc, $fecha, $hora, $cal_lugar, $cal_evento, $array_artistas);
                $this->caldao->create($calendario_objeto);

            } catch (\Exception $e) {
                echo '[Controller->Event] ' . $e->getMessage(); // ¿redireccionar?
            }
    
        } else {
            header("Location: ../index");
        }
    }

}

?>