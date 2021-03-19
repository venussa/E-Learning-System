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

	class list_activity extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return string
	     */

		function __construct(){

			header_content_type("json");

			$post = $_POST;
			
			$post["title%"] = clean_xss_string($this->get("q"));
			$post["class%"] = clean_xss_string($this->get("q"));

			$page["page"] = clean_xss_string($this->get("page"));
			$page["limit"] = clean_xss_string($this->get("limit"));

			$page = "&".http_build_query($page, '', '&');

			$query = API_access("data_select?name=data_activity".$page,true,$post);

			foreach($query as $key => $show){

				if(is_numeric($key))
				$build[] = $this->build_data_as_json($show);

				else $build[$key] = $show;

			}

			echo json_encode($build);

		}

		// --------------------------------------------------------------------

	    /**
	     * Generate result as json
	     *
	     * @return string
	     */

		function build_data_as_json($show){

			foreach ($show as $key => $value) {

				$original = $value;

				if($key == "faculty") $tmp_data['faculty_name'] = $this->get_faculty($original);

				if($key == "major") $tmp_data['major_name'] = $this->get_major($original);

				if(!is_numeric($key)) $tmp_data[$key] = $value;

			}

			return $tmp_data;

		}

		// --------------------------------------------------------------------

	    /**
	     * Get Faculty data
	     *
	     * @return darray mixed
	     */

		function get_faculty($id = 0){

			foreach(API_access("list_faculty?q=".$id) as $key => $value)
				
				if($key !== "response")

				foreach($value as $degree => $name)

					$build = $name;

					return $build;

		}

		// --------------------------------------------------------------------

	    /**
	     * Get majors data
	     *
	     * @return string
	     */

		function get_major($id = 0){

			foreach(API_access("list_majors?q=".$id) as $mid => $name)

				if($mid !== "response")

				return $name;

		}

	}