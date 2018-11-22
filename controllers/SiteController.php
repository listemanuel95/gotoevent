<?php

namespace controllers;

use dao\SiteDBDAO as SiteDBDAO;
use model\Site as Site;

/**
 * Controladora usada solamente para insertar lugares vía peticiones AJAX, por eso no tiene método index() (no dispara vistas)
 */
class SiteController {

	/**
	 * Inserta un lugar a la base de datos vía una petición POST de AJAX (jQuery)
	 */
	public function ajax_insert($city = null, $province = null, $address = null, $establishment = null, $capacity = null)
	{
		if($city != null && $province != null && $address != null && $establishment != null && $capacity != null) {
			try {

				$sitedao = SiteDBDAO::get_instance();
				$site = new Site($city, $province, $address, $establishment, $capacity);
				
				$query = $sitedao->retrieve($site);

				// si existe lo creamos
				if($query->getID() != null)
					echo "ajax_error"; // los errores de ajax los comparamos con esta string (no usamos la función error())
				else
					$sitedao->create($site);
				
			} catch(\Exception $e) {
				echo '[Controller->Site] ' . $e->getMessage();
			}
		}
	}

}

?>
