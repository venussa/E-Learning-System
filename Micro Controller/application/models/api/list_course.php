<?php

/**
 * list course Class
 *
 * displays the course data listed
 *
 * @category	models
 * @package		models
 * @uses 		controller/api
 */

	class list_course extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return string
	     */

		function __construct(){

			header_content_type("json");

			$filter = clean_xss_string($this->get("filter"));

			$post = $_POST;
			
			$post["title%"] = clean_xss_string($this->get("q"));
			$post["kdmk%"] = clean_xss_string($this->get("q"));

			$page["page"] = clean_xss_string($this->get("page"));
			$page["limit"] = clean_xss_string($this->get("limit"));

			$page = "&".http_build_query($page, '', '&');

			$query = API_access("data_select?name=data_course".$page,true,$post);

			foreach($query as $key => $show){

				if(!empty($filter)){

					if(is_numeric($key))
					$build[] = $this->build_data_as_json($show);

					else $build[$key] = $show;

				}else{

					if(is_numeric($key))
					$build[$show["kdmk"]] = $show["title"];
				}

			}

			echo json_encode($build);

		}

		// --------------------------------------------------------------------

	    /**
	     * Generate data as json
	     *
	     * @return string
	     */

		function build_data_as_json($show){

			foreach ($show as $key => $value) {

				$original = $value;

				if(!is_numeric($key)) $tmp_data[$key] = $value;

			}

			return $tmp_data;

		}

	}