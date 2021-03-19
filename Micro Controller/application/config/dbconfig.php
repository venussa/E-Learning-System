<?php

namespace application\config;

 /**
 * dbconfig Class
 *
 * Setting about database connection information
 * using PDO driver of database
 *
 * @package		application
 * @subpackage	config
 * @category	database config
 */

class dbconfig{

	// --------------------------------------------------------------------

    /**
     * information
     *
     * Set database information
     *
     * @return void
     */

	public function information(){

		// return json object
		return json_decode(json_encode(array(

			"hostname" => "localhost",
			"username" => "dikertas_lms",
			"password" => "Akunamatata_56!",
			"database" => "dikertas_lms",
			"allow_request" => array("lms.dikertas.com","lms.co.id")

		)));

	}

}