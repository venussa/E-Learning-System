<?php

/**
 * edit_courses Class
 *
 * Edit course data
 *
 * @category	models
 * @package		models
 * @uses 		controller/api
 */

class edit_courses extends load{

	// --------------------------------------------------------------------

    /**
     * Constructor Defauult Access
     *
     * @return string
     */

	function __construct(){

		if(userData()["level"] == 0) return false;

		foreach($this->post() as $key => $val){

			if(empty($val)){

				echo "Please complete all data correctly";
				exit;

			}

			$build[$key] = clean_xss_string($val);

		}

		if($this->check_kdmk(clean_xss_string($this->post("kdmk"))) == false){

			echo "Course Code is already exist";
			exit;
		}

		$build["where-kdmk"] = clean_xss_string($this->get("id"));

		if(!empty($build["where-kdmk"]))
			
			API_access("data_update?name=data_course", true,$build);

	}

	// --------------------------------------------------------------------

    /**
     * echeck course code
     *
     * @return boolean
     */

	function check_kdmk($kdmk){

		$old_kdmk = clean_xss_string($this->get("id"));

		if($kdmk !== $old_kdmk){

			$query = API_access("data_select?name=data_course",true,["kdmk" => $kdmk]);

			if($query["total_data"] > 0) return false;

		}

		return true;

	}

}