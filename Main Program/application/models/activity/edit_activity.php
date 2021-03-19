<?php

/**
 * add_section Class
 *
 * Depend the name
 *
 * @category	models
 * @package		models
 * @uses 		controller/activity
 */

	class edit_activity extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return string
	     */

		function __construct(){

			if(userData()["user_type"] == "student") return false;

			foreach ($this->post() as $key => $value) {

				if($key == "class") $value = $value[0].$this->post("major",["'",";"]).$value[1];

				elseif($key == "start_date") $value = strtotime($value." 00:00:02");

				elseif($key == "end_date") $value = strtotime($value." 23:59:59");
				
				elseif($key == "description") $value = str_replace("'",null,$value);

				else $value = clean_xss_string($value);

				$build[$key] = $value;

				if((strval($value)) == ""){

					echo "Please complete all data correctly";
					exit;

				}

			}

			$build["register_date"] = time();

			$build["teacher_id"] = userData()['nidn'];

			$build["where-id"] = clean_xss_string($this->get("id"));

			API_access("data_update?name=data_activity",true,$build);

		}

	}