<?php

namespace controllers;

use dao\SeatDBDAO as SeatDBDAO;
use dao\SeatTypeDBDAO as SeatTypeDBDAO;
use dao\CalendarDBDAO as CalendarDBDAO;
use dao\EventDBDAO as EventDBDAO;
use dao\InvoiceDBDAO as InvoiceDBDAO;
use dao\TicketDBDAO as TicketDBDAO;

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
use model\Ticket as Ticket;
use model\Invoice as Invoice;

/**
 * Controladora para el carrito
 */
class CartController {

    private $seatdao;
    private $stypedao;
    private $caldao;
    private $evtdao;
    private $invdao;
    private $ticdao;

    /**
     * Constructor para instanciar los DAOs
     */
    public function __construct()
    {
        $this->seatdao = SeatDBDAO::get_instance();
        $this->stypedao = SeatTypeDBDAO::get_instance();
        $this->caldao = CalendarDBDAO::get_instance();
        $this->evtdao = EventDBDAO::get_instance();
        $this->invdao = InvoiceDBDAO::get_instance();
        $this->ticdao = TicketDBDAO::get_instance();
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
                // si apretó en borrar, hay que sacar ese elemento del array de la sesión
                if(isset($_GET['delete']) && isset($_SESSION['gte-cart']))
                {
                    $_SESSION['gte-cart']->remove_line($_GET['delete']);

                    if(count($_SESSION['gte-cart']->get_purchase_lines()) == 0)
                        unset($_SESSION['gte-cart']);
                }    

                require(ROOT . '/views/view_cart.php');
                     
            } else {
                header("Location: index");
            }

        } catch (\Exception $e) {
            echo '[Controller->Cart] ' . $e->getMessage();
        }
    }

    /**
     * Confirma la compra, genera los tickets necesarios
     */
    public function confirm_purchase()
    {
        try {
            if(isset($_SESSION['gte-cart']) && isset($_SESSION['logged-user']))
            {
                // declaro las variables que voy a usar para el QR
                $chs = '200x200';
                $cht = 'qr';
                $choe = 'UTF-8';

                // chequeo que los seats reservados sigan estando disponibles
                $purchase = $_SESSION['gte-cart'];
                $lines = $purchase->get_purchase_lines();
                
                foreach($lines as $pl)
                {
                    $seats = $pl->get_seats();
                    foreach($seats as $s)
                    {
                        $available = true;
                        // chequeo que siga con availability 0, sino, se lo compó otro
                        $new_s = $this->seatdao->retrieve_without_calendar($s);

                        if(!($new_s instanceof Seat) || $new_s->get_availability() != 0)
                        {
                            // no existe mas, volvemos a la vista anterior y avisamos al usuario
                            header("Location: ../cart?error=1&text=La entrada " . $s->get_calendar()->get_event()->get_name() . "(" . $s->get_calendar()->get_desc() . ") - " . $s->get_type()->get_type() . " ya no está disponible. :(");
                            $available = false;
                        }
                    }

                    if($available)
                    {
                        // todos los seats estaban disponibles, confirmo la venta, les cambio la availability a 1 y creo los tickets y la factura
                        $invoice = new Invoice($_SESSION['logged-user']); // creamos la factura
                        $tickets = array(); // arreglo de tickets para la factura

                        // metemos la factura a la base de datos
                        $inv_id = $this->invdao->create($invoice);
                        $invoice->setID($inv_id);

                        foreach($seats as $s)
                        {
                            // cambiamos la disponibilidad del seat
                            $s->change_availability(); // como la availability era 0, ahora es 1
                            $this->seatdao->update_availability($s); // actualizamos en la DB

                            // generamos el QR del ticket
                            $qr_code = $this->generate_qr_code($s);

                            // creamos los tickets
                            $thicc = new Ticket($s, $invoice, $qr_code);
                            $tickets[] = $thicc;

                            // metemos el ticket a la base de datos
                            $this->ticdao->create($thicc);

                            // como se confirmó la compra, borramos la sesión del carrito
                            unset($_SESSION['gte-cart']);
                            require(ROOT . '/views/confirm_purchase.php');
                        }
                    }
                }

            } else {
                header("Location: ../index");
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
                            $seats[] = new Seat($p->get_number(), $p->get_price(), $p->get_type(), $calendar, 0, $p->getID());

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

    /**
     * FUNCIONES AUXILIARES
     */

    /**
     * Genera el código QR para un ticket (en base al asiento que le corresponde).
     * La data de los códigos QRs es la siguiente: seat.ID-seat.number 
     */
    private function generate_qr_code(Seat $seat)
    {
        if($seat->getID() != null && $seat->get_number() != null)
            return $seat->getID() . '-' . $seat->get_number();

        return "qrinvalido";
    }
}

?>