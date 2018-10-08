<?php 

	namespace config;

	class Autoload
	{

		/**
		 * 
		 * directory[0] = carpeta
		 * directory[1] = archivo.php
		 * 
		 */
		public static function start()
		{
			spl_autoload_register(function($instance) {

				// Dunkan was here

				$directory = explode('\\', $instance);

				$path = ROOT . strToLower($directory[0]) . '/' . $directory[1] . '.php';
				include_once($path);

			});
		}
	}

?>