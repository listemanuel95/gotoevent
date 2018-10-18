<?php

namespace controllers;

use model\Site as Site;
use dao\SiteDBDAO as SiteDBDAO;

use model\Seat as Seat;
use dao\SeatDBDAO as SeatDBDAO;

use model\SeatType as SeatType;
use dao\SeatTypeDBDAO as SeatTypeDBDAO;

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
    private $plazdao;

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
        $this->plazdao = SeatTypeDBDAO::get_instance();
        $this->plazasdao = SeatDBDAO::get_instance();
    }

    /**
     * Obtenemos de la base de datos los artistas, lugares, categorías y géneros para disparar la vista de creación de eventos
     */
    public function index()
    {
        try {

            $categoriasDB = $this->catdao->retrieve_all();

        } catch (\Exception $e) {
            echo '[Controller->Event] ' . $e->getMessage();
        }

        require(ROOT . '/views/addevent.php');
    }

    /**
     * Método encargado de crear un evento. (En cuanto a vistas lo único que tendría que hacer es mostrar un mensaje de éxito y volver al index)
     */
    public function add($nombre = null, $desc = null, $cat = null)
    {
        if($nombre != null && $desc != null && $cat)
        {
            // aca me llegan todos los datos, puedo cargar el evento en la BD
            try {
                // creamos la categoria correspondiente al evento
                $cat_aux = new Category($cat); 
                $cat_objeto = $this->catdao->retrieve($cat_aux);

                // guardamos el evento
                $evento_a_guardar = new Event($nombre, $desc, $cat_objeto);
                $this->evtdao->create($evento_a_guardar);

                // hago el retrieve para que me de la ID
                $evt = $this->evtdao->retrieve($evento_a_guardar);
                $id_evento = $evt->getID();

                $lugaresDB = $this->sitedao->retrieve_all();
                $artistasDB = $this->artdao->retrieve_all();
                $generosDB = $this->gendao->retrieve_all();
                $plazasDB = $this->plazdao->retrieve_all();

                require(ROOT . '/views/addcalendar.php');

            } catch (\Exception $e) {
                echo '[Controller->Event] ' . $e->getMessage(); // ¿redireccionar?
            }
    
        } else {
            header("Location: ../index");
        }
    }

    public function add_calendar($id_evt = null, $fecha = null, $hora = null, $desc_cal = null, $lugar = null, $plazas_id = null, $plazas = null, $plazas_precio = null, $artistas = null)
    {
        if($id_evt != null && $fecha != null && $hora != null && $desc_cal != null && $lugar != null && $plazas_id != null && $plazas != null && $plazas_precio != null && $artistas != null)
        {
            try {
                // guardamos el calendario
                $cal_evento = $this->evtdao->retrieve_by_id($id_evt);
                $cal_lugar = $this->sitedao->retrieve_by_establishment($lugar); // para que me de la ID

                // guardamos OBJETOS ARTISTA en un arreglo para el constructor de Calendar
                $array_artistas = array();
                foreach($artistas as $art)
                    $array_artistas[] = $this->artdao->retrieve_by_name($art);

                $calendario_objeto = new Calendar($desc_cal, $fecha, $hora, $cal_lugar, $cal_evento, $array_artistas);
                $last_id = $this->caldao->create($calendario_objeto); // el create de calendarios devuelve la ultima ID

                // una vez cargado el calendario cargamos las plazas con el ID de ese calendario
                
                for($j = 0; $j < count($plazas_id); $j++)
                {
                    for($i = 0; $i < (int) $plazas[$j]; $i++)
                    {
                        $number = $plazas_id[$j] . '-' . $i;
                        $precio = $plazas_precio[$j];
                        $type = $this->plazdao->retrieve_by_id($plazas_id[$j]);
                        $calendar = new Calendar($desc_cal, $fecha, $hora, $cal_lugar, $cal_evento, $array_artistas, $last_id);
        
                        $plaza = new Seat($number, $precio, $type, $calendar);

                        $this->plazasdao->create($plaza);
                    }
                }

            } catch (\Exception $e) {
                echo '[Controller->Event] ' . $e->getMessage();
            }
        } else {
            header("Location: ../index");
        }
    }
}

?>