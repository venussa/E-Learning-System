<?php
	
/**
 * list_majors Class
 *
 * list university study sub division
 * displays majors data found at the university
 *
 * @category	models
 * @package		models
 * @uses 		controller/api
 */

	class list_majors extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor
	     *
	     * @return JSON
	     */

		function __construct(){

			header_content_type("json");

			$search = clean_xss_string($this->get("q"));

			$query = API_access("data_select?name=data_major",true,[

				"idm%" => $search,
				"faculty_id%" => $search

			]);

			$build["response"] = true;

			if($query["total_data"] == 0){

				$query = API_access("data_select?name=data_major",true);

				$build["response"] = false;
			}

			foreach($query as $key => $show){

				if(is_numeric($key))

				$build[$show['idm']] = $show['name'];

			}

			echo json_encode($build);

		}

	}