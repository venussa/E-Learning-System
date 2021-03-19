<?php

namespace system\core;

use system\core\database;

/**
 * database_select Class
 *
 * Query access for select data from MySQL database
 * usinjg PDO Driver Extention
 *
 * @package		system
 * @subpackage	core
 * @category	Database Query
 * @throws 		\DBQuery On call Query
 */

	class database_select{

		/**
	    * Initial database name
	    *
	    * @var  string
	    */
		var $database;

		/**
	    * Condition & value
	    *
	    * @var  array
	    */
		var $paramater;

		/**
	    * Select Order
	    *
	    * @var  string
	    */
		var $order;

		/**
	    * Limit result of data
	    *
	    * @var  string
	    */
		var $limit;

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return string
	     */

		function __construct($database, $paramater = array()){

			$this->database = $database;

			$this->paramater = $paramater;

			$option = $this->strToArray();

			if(!empty($option["start_from"]) and !empty($option["until"]))
				$this->limit = "LIMIT ".clean_xss_string($option["start_from"])." "
				.clean_xss_string($option["until"]);

			if(!empty($option["start_from"]) and empty($option["until"]))
				$this->limit = "LIMIT ".clean_xss_string($option["start_from"]);

			if(!empty($option["order_by"]) and !empty($option["sort_by"]))
				$this->order = "ORDER BY ".clean_xss_string($option["order_by"])." "
				.clean_xss_string($option["sort_by"]);

			$this->database = $option["database"];

		}

		function strToArray(){

			$url_components = parse_url($this->database); 

			$params = [];

			if(isset($url_components['query']))
				
				parse_str($url_components['query'], $params); 

			$build["database"] = $url_components["path"];
			$build["order_by"] = (isset($params["order_by"])) ? $params["order_by"] : null;
			$build["sort_by"] = (isset($params["sort_by"])) ? $params["sort_by"] : null;
			$build["start_from"] = (isset($params["start_from"])) ? $params["start_from"] : null;
			$build["until"] = (isset($params["until"])) ? $params["until"] : null;
				
			return $build;

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

				$query = $this->main_query();

				$index = 0;

				while($show = $query->fetch()){

					if($index == 0) $general = $show;

					$build[] = $this->build_data_as_json($show);

					$index++;

				}

				if(isset($general)) {

					$general = $this->build_data_as_json($general);
					$build = array_merge($build, $general);

				}

				return json_decode(json_encode($build));

			}catch(Exception $e){

				return false;

			}

		}

		// --------------------------------------------------------------------

	    /**
	     * Query builder
	     *
	     * @return string
	     */

		function query_command(){

			$query = $this->paramater;

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

			return "SELECT * FROM ".$this->database." ".$paramater." ".$this->order." ".$this->limit;
			

		}

		// --------------------------------------------------------------------

	    /**
	     * Count total result of data
	     *
	     * @return void
	     */

		function count_total_data(){

			$query = (new database)->query($this->query_command());	

			return $query->rowCount();
		}

		// --------------------------------------------------------------------

	    /**
	     * Query Executor
	     *
	     * @return void
	     */

		function main_query(){		

			return (new database)->query($this->query_command());		
		}

		// --------------------------------------------------------------------

	    /**
	     * Build result as json
	     *
	     * @return void
	     */

		function build_data_as_json($show){

			foreach ($show as $key => $value) {
				
				if(!is_numeric($key))
					$tmp_data[$key] = $value;

			}

			return $tmp_data;

		}

	}