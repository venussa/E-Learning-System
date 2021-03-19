<?php

/**
 * courses Class
 *
 * Controller for manage courses
 *
 * @category	controller
 * @package		controllers
 * @uses 		models/courses
 */

	class courses extends load{


		// --------------------------------------------------------------------

	    /**
	     * Default HTTP Request
	     *
	     * @return string
	     */

		public function __construct(){

			if((userData()["level"] == 0))

	    	header("location:".HomeUrl()."/profile");

		}

		// --------------------------------------------------------------------

	    /**
	     * Default HTTP Request
	     * Show interface of list courses
	     *
	     * @return string
	     */

		public function home(){
			
			$this->view(["header","navbar","courses/index","footer"], $this->list_courses());

		}

		// --------------------------------------------------------------------

	    /**
	     * HTML add course page
	     * Show interface of add course page
	     *
	     * @return string
	     */

		public function add(){
			
			$this->view(["header","navbar","courses/add_courses","footer"]);

		}

		// --------------------------------------------------------------------

	    /**
	     * HTML edit course page
	     * Show interface of edit course page
	     *
	     * @return string
	     */

		public function edit(){

			$this->view(["header","navbar","courses/edit_courses","footer"], $this->data_courses());

		}

		// --------------------------------------------------------------------

	    /**
	     * Generate course data
	     *
	     * @return array
	     */

		protected function data_courses(){

			$data_courses = API_access("list_course?filter=true&q=".$this->get("id"),true);

			return $data_courses[0];

		}

		// --------------------------------------------------------------------

	    /**
	     * Generate list course data
	     *
	     * @return array
	     */

		protected function list_courses(){

			$data_courses = API_access("list_course".$this->search_paramater(1),true);

			$HTML = null;

			if($data_courses["total_data"] == 0) 

			$HTML .= "<tr><td colspan='5'><p style='text-align:center;font-size:14px;'>Data Not Found</p></td></tr>";

			foreach($data_courses as $key => $value){

					if(is_numeric($key))

					$HTML .= $this->HTML_themplate($value);

				

			}

			return [
				"list_data" => $HTML, 
				"pagination" => $this->pagination($data_courses["total_data"])
			];

		}

		// --------------------------------------------------------------------

	    /**
	     * Generate html list course
	     *
	     * @return string
	     */

		protected function HTML_themplate($object){

			return $this->view("courses/html_part/list_courses", $object, false);

		}

		// --------------------------------------------------------------------

	    /**
	     * Generate pagination
	     *
	     * @return string
	     */

		protected function pagination($totaldata){

			return pagination(
				$this->search_paramater()["page"],
				$this->search_paramater()["limit"],
				$totaldata,
				HomeUrl()."/courses".$this->search_paramater(2),
				"pagination",
				null,
				SPA()->class,
				SPA()->data_pjax,
				"active",
				null
			);

		}

		// --------------------------------------------------------------------

	    /**
	     * Generate query search
	     *
	     * @return string
	     */

		protected function search_paramater($response = 0){

			$data["filter"] = "true";
			$data["page"] = ((int) $this->get("page") == 0) ? 1 : (int) $this->get("page");
			$data["limit"] = ((int) $this->get("limit") == 0) ? 10 : (int) $this->get("limit");
			$data["q"] = $this->get("q");

			if($response == 1){

				foreach ($data as $key => $value) {
					
					if(!empty($value))
					$build[] = $key."=".$value;

				}

				return "?".implode("&", $build);

			}

			if($response == 2){

				foreach ($data as $key => $value) {
					
					if(($key !== "page") and (!empty($value)))
					$build[] = $key."=".$value;

				}

				return "?".implode("&", $build);

			}

			return $data;

		}
	}