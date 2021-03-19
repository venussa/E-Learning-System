<?php

/**
 * action Class
 *
 * CRUD
 *
 * @category	models
 * @package		models
 * @uses 		controller/teacher
 */

	class action extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return string
	     */

		function __construct(){

			if(userData()["level"] == 0) {

				echo "Access Danied";
				exit;

			}


			if(is_array($this->post("id")))
			switch($this->post("type")){

				case 1: $this->suspend(); break;
				case 2: $this->unsuspend(); break;
				case 3: $this->delete(); break;
				case 4: return false; break;
				default: $this->delete(); break;

			}

		}

		// --------------------------------------------------------------------

	    /**
	     * Delete student
	     *
	     * @return string
	     */

		function delete(){

			foreach($_POST['id'] as $key => $value){

				if($value !== userData()["nidn"])

				API_access("data_update?name=data_teacher", true, ["display" => 0, "where-nidn" => $value]);

			}

		}

		// --------------------------------------------------------------------

	    /**
	     * suspend student
	     *
	     * @return string
	     */

		function suspend(){

			foreach($_POST['id'] as $key => $value){

				API_access("data_update?name=data_teacher", true, [
					"account_status" => 0, 
					"where-nidn" => $value
				]);

			}

		}

		// --------------------------------------------------------------------

	    /**
	     * unsuspend student
	     *
	     * @return string
	     */

		function unsuspend(){

			foreach($_POST['id'] as $key => $value){

				API_access("data_update?name=data_teacher", true, [
					"account_status" => 1, 
					"where-nidn" => $value
				]);

			}

		}

	}