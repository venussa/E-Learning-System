<?php

/**
 * data_delete Class
 *
 * API for Delete Data
 *
 * @category	models
 * @package		models
 * @uses 		controller/api
 */
	class data_delete extends load{

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

				$replace = [">=","<=",">","<","%%","%","!"," "];

				$key_index = str_replace($replace,null, $key);

					if(strpos(" ".$key, "%%"))

						$build1[] = $key_index." = '".$val."'";

					elseif(strpos(" ".$key, "%"))

						$build1[] = $key_index." like '%".$val."%'";

					elseif(strpos(" ".$key, ">="))
				
						$build2[] = $key_index." >= ".clean_xss_string($val);

					elseif(strpos(" ".$key, "<="))
				
						$build2[] = $key_index." <= ".clean_xss_string($val);

					elseif(strpos(" ".$key, ">"))
				
						$build2[] = $key_index." > ".clean_xss_string($val);

					elseif(strpos(" ".$key, "<"))
				
						$build2[] = $key_index." < ".clean_xss_string($val);

					elseif(strpos(" ".$key, "!"))
				
						$build2[] = $key_index." != '".clean_xss_string($val)."'";

					else
						$build2[] = $key_index." = '".clean_xss_string($val)."'";
					

			}

			if((isset($build1)) and (isset($build2)))

				$paramater = " WHERE (".implode(" or ", $build1).") and ".implode(" and ", $build2);

			elseif((isset($build1)) and (!isset($build2)))

				$paramater = " WHERE (".implode(" or ", $build1).")";

			elseif((!isset($build1)) and (isset($build2)))

				$paramater = " WHERE ".implode(" and ", $build2);

			else $paramater = null;

			return "DELETE FROM ".$this->database." ".$paramater;
			

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