<?php

/**
 * list_faculty Class
 *
 * list university study division division
 * displays faculty data found at the university
 *
 * @category	models
 * @package		models
 * @uses 		controller/api
 */
	
	class list_faculty extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor
	     *
	     * @return JSON
	     */

		function __construct(){

			header_content_type("json");

			$search = clean_xss_string($this->get("q"));

			$query = API_access("data_select?name=data_faculty",true,[

				"idf" => $search

			]);

			$build["response"] = true;

			if($query["total_data"] == 0){

				$query = API_access("data_select?name=data_faculty",true);

				$build["response"] = false;

			}

			$sum = 0;

			foreach($query as $key => $show){

				if(is_numeric($key))

				$build[$show['idf']] = [$show['degree'] => $show['name']];

			}

			echo json_encode($build);

		}

	}