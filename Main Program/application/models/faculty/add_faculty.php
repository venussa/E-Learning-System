<?php

/**
 * add_faculty Class
 *
 * updating the latest data about 
 * the faculty on university data
 *
 * @category	models
 * @package		models
 * @uses 		controller/faculty
 */

	class add_faculty extends load{

		/**
	    * Initial data faculty
	    *
	    * @var  string
	    */
		var $id_faculty;

		// --------------------------------------------------------------------

	    /**
	     * Constructor
	     *
	     * @return void
	     */

		function __construct(){

			if(userData()["level"] == 0) return false;

			$this->id_faculty = clean_xss_string($this->post("idf"));

			foreach ($this->post() as $key => $value) {
				
				$value = clean_xss_string($value);

				$build[$key] = $value;

				if(empty($value)){

					echo "Please complete all data correctly";
					exit;

				}

			}

			$build["register_date"] = time();

			if($this->check_id() == false){
				echo "id already used";
				exit;
			}

			API_access("data_insert?name=data_faculty",true,$build);

		}

		// --------------------------------------------------------------------

	    /**
	     * Check if faculty id is available
	     *
	     * @return boolean
	     */

		function check_id(){

			$query1 = API_access("list_faculty?q=".$this->id_faculty);

			$query2 = API_access("list_majors?q=".$this->id_faculty);

			$response = true;

			if($query1->response == true) $response = false;

			if($query2->response == true) $response = false;

			return $response;

		}

	}