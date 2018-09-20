<?php

require_once "config/constantes.php";
require_once "config/autoload.php";

require_once "config/request.php";
require_once "config/router.php";

use config\Autoload as Autoload;
use config\Router 	as Router;
use config\Request 	as Request;

Autoload::start();
//session_start();
Router::direccionar(new Request());

?>