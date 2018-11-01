<?php

namespace controllers;

use dao\SeatDBDAO as SeatDBDAO;
use dao\SeatTypeDBDAO as SeatTypeDBDAO;
use dao\CalendarDBDAO as CalendarDBDAO;
use dao\EventDBDAO as EventDBDAO;

use model\SeatType as SeatType;
use model\Purchase as Purchase;
use model\PurchaseLine as PurchaseLine;
use model\User as User;
use model\Calendar as Calendar;
use model\Event as Event;
use model\Artist as Artist;
use model\Genre as Genre;
use model\Site as Site;

/**
 * Controladora para el carrito
 */
class CartController {

    private $seatdao;
    private $stypedao;
    private $caldao;
    private $evtdao;

    /**
     * Constructor para instanciar los DAOs
     */
    public function __construct()
    {
        $this->seatdao = SeatDBDAO::get_instance();
        $this->stypedao = SeatTypeDBDAO::get_instance();
        $this->caldao = CalendarDBDAO::get_instance();
        $this->evtdao = EventDBDAO::get_instance();
    }

    /**
	 * Crea una línea de compra y la agrega al carrito (en sesión) vía AJAX (jQuery)
     * Si no hay compra en sesión, también tiene que crear la compra, para lo cual
     * necesita datos del usuario (que si llegó hasta acá, está logueado, entonces
     * está en sesión).
	 */
    public function ajax_add_purchase_line($evt = null, $cal = null, $type = null, $cant = null) 
    {
        if($evt != null && $cal != null && $type != null && $cant != null)
        {
            try {
                // como el seat_type lo tenemos por nombre, vamos al dao para agarrar la ID
                $stype = $this->stypedao->retrieve_by_name($type);
                $event = $this->evtdao->retrieve_by_id($evt);
                $calendars = $this->caldao->retrieve_by_event($event); 
                $calendar = null;

                // agarramos el calendario q nos sirve
                foreach($calendars as $c)
                {
                    if($c->getID() == $cal)
                    {
                        $calendar = $c;
                        break;
                    }
                }

                if($calendar != null)
                {
                    // chequeamos que haya disponibilidad para los asientos solicitados
                    $plazas = $this->caldao->retrieve_plazas($calendar);
                    $cant_plazas = 0;

                    foreach($plazas as $p)
                    {
                        if($p->get_type()->getID() == $stype->getID() && $p->get_availability() == 0)
                        {
                            $cant_plazas++;

                            if($cant_plazas == $cant)
                                break;
                        }    
                    }

                    if($cant_plazas == $cant)
                    {
                        echo 'hay plazas';
                    } else {
                        echo 'ajax_error';
                    }
                } else {
                    echo 'ajax_error';
                }

            } catch (\Exception $e) {
                echo 'ajax_error';
            }

        } else {
            echo 'ajax_error';
        }
    }

}

?>