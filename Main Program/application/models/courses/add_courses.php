<?php

/**
 * edit_courses Class
 *
 * Insert new courses
 *
 * @category	models
 * @package		models
 * @uses 		controller/api
 */

class add_courses extends load{

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

		if($this->check_kdmk(clean_xss_string($build['kdmk'])) == false){

			echo "Course Code is already exist";
			exit;
		}

		$build["register_date"] = time();

		API_access("data_insert?name=data_course", true, $build);

	}

	// --------------------------------------------------------------------

    /**
     * echeck course code
     *
     * @return boolean
     */

	function check_kdmk($kdmk){

		$query = API_access("data_select?name=data_course",true,["kdmk" => $kdmk]);

		if($query["total_data"] > 0) return false;

		return true;

	}

}