<?php

/**
 * list_students Class
 *
 * displays student data registered 
 * in the Learning Management System
 *
 * @category	models
 * @package		models
 * @uses 		controller/api
 */
	
	class list_student extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return string
	     */

		function __construct(){

			header_content_type("json");

			$post = $_POST;
			
			$post["first_name%"] = clean_xss_string($this->get("q"));
			$post["last_name%"] = clean_xss_string($this->get("q"));
			$post["nim%"] = clean_xss_string($this->get("q"));
			$post["phone%"] = clean_xss_string($this->get("q"));
			$post["email%"] = clean_xss_string($this->get("q"));
			$post["address%"] = clean_xss_string($this->get("q"));
			$post["province%"] = clean_xss_string($this->get("q"));
			$post["district%"] = clean_xss_string($this->get("q"));
			$post["village%"] = clean_xss_string($this->get("q"));
			$post["postal_code%"] = clean_xss_string($this->get("q"));
			$post["display"] = 1;

			$page["page"] = clean_xss_string($this->get("page"));
			$page["limit"] = clean_xss_string($this->get("limit"));

			$page = "&".http_build_query($page, '', '&');

			$query = API_access("data_select?name=data_student".$page,true,$post);

			foreach($query as $key => $show){

				if(is_numeric($key))
				$build[] = $this->build_data_as_json($show);

				else $build[$key] = $show;

			}

			echo json_encode($build);

		}

		// --------------------------------------------------------------------

	    /**
	     * Buld resolt as json
	     *
	     * @return string
	     */

		function build_data_as_json($show){

			foreach ($show as $key => $value) {

				$original = $value;

				if($key == "active_course")
					$value = $this->active_course(explode(",", $original));

				if($key == "profile_pict"){
				
					if(!empty($original)) 
						$value = "{sourceURL}/media/user-picture/".$original;
					else 
						$value = "{sourceURL}/media/web-image/user-dummy.png";

				}

				if($key == "gender"){
				
					$value = ($value == 1) ? "Male" : "Female";
					$tmp_data['gender_id'] = $original;
				}

				if($key == "faculty"){

					$tmp_data["faculty_name"] = $this->get_faculty($original)['name'];
					$tmp_data["level"] = $this->get_faculty($original)["degree"];

				}

				if($key == "major") $tmp_data["major_name"] = $this->get_major($original);

				if($key == "religion"){
				
					$value = $this->get_religion($original);
					$tmp_data['religion_id'] = $original;
				}

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

					$build['name'] = $name;
					$build['degree'] = $degree;

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

		// --------------------------------------------------------------------

	    /**
	     * Get religion
	     *
	     * @return string
	     */

		function get_religion($id = 1){

			foreach(API_access("list_religion") as $key => $value)

				if($key !== "response")

				if($id == $key) return $value;

		}

		// --------------------------------------------------------------------

	    /**
	     * Get active course data
	     *
	     * @return array mixed
	     */

		function active_course($data = null){

			if(!empty($data))

				foreach($data as $key => $value)

					foreach(API_access("list_course?q=".$value) as $kdmk => $name){

						if($key !== "response"){

							$build[$kdmk] = $name;
							$data = $build;

						}
					}


			return $data;

		}


	}