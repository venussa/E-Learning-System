<?php

/**
 * add_majors Class
 *
 * updating the latest data about 
 * the majors on university data
 *
 * @category	models
 * @package		models
 * @uses 		controller/faculty
 */
	
	class add_majors extends load{

		/**
	    * Initial data faculty
	    *
	    * @var  string
	    */
		var $id_majors;

		// --------------------------------------------------------------------

	    /**
	     * Constructor
	     *
	     * @return void
	     */

		function __construct(){

			if(userData()["level"] == 0) return false;

			$this->id_majors = clean_xss_string($this->post("idm"));

			foreach ($this->post() as $key => $value) {
				
				$value = trim(strip_tags(str_replace(["'",";"],null, $value)));

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

			API_access("data_insert?name=data_major",true,$build);

		}

		// --------------------------------------------------------------------

	    /**
	     * Check if faculty id is available
	     *
	     * @return boolean
	     */

		function check_id(){

			$query1 = API_access("list_faculty?q=".$this->id_majors);

			$query2 = API_access("list_majors?q=".$this->id_majors);

			$response = true;

			if($query1->response == true) $response = false;

			if($query2->response == true) $response = false;

			return $response;

		}

	}