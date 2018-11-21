<?php

namespace controllers;

use model\User as User;
use model\UserRole as UserRole;

use dao\UserDBDAO as UserDBDAO;
use dao\UserRoleDBDAO as UserRoleDBDAO;

/**
 * Controladora de la página de registro
 */
class RegisterController {

	private $userdao;
	private $roledao;

    /**
     * Constructor para instanciar los DAOs
     */
    public function __construct()
    {
    	$this->userdao = UserDBDAO::get_instance();
    	$this->roledao = UserRoleDBDAO::get_instance();

    	// si ya esta logueado lo pateamos
    	if(isset($_SESSION['logged-user']))
            header("Location: index");
            
        // si me llegó el "fblogin" por $_GET, logeo el usuario
        if(isset($_GET['fblogin']))
        {
            if(!isset($_SESSION['logged-user']))
            {
                $mail = $_GET['fblogin'];
                $_SESSION['logged-user'] = new User($mail, '', $this->roledao->retrieve_role('Usuario')); // siempre que se loguea x FB el rol es "1" (usuario normal)
                header("Location: index");
            }
        }
    }

    /**
     *  Página de inicio
     */
    public function index()
    {
        require(ROOT . '/views/register.php');
    }

    /**
     *	Registro de usuarios
     */
    public function user_register($mail, $pass)
    {
    	// chequeamos que no haya un usuario registrado con ese mail
    	if(!$this->userdao->retrieve_by_mail_boolean($mail))
    	{
    		// lo registramos como usuario (acá el "Usuario" tiene que coincidir con el nombre del rol en la BD `user_roles`, ojo con eso !!)
    		$rol = $this->roledao->retrieve_role('Usuario');
    		$user = new User($mail, md5($pass), $rol);

    		$id = $this->userdao->create($user);

            // guardamos en sesion el user ya logueado
            $user->setID($id);
    		$_SESSION['logged-user'] = $user;

    		header("Location: ../index");
    	}
    }
}

?>