<?php

/**
 * list_religion Class
 *
 * displays student data registered 
 * in the Learning Management System
 *
 * @category	models
 * @package		models
 * @uses 		controller/api
 */
	
	class list_religion extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor
	     *
	     * @return JSON
	     */

		function __construct(){

			header_content_type("json");

			$search = clean_xss_string($this->get("q"));

			$query = API_access("data_select?name=data_religion",true,[

				"id%%" => $search,
				"name%" => $search
			]);

			$build['response'] = true;

			if($query["total_data"] == 0){

				$query = API_access("data_select?name=data_religion",true);

				$build['response'] = false;

			}

			foreach($query as $key => $show){

				if(is_numeric($key))

				$build[$show['id']] = $show['name'];

			}

			echo json_encode($build);

		}

	}