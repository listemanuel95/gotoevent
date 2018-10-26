<?php

namespace controllers;

use dao\EventDBDAO as EventDBDAO;
use dao\SiteDBDAO as SiteDBDAO;
use dao\ArtistDBDAO as ArtistDBDAO;
use dao\GenreDBDAO as GenreDBDAO;
use dao\SeatTypeDBDAO as SeatTypeDBDAO;

/**
 * Controladora del panel de administración
 */
class AdminPanelController {

    private $evtdao;

    /**
     * Constructor para instanciar los DAOs
     */
    public function __construct()
    {
        $this->evtdao = EventDBDAO::get_instance();
        $this->sitedao = SiteDBDAO::get_instance();
        $this->artdao = ArtistDBDAO::get_instance();
        $this->gendao = GenreDBDAO::get_instance();
        $this->plazdao = SeatTypeDBDAO::get_instance();
    }

    /**
     *  Página de inicio
     */
    public function index()
    {
        // si no es admin hay que patearlo
        if(isset($_SESSION['logged-user']))
        {
            $rol = $_SESSION['logged-user']->get_role()->get_name();

            if($rol == 'Admin')
            {
                $eventos = $this->evtdao->retrieve_all();
                require(ROOT . '/views/admin_panel.php');        
            } else {
                header("Location: index");
            }
        } else {
            header("Location: index");
        }
    }

    public function add_calendar($id)
    {
        // variables necesarias para la vista
        try {
            $lugaresDB = $this->sitedao->retrieve_all();
            $artistasDB = $this->artdao->retrieve_all();
            $generosDB = $this->gendao->retrieve_all();
            $plazasDB = $this->plazdao->retrieve_all();
            $id_evento = $id;

            // mostramos la vista
            require(ROOT . '/views/admin_add_calendar.php');
        } catch(\Exception $e) {
            echo '[Controller->AdminPanel] ' . $e->getMessage();
        }
        
    }

    public function delete_event($id)
    {
        // borramos el evento
        $this->evtdao->delete_by_id($id);

        header("Location: ../../adminpanel");
    }
}

?>