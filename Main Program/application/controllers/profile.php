<?php

/**
 * profile Class
 *
 * Manage User Profile
 *
 * @category	controller
 * @package		controllers
 * @uses 		models/profile
 */

	class profile extends load{

		// --------------------------------------------------------------------

	    /**
	     * Default HTTP Access 
	     *
	     * @return string
	     */

		public function home(){

			if($_SESSION["user_type"] == "teacher") $data = $this->detail_teacher();
			if($_SESSION["user_type"] == "student") $data = $this->detail_student();

			$this->view(["header", "navbar",$_SESSION["user_type"]."/detail", "footer"], $data);

		}

		// --------------------------------------------------------------------

	    /**
	     * Edit user page
	     *
	     * @return string
	     */

		public function preference(){

			if($_SESSION["user_type"] == "teacher") $data = $this->detail_teacher();
			if($_SESSION["user_type"] == "student") $data = $this->detail_student();

			$this->view(["header", "navbar",$_SESSION["user_type"]."/edit", "footer"], $data);

		}
	  	
	  	// --------------------------------------------------------------------

	    /**
	     * User Logout
	     *
	     * @return string
	     */

	    public function logout(){

	    	session_destroy();
	    	header("location:".HomeUrl()."/account/login");

	    }

	    // --------------------------------------------------------------------

	    /**
	     * Show Detail teacher data
	     *
	     * @return array
	     */

		protected function detail_teacher(){

			$data_teacher = API_access("list_teacher?q=".userData()["nidn"]."&limit=1");

			foreach($data_teacher as $key => $value){

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

					if($index == "level"){

						$build['level_check'] = ($data == 1) ? "checked" : null;

					}

					if($index == "gender") $build['gender_select'] = $this->gender_select($data);

					if($index == "birth_day") $build['birth_day_select'] = date("Y-m-d", $data);

					if($index == "religion") $build['religion_select'] = $this->religion_select($data);

					$build[$index] = $tmp_data;

				}

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

			return $build;

		}


		// --------------------------------------------------------------------

	    /**
	     * Show Detail Student data
	     *
	     * @return array
	     */

		protected function detail_student(){

			$data_student = API_access("list_student?q=".userData()["nim"]."&limit=1");

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
	     * Show HTML themplate for list teacher
	     *
	     * @return string
	     */

		protected function HTML_themplate($object){

			return $this->view($_SESSION["user_type"]."/html_part/list_".$_SESSION["user_type"], $object, false);

		}

		// --------------------------------------------------------------------

	    /**
	     * Genrate breadcum
	     *
	     * @return string
	     */


		protected function breadcum($data = null, $display = null){

			$build = null;

			if($display !== "edit") $display = "display:none";

			unset($data['response']);

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
	     * Gender Select Box
	     *
	     * @return string
	     */

		protected function gender_select($gender_id = null){

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

		protected function religion_select($religion = null){

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