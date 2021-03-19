<?php

/**
 * show_setting Class
 *
 * generalize website settings from database
 *
 * @category	models
 * @package		models
 * @uses 		controller/api
 */

	class show_setting extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor
	     *
	     * @return JSON
	     */

		function __construct(){

			header_content_type("json");

			$query = API_access("data_select?name=data_setting&limit=100",true);

			foreach($query as $key => $show) 
				if(is_numeric($key))
					$build[$show['title']] = $show['conf'];

			echo json_encode($build);

		}

	}