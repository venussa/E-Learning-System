<?php

/**
 * ad_activity Class
 *
 * Add new activity
 *
 * @category	models
 * @package		models
 * @uses 		controller/activity
 */

	class add_activity extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return mixed
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

				if(empty($value)){

					echo "Please complete all data correctly";
					exit;

				}

			}
			
			if($build["end_date"] <= $build["start_date"] or $build["end_date"] < time()){
			 
			    echo "Incorrect quiz time settings";
			    exit;
			    
			}

			$build["register_date"] = time();

			$build['teacher_id'] = userData()['nidn'];

			API_access("data_insert?name=data_activity",true, $build);

		}

	}