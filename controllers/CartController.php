<?php

namespace controllers;

use dao\SeatDBDAO as SeatDBDAO;
use dao\SeatTypeDBDAO as SeatTypeDBDAO;
use dao\CalendarDBDAO as CalendarDBDAO;
use dao\EventDBDAO as EventDBDAO;

use model\SeatType as SeatType;
use model\Seat as Seat;
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
     * Muestra la vista del carrito
     */
    public function index()
    {
        try {

            // si no esta logueado hay que patearlo
            if(isset($_SESSION['logged-user']))
            {
                require(ROOT . '/views/view_cart.php');     
            } else {
                header("Location: index");
            }

        } catch (\Exception $e) {
            echo '[Controller->Cart] ' . $e->getMessage();
        }
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
                $seats = array();

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

                            // agregamos al arreglo de plazas que va a ir a la linea de compra
                            $seats[] = new Seat($p->get_number(), $p->get_price(), $p->get_type(), $calendar, 0);

                            if($cant_plazas == $cant)
                                break;
                        }    
                    }

                    if($cant_plazas == $cant)
                    {
                        // creamos la linea de compra y guardamos en sesion

                        // primero vemos si existe la sesion, sino la creamos e instanciamos la compra
                        if(!isset($_SESSION['gte-cart']) && isset($_SESSION['logged-user']))
                        {
                            // en el carrito guardamos directamente la compra
                            $_SESSION['gte-cart'] = new Purchase(date('Y-m-d'), array(), $_SESSION['logged-user']);
                            echo 'ACA ENTRE???';
                        }

                        // creamos la linea de compra y la agregamos al carrito
                        $cart = $_SESSION['gte-cart'];
                        $cart->add_purchase_line(new PurchaseLine($seats));

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