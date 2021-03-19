<?php

/**
 * data_inser Class
 *
 * API for insert Data
 *
 * @category	models
 * @package		models
 * @uses 		controller/api
 */

	class data_insert extends load{

		/**
	    * Initial database name
	    *
	    * @var  string
	    */
		var $database;

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return string
	     */

		function __construct(){

			header_content_type("json");

			$this->database = clean_xss_string($this->get("name"));

			$this->catch_error();

		}

		// --------------------------------------------------------------------

	    /**
	     * Error Handler
	     *
	     * @return mixed
	     */

		function catch_error(){

			try{

				$this->main_query();

				echo json_encode(array(
					
					"response" => true

				));

			}catch(Exception $e){

				echo json_encode(array(

					"response" => false

				));

			}

		}

		// --------------------------------------------------------------------

	    /**
	     * Query builder
	     *
	     * @return string
	     */

		function query_command(){

			$query = $_POST;

			unset($query["token"]);
			unset($query["domain"]);

			foreach($query as $key => $val){

				$value = str_replace("'",null, $val);

				$build[$key] = "'".$value."'";

			}

			$index = implode(",", array_keys($build));
			$value = implode(",", ($build));

			return "INSERT INTO ".$this->database." (".$index.") VALUES (".$value.")";
			

		}

		// --------------------------------------------------------------------

	    /**
	     * Query Executor
	     *
	     * @return void
	     */

		function main_query(){

			return $this->db_query($this->query_command());				
		}

	}