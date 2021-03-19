<?php

/**
 * select_education Class
 *
 * HTML template for selecting a list of 
 * faculties and majors taken by students
 *
 * @category	models
 * @package		models
 * @uses 		controller/api
 */
	
	class select_education extends load{

		/**
	    * Faculty id
	    *
	    * @var  integer
	    */
		var $faculty;

		/**
	    * Majors id
	    *
	    * @var  integer
	    */
		var $majors;

		// --------------------------------------------------------------------

	    /**
	     * Constructor
	     *
	     * @return JSON
	     */

		function __construct(){

			header_content_type("json");

			$this->faculty = clean_xss_string($this->get("faculty"));
			$this->majors = clean_xss_string($this->get("major"));

			$build = $this->get_faculty();

			echo json_encode($build);

		}

		// --------------------------------------------------------------------

	    /**
	     * HTML Themplate for faculty select box
	     *
	     * @return STRING
	     */

		function get_faculty(){

			$query = API_access("list_faculty");

			$html = "<select name='faculty' class='input' style='width:94%' onChange='return select_faculty(this)'>";

			$sum = 0;

			foreach($query as $id => $value){

				if($id !== "response")

				foreach($value as $degree => $name){

					if((empty($this->faculty)) and ($sum == 0)) $this->faculty = $id;

					$html .= ($this->faculty == $id) ? 
							"<option value='".$id."' selected>".$name." (".$degree.")</option>" :
							"<option value='".$id."'>".$name." (".$degree.")</option>";

				}

				$sum++;

			}

			$html .= "<select>";

			$build['select_faculty'] = $html;

			$build['select_major'] = $this->get_major($this->majors, $this->faculty);

			return $build;

		}

		// --------------------------------------------------------------------

	    /**
	     * HTML Themplate for majors  select box
	     *
	     * @return STRING
	     */

		function get_major($idm = null, $id_faculty){

			$query = API_access("list_majors?q=".$id_faculty);

			$html = "<select name='major' class='input' style='width:94%' onChange='return select_faculty(this)'>";

			foreach($query as $id => $name){

				if($id !== "response")
					
				$html .= ($idm == $id) ? 
						"<option value='".$id."' selected>".$name."</option>" :
						"<option value='".$id."'>".$name."</option>";

			}

			$html .= "<select>";

			return $html;

		}

	}