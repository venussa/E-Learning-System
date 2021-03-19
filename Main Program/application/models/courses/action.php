<?php

/**
 * action Class
 *
 * Delete course
 *
 * @category	models
 * @package		models
 * @uses 		controller/api
 */

	class action extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return string
	     */

		function __construct(){

			if(userData()["level"] == 0) return false;

			if($this->post("type") !== 4){

				foreach($this->post("id") as $key => $val){

					API_access("data_delete?name=data_course",true,["kdmk" => $val]);

				}

			}

		}

	}

?>