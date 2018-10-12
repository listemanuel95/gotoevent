<?php

namespace controllers;

use dao\SiteDBDAO as SiteDBDAO;
use model\Site as Site;

class SiteController {

	public function index($city = null, $province = null, $address = null, $establishment = null)
	{
		if($city != null && $province != null && $address != null && $establishment != null) {
			try {

				$sitedao = SiteDBDAO::get_instance();
				$site = new Site($city, $province, $address, $establishment);

				$query = $sitedao->retrieve($site);

				// Si existe lo creamos
				if($query->getID() != null) {
					echo "ajax_error";
				} else {
					echo 'Se creo re piola';
					$sitedao->create($site);
				}

			} catch(\Exception $e) {
				echo '[Controller->Site] ' . $e->getMessage();
			}
		} else {
			header('Location: index');
		}
	}

}

?>
