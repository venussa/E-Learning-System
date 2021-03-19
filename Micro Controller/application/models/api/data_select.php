<?php

/**
 * data_select Class
 *
 * API for select Data
 *
 * @category	models
 * @package		models
 * @uses 		controller/api
 */

	class data_select extends load{

		/**
	    * Set limit data per result
	    *
	    * @var  string
	    */
		var $limit_data;

		/**
	    * Set fist offset
	    *
	    * @var  string
	    */
		var $offset;

		/**
	    * Set page data
	    *
	    * @var  string
	    */
		var $page;

		/**
	    * Initial database name
	    *
	    * @var  string
	    */
		var $database;

		/**
	    * Set decision filter data
	    *
	    * @var  string
	    */
		var $sorting;

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return string
	     */

		function __construct(){

			header_content_type("json");

			$this->limit_data = (int) clean_xss_string($this->get("limit"));
			$this->limit_data = ($this->limit_data < 1) ? 10 : $this->limit_data;

			$this->database = clean_xss_string($this->get("name"));

			$this->sorting .= (!empty($this->get("order_by"))) ?
			"ORDER BY ".clean_xss_string($this->get("order_by")) : null;
			
			$this->sorting .= " ".clean_xss_string($this->get("sort_by"));

			$this->page = (int) clean_xss_string($this->get("page"));
			$this->page = ($this->page < 1) ? 1 : $this->page;

			$this->offset = ($this->page - 1) * $this->limit_data;

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

				$build["total_data"] = $this->count_total_data();

				$query = $this->main_query();

				$build["total_data_this_page"] = $query->rowCount();

				while($show = $query->fetch()){

					$build[] = $this->build_data_as_json($show);

				}

				$build["response"] = ($build["total_data"] == 0) ? false : true;

				echo json_encode($build);

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

			return "SELECT * FROM ".$this->database." ".$paramater;
			

		}

		// --------------------------------------------------------------------

	    /**
	     * Count total result of data
	     *
	     * @return void
	     */

		function count_total_data(){

			$query = $this->db_query($this->query_command());

			return $query->rowCount();
		}

		// --------------------------------------------------------------------

	    /**
	     * Query Executor
	     *
	     * @return void
	     */

		function main_query(){

			$command = " ".$this->sorting." LIMIT $this->offset, $this->limit_data ";

			return $this->db_query($this->query_command().$command);				
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