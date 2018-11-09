<?php

namespace controllers;

use model\User as User;
use dao\UserDBDAO as UserDBDAO;

/**
 * Controladora simple para logueos
 */
class LoginController {

    private $userdao;

    /**
     * Constructor para instanciar los DAOs
     */
    public function __construct()
    {
        $this->userdao = UserDBDAO::get_instance();
    }

    /**
     * No muestra vistas, solo loguea al usuario y redirecciona
     */
    public function index($mail, $pass)
    {
        try {
            $user = $this->userdao->retrieve_login($mail, md5($pass));

            if($user != null)
            {
                // guardamos en la sesion al user logueado
                $_SESSION['logged-user'] = $user;

                // redirigimos a la pagina de la q venia, porque el login está en varias páginas
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                header("Location: index?status=error");
            }
        } catch(\Exception $e) {
            echo '[Controller->Login] ' . $e->getMessage();
        }
    }
}

?>