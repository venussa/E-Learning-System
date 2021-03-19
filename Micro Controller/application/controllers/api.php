<?php

/**
 * api Class
 *
 * Gateway For Application Program interfaces
 *
 * @category	controller
 * @package		controllers
 * @uses 		models/api
 */

	class api extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return string
	     */

		public function __construct(){

			$token = md5(self::information()->username);

			$domain = self::information()->allow_request;

			$user_token = clean_xss_string($this->post("token"));

			$user_domain = clean_xss_string($this->post("domain"));
			
			if(!in_array($user_domain, $domain) or empty($user_domain)) {

				header_content_type("json");

				echo json_encode(array(

					"response" => false,
					"message"  => "Domain not registered"	

				));

				exit;

			}

			if($user_token !== $token){

				header_content_type("json");

				echo json_encode(array(

					"response" => false,
					"message"  => "You don't have an access !!!"	

				));

				exit;

			}

		}

	}

?>
