<?php

/**
 * faculty Class
 *
 * controller for faculties and majors data management
 *
 * @category	controller
 * @package		controllers
 * @uses 		models/faculty
 */

	class faculty extends load{

		/**
	    * Initial data faculty
	    *
	    * @var  string
	    */
		public $search;

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return string
	     */

		public function __construct(){

			if((userData()["level"] == 0) and (splice(2) !== "select_education")){

	    		header("location:".HomeUrl()."/profile");
	    		exit;

	    	}
			
			$this->search = clean_xss_string($this->get("q"));

		}

		// --------------------------------------------------------------------

	    /**
	     * HTTP Request Deafult Access
	     *
	     * @return string
	     */

		public function home(){

			$this->view(["header","navbar","faculty/index","footer"], $this->create_cluster_data());

		}

		// --------------------------------------------------------------------

	    /**
	     * HTML Themplate For faculty list
	     *
	     * @return string
	     */

		protected function faculty_HTML_themplate($name, $faculty_id, $degree, $incrament = 0){

			$data["faculty_id"] = $faculty_id;

			$data["name"] = $name;

			$data["degree"] = $degree;

			$data["degree1"] = $this->degree_select($degree);

			$data["header"] = (
				($this->search == $faculty_id) or ($incrament == 0) and (empty($this->search))
			) ? "<li class='active'>" : "<li>";

			return $this->view("faculty/html_part/faculty_list", $data, false);

		}

		// --------------------------------------------------------------------

	    /**
	     * Faculty data generalization
	     *
	     * @return array
	     */

		protected function list_faculty(){

			$query = API_access("list_faculty");

			$incrament = 0;

			$build["faculty"] = null;

			foreach($query as $faculty_id => $data){

				if($faculty_id !== "response"){

					foreach($data as $degree => $name);

					$build["faculty"] .= $this->faculty_HTML_themplate(
						$name, $faculty_id, $degree, $incrament
					);

					if($this->search == $faculty_id){

						$build["faculty_title"] = $name;
						$build["faculty_id"] = $faculty_id;

					}

					if(($incrament == 0) and (empty($this->search))){

						$build['faculty_title'] = $name;
						$build["faculty_id"] = $faculty_id;
						$this->search = $faculty_id;

					}

					if($incrament == 0){

						$first_title = $name;
						$first_id = $faculty_id;

					}

					$incrament++;

				}

			}

			if(!isset($build["faculty_title"])){

				$build["faculty_title"] = $first_title;
				$build["faculty_id"] = $first_id;

			}

			if(empty($build["faculty"]))

				$build["faculty"] = "<li style='text-align:center;'><a>Data Not Found</a></li>";

			return $build;

		}

		// --------------------------------------------------------------------

	    /**
	     * HTML Themplate for majors list
	     *
	     * @return string
	     */

		protected function majors_HTML_themplate($majors_id, $name){

			$data["major_id"] = $majors_id;
			$data["name"] = $name;

			return $this->view("faculty/html_part/major_list", $data, false);

		}

		// --------------------------------------------------------------------

	    /**
	     * Majors data generalization
	     *
	     * @return array
	     */

		protected function list_majors(){

			$query = API_access("list_majors?q=".$this->search);

			$build['majors'] = null;

			foreach($query as $key => $value){

				if($key !== "response"){
					
					$build["majors"] .= $this->majors_HTML_themplate($key, $value);

				}

			}

			if($query->response == false) 
				$build["majors"] = "<li style='text-align:center;'><a>Data Not Found</a></li>";


			return $build;

		}

		// --------------------------------------------------------------------

	    /**
	     * HTML thmeplate for faculty data selection
	     *
	     * @return array
	     */

		protected function data_selection(){

			$data_faculty = API_access("select_education");

			$build['select_faculty'] = str_replace("94%","95%", $data_faculty->select_faculty);
			$build['select_faculty'] = str_replace("faculty","faculty_id", $build['select_faculty']);

			return $build;
		}

		// --------------------------------------------------------------------

	    /**
	     * Merger all data result
	     *
	     * @return array
	     */

		protected function create_cluster_data(){

			return array_merge(
				$this->list_faculty(),
				$this->list_majors(),
				$this->data_selection()
			);

		}

		// --------------------------------------------------------------------

	    /**
	     * HTML Themplate for degree selection
	     *
	     * @return void
	     */

		protected function degree_select($data = null){

			$degree = ["D1", "D2", "D3", "D4", "S1", "S2", "S3"];

			$html = null;

			foreach($degree as $key => $value){

				$html .= ($data == $value) ? 
					"<option selected>$value</option>" :
					"<option>$value</option>" ;

			}

			return $html;

		}
	}