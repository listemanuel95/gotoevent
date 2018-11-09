<?php

namespace controllers;

use dao\TicketDBDAO as TicketDBDAO;
use model\Ticket as Ticket;

/**
 * Controladora para la muestra de tickets
 */
class TicketsController {

    private $ticdao;

    /**
     * Constructor para inicializar los DAOs
     */
    public function __construct()
    {
        $this->ticdao = TicketDBDAO::get_instance();
    }

    /**
     * Muestra los tickets de un usuario
     */
	public function index()
	{
		try {

            if(isset($_SESSION['logged-user']))
            {
                // declaro las variables que voy a usar para el QR
                $chs = '200x200';
                $cht = 'qr';
                $choe = 'UTF-8';

                $tickets = $this->ticdao->retrieve_by_user($_SESSION['logged-user']);

                // separamos en tickets de eventos que ya pasaron y de eventos que están por venir
                $active_tickets = array();
                $old_tickets = array();

                foreach($tickets as $thicc)
                {
                    $fecha = strtotime($thicc->get_seat()->get_calendar()->get_date());

                    // chequeamos si la fecha no pasó
                    if((time()-(60*60*24)) < $fecha)
                        $active_tickets[] = $thicc;
                    else 
                        $old_tickets[] = $thicc;
                }

                require(ROOT . '/views/tickets.php');
            } else
                header("Location: index");
            
        } catch(\Exception $e) {
            echo '[Controller->Site] ' . $e->getMessage();
        }
	}

}

?>
