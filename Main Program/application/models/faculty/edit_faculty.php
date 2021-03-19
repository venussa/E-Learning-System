<?php

/**
 * edit_faculty Class
 *
 * updating the latest data about 
 * the majors on university data
 *
 * @category	models
 * @package		models
 * @uses 		controller/faculty
 */
	
	class edit_faculty extends load{

		/**
	    * Initial data faculty
	    *
	    * @var  string
	    */
		var $faculty_id;

		// --------------------------------------------------------------------

	    /**
	     * Constructor
	     *
	     * @return void
	     */

		function __construct(){

			if(userData()["level"] == 0) return false;

			$this->faculty_id = clean_xss_string($this->post("id"));

			if(!empty($this->faculty_id)){

				$this->delete($this->faculty_id);
				return true;
			}

			foreach ($this->post() as $key => $value) {
				
				$value = clean_xss_string($value);

				if($key !== "old-idf")
					$build[$key] = $value;

				if(empty($value)){

					echo "Please complete all data correctly";
					exit;

				}

			}

			if($this->check_id() == false){
				echo "id already used";
				exit;
			}

			$build["where-idf"] = $this->post("old-idf");

			API_access("data_update?name=data_faculty",true,$build);

			$this->set_in_majors();


		}

		// --------------------------------------------------------------------

	    /**
	     * Check if faculty id is available
	     *
	     * @return boolean
	     */

		function check_id(){

			$old_id = clean_xss_string($this->post("old-idf"));

			$new_id = clean_xss_string($this->post("idf"));

			$query1 = API_access("list_faculty?q=".$new_id, true);

			$query2 = API_access("list_majors?q=".$new_id, true);

			$response = true;

			if($new_id !== $old_id){
				
				if(in_array($new_id, array_keys($query1))) $response = false;

				if(in_array($new_id, array_keys($query2))) $response = false;

			}else $response = true;

			return $response;

		}

		// --------------------------------------------------------------------

	    /**
	     * update faculty id in data_majors
	     *
	     * @return void
	     */

		function set_in_majors(){

			$old_id = clean_xss_string($this->post("old-idf"));

			$new_id = clean_xss_string($this->post("idf"));

			API_access("data_update?name=data_major",true,[
				"faculty_id" => $new_id,
				"where-faculty_id" => $old_id
			]);

		}

		// --------------------------------------------------------------------

		/**
	     * Delete data relation
	     *
	     * @return void
	     */

		function delete($id = null){

			API_access("data_delete?name=data_faculty", true, ["idf" => $id]);
			API_access("data_delete?name=data_major", true, ["faculty_id" => $id]);

		}

	}