<?php

/**
 * tmp_quiz Class
 *
 * Save temporary data of general question data
 *
 * @category	models
 * @package		models
 * @uses 		controller/activity
 */

	class tmp_quiz extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return string
	     */

		function __construct(){

			if(userData()["user_type"] == "student") return false;

			$index = clean_xss_string($this->post("index"));
			$value = clean_xss_string($this->post("value"));

			if(
				($index == "general_correct_answer") or 
				($index == "general_grade_result") or 
				($index == "general_hide_quiz"))
			{

				$value = (!empty($_SESSION["general"][$index])) ? null : $value;
			}

			$_SESSION["general"][$index] = $value;

			echo $_SESSION["general"][$index];

		}

	}