<?php 
namespace config;

class Autoload
{
	public static function start()
	{
		spl_autoload_register(function($instance) {
			$instance = ucfirst($instance);
			$ruta = ROOT . str_replace("\\", "/", $instance) . ".php";
			include_once($ruta);
		});
	}
}

?>