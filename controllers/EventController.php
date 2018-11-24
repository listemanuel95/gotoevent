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

use model\User as User;

use model\UserRole as UserRole;
use dao\UserRoleDBDAO as UserRoleDBDAO;

/**
 * Controladora para la creación de eventos. Los eventos se crean en una sola vista, agregándoseles artista, calendario, lugar, fecha y hora.
 * La creación de nuevos artistas, lugares, categorías, etc. se hace en la misma vista (addevent.php) vía peticiones AJAX a los métodos
 * ajax_insert() de las controladoras correspondientes. Se puede ver ésto en los "action" de los formularios de los Modales para cada caso.
 */
class EventController {

    private $sitedao;
    private $catdao;
    private $artdao;
    private $gendao;
    private $evtdao;
    private $caldao;
    private $plazdao;
    private $roldao;

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
     * Obtenemos de la base de datos los artistas, lugares, categorías y géneros para disparar la vista de creación de eventos
     */
    public function index()
    {
        try {

            // si no es admin hay que patearlo
            if(isset($_SESSION['logged-user']))
            {
                $rol = $_SESSION['logged-user']->get_role()->get_name();

                if($rol == 'Admin')
                {
                    $categoriasDB = $this->catdao->retrieve_all();
                    require(ROOT . '/views/addevent.php');     
                } else {
                    header("Location: index");
                }
            } else {
                header("Location: index");
            }

        } catch (\Exception $e) {
            echo '[Controller->Event] ' . $e->getMessage();
        }
    }

    /**
     * Método encargado de crear un evento.
     */
    public function add($nombre = null, $desc = null, $cat = null)
    {
        if($nombre != null && $desc != null && $cat != null)
        {
            // aca me llegan todos los datos, puedo cargar el evento en la BD
            try {
                // creamos la categoria correspondiente al evento
                $cat_aux = new Category($cat); 
                $cat_objeto = $this->catdao->retrieve($cat_aux);

                if (!empty($_FILES['file']['name'])) {
                    $file = $_FILES['file'];            
                } else {
                    $file = null;
                }

                var_dump($file);

                $path = $this->uploadfile($file, 'images');

                // guardamos el evento
                $evento_a_guardar = new Event($nombre, $desc, $cat_objeto, $path);
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

    /**
     * Agrega un calendario al evento (siempre, por defecto, al crear un evento obligamos a crear al menos un calendario para ese evento).
     */
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
        
                        $plaza = new Seat($number, $precio, $type, $calendar, 0);

                        $this->plazasdao->create($plaza);
                    }
                }

                // volvemos al panel de admin
                header("Location: ../adminPanel");

            } catch (\Exception $e) {
                echo '[Controller->Event] ' . $e->getMessage();
            }
        } else {
            header("Location: ../index");
        }
    }

    /**
     * Método para actualizar eventos (no los calendarios, solamente los datos básicos del evento)
     */
    public function update($id = null, $nombre = null, $desc = null, $img = null, $cat = null)
    {
        if($id != null && $nombre != null && $desc != null && $img != null && $cat != null)
        {

            try {

                $cat_con_id = $this->catdao->retrieve(new Category($cat));
                $evt = new Event($nombre, $desc, $cat_con_id, $img, $id);

                $this->evtdao->update($evt);
                header("Location: ../adminPanel");
            } catch (\Exception $e) {
                echo '[Controller->Event] ' . $e->getMessage();
            }
        }
    }

    /**
     * Dispara la vista con los detalles de un evento
     */
    public function details($event_id) 
    {
        // variable par ano usar sesiones en las vistas
        $logged_user = isset($_SESSION['logged-user']) ? $_SESSION['logged-user'] : null;
        $gte_cart = isset($_SESSION['gte-cart']) ? $_SESSION['gte-cart'] : null;
        
        $event = $this->evtdao->retrieve_by_id($event_id);
        $calendars = $this->caldao->retrieve_by_event($event);
        $plaza_types = $this->plazdao->retrieve_all();
        $precios_plazas = array();

        // cargo los precios de las plazas
        foreach($calendars as $cal)
        {
            $id = $cal->getID();
            $plazas = $this->caldao->retrieve_plazas($cal);

            $i = 0;
            foreach($plazas as $p)
            {
                $i++;
                $precios_plazas[$id][$i]['type'] = $p->get_type();
                $precios_plazas[$id][$i]['price'] = $p->get_price();
            }
        }

        if($event instanceof Event)
            require(ROOT . '/views/view_event.php');
        else
            header("Location: ../index");
    }

    /**
     * Dispara la vista de los eventos que corresponden a un artista determinado
     */
    public function events_by_artist($id)
    {
        // variable par ano usar sesiones en las vistas
        $logged_user = isset($_SESSION['logged-user']) ? $_SESSION['logged-user'] : null;
        $gte_cart = isset($_SESSION['gte-cart']) ? $_SESSION['gte-cart'] : null;

        $events = $this->caldao->retrieve_events_by_artist_id($id);
        $artista = $this->artdao->retrieve_by_id($id);

        require(ROOT . '/views/events_by_artist.php');
    }

    private function uploadfile($file, $folder) {

        $path = null;
        $folders_Array = array("images", "documents");
 
        if (is_array($file) && !empty($file)) {
 
            if (in_array($folder, $folders_Array)) {
                $folderPath = ROOT . 'assets/' . $folder . '/';
 
                if (!file_exists($folderPath)) {
                    mkdir($folderPath);
                }
 
                if ($file['name']) {
                    $fileTypes_Array = array('png', 'jpg', 'pdf', 'gif');
                    $fileSize = 5000000;
                    $fileName = $file['name'];
 
                    $filePath = $folderPath . $fileName;
 
                    $fileType = pathinfo($filePath, PATHINFO_EXTENSION);
 
                    if (in_array($fileType, $fileTypes_Array)) {
 
                        if ($file['size'] < $fileSize) {
 
                            if (move_uploaded_file($file["tmp_name"], $filePath)) {
                                $path = ROOT . 'assets/' . $folder . '/' . $fileName;
 
                            } else throw new \Exception("Error al mover el archivo.");
                        } else throw new \Exception("Error, excede el peso admitido.");
                    } else throw new \Exception("Error, no se admite este formato.");
                } else throw new \Exception("Error, nombre invalido.");
            } else throw new \Exception("Error, la carpeta destino no es correcta.");
        } else throw new \Exception("Error, la variable no es un archivo.");
 
        return $path;

    }

}

?>