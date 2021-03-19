<?php

/**
 * student Class
 *
 * Manage student data
 *
 * @category	controller
 * @package		controllers
 * @uses 		models/student
 */

	class student extends load{

		// --------------------------------------------------------------------

	    /**
	     * Default HTTP Access 
	     *
	     * @return string
	     */

		public function home(){

			if(userData()["user_type"] == "student") {

		    	header("location:".HomeUrl()."/profile");
		    	exit;

	    	}

			$this->view(["header", "navbar","student/index", "footer"], $this->list_student());

		}

		// --------------------------------------------------------------------

	    /**
	     * Show Page Detail
	     *
	     * @return string
	     */

		public function detail(){

			$data = $this->detail_student();

			if(!isset($data["nim"])){

				header("location:".HomeUrl()."/profile");
				exit;

			}


			$this->view(["header", "navbar","student/detail", "footer"], $data);

		}

		// --------------------------------------------------------------------

	    /**
	     * Show Page Edit Student
	     *
	     * @return string
	     */

		public function edit(){

			$data = $this->detail_student();

			if(!isset($data["nim"])){

				header("location:".HomeUrl()."/profile");
				exit;

			}

			if(userData()["level"] == 0) {

		    	header("location:".HomeUrl()."/profile");
		    	exit;

	    	}

			$this->view(["header", "navbar","student/edit", "footer"], $this->detail_student());

		}

		// --------------------------------------------------------------------

	    /**
	     * Show Page Add Student
	     *
	     * @return string
	     */

		public function add(){

			if(userData()["level"] == 0) {

		    	header("location:".HomeUrl()."/profile");
		    	exit;

	    	}

			$this->view(["header", "navbar","student/add", "footer"], $this->detail_student());

		}

		// --------------------------------------------------------------------

	    /**
	     * Show Detail Student data
	     *
	     * @return array
	     */

		protected function detail_student(){

			$data_student = API_access("list_student?q=".$this->get("nim")."&limit=1");

			foreach($data_student as $key => $value){

				if(is_numeric($key))

				foreach($value as $index => $data){

					$tmp_data = $data;

					if($index == "birth_day") $tmp_data = date("M d, Y", $data);
					
					if($index == "active_course") {

						foreach($data as $index1 => $data1){
							if($index1 !== "response"){
							$course[$index1] = $data1;
							$list_course[] = $index1;
							}
						}

						$build["list_course"] = implode(",", $list_course);

						$tmp_data = $this->breadcum($course, splice(2));
					}

					if($index == "register_date") $tmp_data = date("M d, Y", $data)." <i style='color:#666;font-size:13px;'>(".timeHistory($data).")</i>";

					if($index == "online") $tmp_data = date("M d, Y", $data)." <i style='color:#666;font-size:13px;'>(".timeHistory($data).")</i>";

					if($index == "account_status"){

						$build['active'] = ($data == 1) ? "checked" : null;
						$build['suspend'] = ($data == 0) ? "checked" : null;

					}

					if($index == "gender") $build['gender_select'] = $this->gender_select($data);

					if($index == "birth_day") $build['birth_day_select'] = date("Y-m-d", $data);

					if($index == "religion") $build['religion_select'] = $this->religion_select($data);

					if($index == "class"){

						$build['class_select'] = $this->class_select($data);
						$build['level_select'] = $this->level_select($data);

					}

					$build[$index] = $tmp_data;

				}

			}

			if(!isset($build['class'])) {
				$build['class_select'] = $this->class_select("1{major}01");
				$build['level_select'] = $this->level_select("1{major}01");
			}

				if(isset($build['province'])) $paramater = "?province="
					.urlencode($build["province"])."&district="
					.urlencode($build["district"])."&village="
					.urlencode($build["village"])."&postal_code="
					.urlencode($build["postal_code"]);
				else $paramater = null;

				$data_address = API_access("select_place".$paramater);

				$build["province_select"] = $data_address->provinsi;
				$build["district_select"] = $data_address->kabupaten;
				$build["village_select"] = $data_address->kecamatan;
				$build["postal_code_select"] = $data_address->kodepos;

				if(isset($build['faculty'])) $paramater = "?faculty=".$build['faculty']."&major=".$build['major'];

				else $paramater = null;

				$data_faculty = API_access("select_education".$paramater);

				$build["faculty_select"] = $data_faculty->select_faculty;
				$build["major_select"] = $data_faculty->select_major;

			return $build;

		}

		// --------------------------------------------------------------------

	    /**
	     * Show List Student Data
	     *
	     * @return array
	     */

		protected function list_student(){

			$data_student = API_access("list_student".$this->search_paramater(1), true);

			$HTML = null;

			if($data_student["total_data"] == 0) 
				
				$HTML .= "<tr><td  colspan='5'><p style='text-align:center;font-size:14px;'>Data Not Found</p></td></tr>";

			foreach($data_student as $key => $value){

				if(is_numeric($key)) {
					
					$value["name"] = $value["first_name"]." ".$value["last_name"];

					$value["account_status"] = ($value['account_status'] == 0) ?
					"<span style='color:#ff243c;font-size:13px;margin-left:10px;'>Suspend</span>" : null;

					$HTML .= $this->HTML_themplate($value);

				}

			}

			return [
				"list_data" => $HTML, 
				"pagination" => $this->pagination($data_student["total_data"])
			];

		}

		// --------------------------------------------------------------------

	    /**
	     * Show HTML themplate for list student
	     *
	     * @return string
	     */

		protected function HTML_themplate($object){

			return $this->view("student/html_part/list_student", $object, false);

		}

		// --------------------------------------------------------------------

	    /**
	     * Genrate breadcum
	     *
	     * @return string
	     */

		function breadcum($data = null, $display = null){

			$build = null;

			unset($data['response']);

			if($display !== "edit") $display = "display:none";

			if(count($data) > 0){

				foreach ($data as $key => $value)
					$build .= "<p class='ellipsis' index='$key' style='margin-left:10px' >
							<img src='".sourceUrl()."/media/web-icon/times.png' width='10' style='margin-right:10px;cursor:pointer;$display' index='$key' onClick='return remove_course(this)'>
							<span class='breadcum' title='$value'>$key</span> $value
							</p>";

			}
			
			return $build;

		}

		// --------------------------------------------------------------------

	    /**
	     * Generate Pagination
	     *
	     * @return string
	     */

		function pagination($totaldata){

			return pagination(
				$this->search_paramater()["page"],
				$this->search_paramater()["limit"],
				$totaldata,
				HomeUrl()."/student".$this->search_paramater(2),
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
	     * Query Builder
	     *
	     * @return string
	     */

		function search_paramater($response = 0){

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

		// --------------------------------------------------------------------

	    /**
	     * Gender Select Box
	     *
	     * @return string
	     */

		function gender_select($gender_id = null){

			$gender = ["Female", "Male"];

			$HTML = null;

			foreach ($gender as $key => $value) {
				
				$HTML .= ($value == $gender_id) ? 
				"<option value='$key' selected>$value</option>" : 
				"<option value='$key'>$value</option>";				

			}

			return $HTML;

		}

		// --------------------------------------------------------------------

	    /**
	     * Region Select Box
	     *
	     * @return string
	     */

		function religion_select($religion = null){

			$data_religion = API_access("list_religion");

			unset($data_religion->response);

			$HTML = null;

			foreach($data_religion as $key => $value){

				$HTML .= ($value == $religion) ? 
				"<option value='$key' selected>$value</option>": 
				"<option value='$key'>$value</option>";

			}

			return $HTML;


		}

		// --------------------------------------------------------------------

	    /**
	     * level_select
	     *
	     * @return string
	     */

		function level_select($data){

			$data = explode("{major}", $data);

			$html = null;

			for($i = 1; $i < 8; $i++){

				$html .= ($data[0] == $i) ? "<option selected>$i</option>" :
				"<option>$i</option>";

			}

			return $html;

		}

		// --------------------------------------------------------------------

	    /**
	     * Class Select Box
	     *
	     * @return string
	     */

		function class_select($data){

			$data = explode("{major}", $data);

			$html = null;

			for($i = 1; $i < 100; $i++){

				$html .= ($data[1] == $i) ? "<option selected>".sprintf("%02d",$i)."</option>" :
				"<option>".sprintf("%02d",$i)."</option>";

			}

			return $html;
		}

	}