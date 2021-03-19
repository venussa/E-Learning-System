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

	class add_section extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return string
	     */

		function __construct(){

			if(userData()["user_type"] == "student") return false;

			foreach ($this->post() as $key => $value) {
				
				if($key == "description") $value = str_replace("'",null,$value);

				elseif($key == "attach_file"){

					$value = str_split($value);
					unset($value[0]);
					$value = implode(null, $value);
				}

				else $value = clean_xss_string($value);

				$build[$key] = $value;

				if(($key !== "attach_file") and (strval($value)) == ""){

					echo "Please complete all data correctly";
					exit;

				}

			}

			$build["register_date"] = time();

			$build['activity_id'] = clean_xss_string($this->get("id"));

			API_access("data_insert?name=data_topic", true, $build);

		}

	}