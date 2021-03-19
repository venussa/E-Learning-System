<?php

/**
 * edit_majors Class
 *
 * updating the latest data about 
 * the majors on university data
 *
 * @category	models
 * @package		models
 * @uses 		controller/faculty
 */
	
	class edit_majors extends load{

		/**
	    * Initial data faculty
	    *
	    * @var  string
	    */
		var $majors_id;

		// --------------------------------------------------------------------

	    /**
	     * Constructor
	     *
	     * @return void
	     */

		function __construct(){

			if(userData()["level"] == 0) return false;

			$this->majors_id = clean_xss_string($this->post("id"));

			if(!empty($this->majors_id)){

				$this->delete($this->majors_id);
				return true;
			}

			foreach ($this->post() as $key => $value) {
				
				$value = clean_xss_string($value);

				if($key !== "old-idm")
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

			$build["where-idm"] = $this->post("old-idm");

			API_access("data_update?name=data_major",true,$build);

		}

		// --------------------------------------------------------------------

	    /**
	     * Check if faculty id is available
	     *
	     * @return boolean
	     */

		function check_id(){

			$old_id = clean_xss_string($this->post("old-idm"));

			$new_id = clean_xss_string($this->post("idm"));

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
	     * Delete data relation
	     *
	     * @return void
	     */

		function delete($id = null){

			API_access("data_delete?name=data_major", true, ["idm" => $id]);

		}


	}