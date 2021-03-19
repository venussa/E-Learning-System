<?php

/**
 * activity Class
 *
 * Controller for manage activity
 *
 * @category	controller
 * @package		controllers
 * @uses 		models/activity
 */

	class activity extends load{

		// --------------------------------------------------------------------

	    /**
	     * Default HTTP Request
	     *
	     * @return string
	     */

		public function __construct(){

			if((userData()["user_type"] == "student"))

	    	header("location:".HomeUrl()."/profile");

		}

		// --------------------------------------------------------------------

	    /**
	     * Default HTTP Request
	     * Show interface of list activity
	     *
	     * @return string
	     */

		public function home(){

			$this->view(
				array("header","navbar","activity/index","footer"),
				$this->list_activity()
			);

		}

		// --------------------------------------------------------------------

	    /**
	     * Add new activity interface
	     *
	     * @return string
	     */

		public function add(){

			$this->view(
				array("header","navbar","activity/add","footer"),
				$this->component()
			);
		}

		// --------------------------------------------------------------------

	    /**
	     * Edit activity inteface
	     *
	     * @return string
	     */

		public function edit(){

			$data = $this->component();

			if(!isset($data["title"])){

				header("location:".HomeUrl()."/profile");
				exit;

			}

			$this->view(
				array("header","navbar","activity/edit","footer"),
				$data
			);
		}

		// --------------------------------------------------------------------

	    /**
	     * Manage detail activity interface
	     *
	     * @return string
	     */

		public function manage(){

			$data = $this->activity_data();

			if(!isset($data["title"])){

				header("location:".HomeUrl()."/profile");
				exit;

			}

			$this->view(
				array("header","navbar","activity/manage","footer"),
				$data
			);
		}

		// --------------------------------------------------------------------

	    /**
	     * Add New Section interface
	     *
	     * @return string
	     */

		public function new_section(){

			$data = $this->activity_data();

			if(!isset($data["title"])){

				header("location:".HomeUrl()."/profile");
				exit;

			}

			$this->view(
				array("header","navbar","activity/new_section","footer"),
				$data
			);
		}
	
		// --------------------------------------------------------------------

	    /**
	     * update section interface
	     *
	     * @return string
	     */

		public function update_section(){

			$data = $this->section_data();

			if(!isset($data["title"])){

				header("location:".HomeUrl()."/profile");
				exit;

			}

			$this->view(
				array("header","navbar","activity/update_section","footer"),
				$data
			);
		}

		// --------------------------------------------------------------------

	    /**
	     * add new quiz interface
	     *
	     * @return string
	     */

		public function new_quiz(){

			$data = $this->quiz_data();

			if(!isset($data["id"])){

				header("location:".HomeUrl()."/profile");
				exit;

			}

			$this->view(
				array("header","navbar","activity/new_quiz","footer"),
				$data
			);
		}

		// --------------------------------------------------------------------

	    /**
	     * edit quiz interface
	     *
	     * @return string
	     */

		public function update_quiz(){ 

			$data = $this->quiz_data();

			if(!isset($data["id"])){

				header("location:".HomeUrl()."/profile");
				exit;

			}

			$this->view(
				array("header","navbar","activity/update_quiz","footer"),
				$data
			);
		}

		// --------------------------------------------------------------------

	    /**
	     * Detail quiz interface
	     *
	     * @return string
	     */

		public function detail_quiz(){

			$data = $this->list_courses(false);
			$data = array_merge($data, $this->list_courses());

			$this->view(
				array("header","navbar","activity/detail_quiz","footer"), 
				$data
			);
		}

		// --------------------------------------------------------------------

	    /**
	     * Review quiz interface
	     *
	     * @return string
	     */

		public function review_quiz(){

			$query = API_access("data_select?name=data_attempt", true, [
				"quiz_id" => $this->get("id"),
				"student_id" => $this->get("nim")
			]);

			$data = $this->attempt_quiz();

			$detail_quiz = $this->detail_data_quiz();

			$_SESSION["attempt_cluster"] = $detail_quiz["cluster"];
			$_SESSION["attempt_status"] = $query[0]["status"];
			$_SESSION["show_correct_answer"] = $data["show_correct_answer"];

			if($query["total_data"] > 0){
				$detail_quiz["q_status"] = ($query[0]["status"] == 1) ? "Finish" : "Pending";

				if($data["show_grade_result"] == 1){
					if($query[0]["status"] == 0)
						$detail_quiz["q_grade"] = "Remaining ...";
					else
						$detail_quiz["q_grade"] = $query[0]["grade"]."/100";
				}else 
				$detail_quiz["q_grade"] = "Not Display";

				$detail_quiz["q_start"] = date("l, d M Y, h:i A", $query[0]["start_date"]);
				$detail_quiz["q_finish"] = date("l, d M Y, h:i A", $query[0]["submit_time"]);
				
				$time_taken = $query[0]["submit_time"] - $query[0]["start_date"];
				$time_data = secondsToTime($time_taken);

				if($time_taken > dateStamp()->hour)
					$taken = $time_data["hour"]." Hours ".($time_data["minute"] > 0 ? $time_data["minute"]." Minutes" : null);
				else
					$taken = $time_data["minute"]." Minutes ".($time_data["second"] > 0 ? $time_data["second"]." Seconds" : null);

				$detail_quiz["q_time_taken"] = $taken;

			}

			$this->view(
				array("header","navbar","activity/review_quiz","footer"), 
				$detail_quiz
			);
		}

		protected function attempt_quiz(){

			$build = [];

			$page = (int) clean_xss_string($this->get("page"));

			if($page < 1) $page = 1;

			$query = API_access("data_select?name=data_question",true,[

				"id" => $this->get("id")

			]);

			if($query["total_data"] > 0){

				$topic = API_access("data_select?name=data_topic", true,[

					"id" => $query[0]["topic_id"]

				]);

				if($topic["total_data"] > 0){

					$activity = API_access("data_select?name=data_activity",true,[

						"id" => $topic[0]["activity_id"],
						"class" => userData()["class"],
						"display" => 1

					]);

					$build["activity_id"] = $topic[0]["activity_id"];

					if($activity["total_data"] > 0){

						$course = API_access("data_select?name=data_course",true, [
							"kdmk" => $activity[0]["course_id"]
						]);

						$build["activity_id"] = $activity[0]["id"];
						$build["title0"] = $activity[0]["title"];
						$build["title1"] = $topic[0]["title"];
						$build["title2"] = $query[0]["title"];
						$build["teacher_id"] = $activity[0]["teacher_id"];

						$student = API_access("list_student?q=".$this->get("nim")."&limit=1",true);
						$build["student_name"] = $student[0]["first_name"]." ".$student[0]["last_name"];
						$build["profile_pict"] = $student[0]["profile_pict"];
						$build["student_email"] = $student[0]["email"];
						$build["student_phone"] = $student[0]["phone"];

						$_SESSION["regulator"] = $build["teacher_id"];
						$_SESSION["cluster_data"] = $query[0]["cluster"];
						$_SESSION["quiz_id"] = $query[0]["id"];

						$query1 = API_access("data_select?name=data_attempt", true, [
							"quiz_id" => $this->get("id"),
							"student_id" => $this->get("nim")
						]);

						if($query1["total_data"] > 0){
							$finish = ucwords(monthConvert((int) date("m",$query1[0]["finish_date"]), 0));
							$finish .= " ".monthConvert(date("d, Y H:i",$query1[0]["finish_date"]));
							$build["time_finish"] = $query1[0]["finish_date"];
							$build["finish_time"] = $query1[0]["finish_date"];
							$_SESSION["attempt_id"] = $query1[0]["id"];
						}

						if(!empty($page)){

							$number = $page;

							if(empty($number)) $number = 0;
							else $number = ($number >= 1) ? ($number - 1) : 0;

							$question = API_access("data_select?name=data_answer",true, [
								"cluster_id" => $query[0]["cluster"],
								"student_id" => userData()["nim"]
							]);

							if($question["total_data"] > 0){

								$question[$number]["total_page"] = $question["total_data"];
								$question[$number]["q_id"] = $question[$number]["id"];
								$_SESSION["list_id"] = $question[$number]["id"];

								$question = $question[$number];

							}else $question[] = null;

						}else $question[] = null;


						$build = array_merge($build, $query[0], $question);

					}

				}

			}

			return $build;

		}

		protected function detail_data_quiz(){

			$build = [];

			$query = API_access("data_select?name=data_question",true,[

				"id" => $this->get("id")

			]);

			if($query["total_data"] > 0){

				$topic = API_access("data_select?name=data_topic", true,[

					"id" => $query[0]["topic_id"]

				]);

				if($topic["total_data"] > 0){

					$activity = API_access("data_select?name=data_activity",true,[

						"id" => $topic[0]["activity_id"],
						"class" => userData()["class"],
						"display" => 1

					]);

					if($activity["total_data"] > 0){

						$build["activity_title"] = $activity[0]["title"];
						$build["topic_title"] = $topic[0]["title"];
						$build["activity_class"] = $activity[0]["class"];

						$majors = API_access("data_select?name=data_major",true, ["idm" => $activity[0]["major"]]);
						$build["activity_major"] = $majors[0]["name"];

						$faculty = API_access("data_select?name=data_faculty",true, ["idf" => $activity[0]["faculty"]]);
						$build["activity_faculty"] = $faculty[0]["name"];

						$student = API_access("list_student?q=".$this->get("nim")."&limit=1",true);
						$build["student_name"] = $student[0]["first_name"]." ".$student[0]["last_name"];
						$build["profile_pict"] = $student[0]["profile_pict"];
						$build["student_email"] = $student[0]["email"];
						$build["student_phone"] = $student[0]["phone"];
						$build["student_id"] = $student[0]["nim"];

						$build["activity_id"] = $activity[0]["id"];
						$build["start_date"] = date("l, d M Y, h:i A", $query[0]["start_time"]);
						$build["end_date"] = date("l, d M Y, h:i A", $query[0]["end_time"]);

						$query[0]["time_limit"] = ($query[0]["time_limit"] == 0) ? "-" : $query[0]["time_limit"]." Minutes";
						$course = API_access("data_select?name=data_course",true, [
							"kdmk" => $activity[0]["course_id"]
						]);

						$build["course_name"] = $course[0]["title"];

						$build = array_merge($build, $query[0]);

					}

				}

			}

			return $build;

		}




		// --------------------------------------------------------------------

	    /**
	     * Generate list course data
	     *
	     * @return array
	     */

		protected function list_courses($type_response = true){

			$data_courses = API_access("data_select?name=data_attempt&sort_by=desc&order_by=id", true, [

				"quiz_id" => $this->get("id")

			]);

			$HTML = null;

			if($data_courses["total_data"] == 0) 

			$HTML .= "<tr><td colspan='5'><p style='text-align:center;font-size:14px;'>Data Not Found</p></td></tr>";

			foreach($data_courses as $key => $value){

					if(is_numeric($key)){

						$question = API_access("data_select?name=data_question",true,[
							"id" => $value["quiz_id"]
						])[0];

						
						$value["review"] = null;
							
						if(($value["attempt"] == 1) and ($value["status"] == 0)){
						$value["grade"] = "<a href='".HomeUrl()."/activity/review_quiz?id=".$question["id"]."&nim=".$value["student_id"]."' ".SPA_attribute(false).">Need Review</a>";
						$value["review"] = "background:#fffebf";
						}elseif(($value["attempt"] == 1) and ($value["status"] == 1))
						$value["grade"] = $value["grade"]."/100";
						else
						$value["grade"] = null;

						

						$value["title"] = "<a href='".HomeUrl()."/my_courses/attempt?id=".$question["id"]."' ".SPA_attribute(false).">".$question["title"]."</a>";

						$topic = API_access("data_select?name=data_topic",true,[
							"id" => $question["topic_id"]
						])[0];

						$activity = API_access("data_select?name=data_activity",true,[
							"id" => $topic["activity_id"]
						])[0];

						$major = API_access("data_select?name=data_major",true,[
							"idm" => $activity["major"]
						])[0];

						$course = API_access("data_select?name=data_course",true,[
							"kdmk" => $activity["course_id"]
						])[0];

						$user = API_access("data_select?name=data_student",true,[
							"nim" => $value["student_id"]
						])[0];

						$value["profile_pict"] = sourceUrl()."/media/user-picture/".$user["profile_pict"];
						$value["username"] = $user["first_name"]." ".$user["last_name"];


						$value["course"] = "<p style='font-size:12px;'><i style='color:#666'>".$major["name"]." / ".$course["title"]."</i></p>";

						$value["finish_on"] = date("l, d M Y, H:i A", $value["submit_time"]);

						$value["no"] = $course["kdmk"];

						if($value["status"] == 1) $value["status"] = "Finish";
						elseif(($value["status"] == 0) and $value["attempt"] == 0) $value["status"] = "<span style='color:#ff0000'>On Progress</span>";
						elseif(($value["status"] == 0) and $value["attempt"] == 1) $value["status"] = "Pending";


						$HTML .= $this->HTML_themplate_grade($value);

					}

				

			}

			if($type_response == false){

				$question = API_access("data_select?name=data_question",true,[
					"id" => $this->get("id")
				])[0];

				$topic = API_access("data_select?name=data_topic",true,[
					"id" => $question["topic_id"]
				])[0];

				$activity = API_access("data_select?name=data_activity",true,[
					"id" => $topic["activity_id"]
				])[0];

				$major = API_access("data_select?name=data_major",true,[
					"idm" => $activity["major"]
				])[0];

				$course = API_access("data_select?name=data_course",true,[
					"kdmk" => $activity["course_id"]
				])[0];

				$value1["activity_id"] = $activity["id"];
				$value1["activity_title"] = $activity["title"];
				$value1["topic_title"] = $topic["title"];
				$value1["title"] = $question["title"];

				return $value1;

			}

			return [
				"list_data" => $HTML, 
				"pagination" => $this->pagination($data_courses["total_data"])
			];

		}

		// --------------------------------------------------------------------

	    /**
	     * Generate Question List of Quiz Data For Editing
	     * Read data from database and set it to session
	     *
	     * @return array
	     */

		protected function generate_edit_quiz(){

			$cluster = clean_xss_string($this->get("cluster"));

			if(!empty($cluster)){

				// general question data
				$result = API_access("data_select?name=data_question",true,array(
					"id" => $cluster
				));

				if($result["total_data"] == 0) return false;

				$result = $result[0];

				$_SESSION["EDIT_DATA"] = (!isset($_SESSION["EDIT_DATA"])) 
				? $result["cluster"] : $_SESSION["EDIT_DATA"];

				if($result["cluster"] !== $_SESSION["EDIT_DATA"]){

					$_SESSION["EDIT_DATA"] = $result["cluster"];
					unset($_SESSION["general"]);

					for($i = 1; $i < 200; $i++){

						if(isset($_SESSION["number-".$i])) unset($_SESSION["number-".$i]);
						else break;

					}

				}

				$_SESSION["general"]["general_title"] = (
					!isset($_SESSION["general"]["general_title"])
				) ? $result["title"] : $_SESSION["general"]["general_title"];

				$_SESSION["general"]["general_start_time"] = (
					!isset($_SESSION["general"]["general_start_time"])
				) ? date("Y-m-d",$result["start_time"]) : $_SESSION["general"]["general_start_time"];

				$_SESSION["general"]["general_start_time_hour"] = (
					!isset($_SESSION["general"]["general_start_time_hour"])
				) ? date("H:i",$result["start_time"]) : $_SESSION["general"]["general_start_time_hour"];

				$_SESSION["general"]["general_end_time"] = (
					!isset($_SESSION["general"]["general_end_time"])
				) ? date("Y-m-d",$result["end_time"]) : $_SESSION["general"]["general_end_time"];

				$_SESSION["general"]["general_end_time_hour"] = (
					!isset($_SESSION["general"]["general_end_time_hour"])
				) ? date("H:i",$result["end_time"]) : $_SESSION["general"]["general_end_time_hour"];

				$_SESSION["general"]["general_time_limit"] = (
					!isset($_SESSION["general"]["general_time_limit"])
				) ? "0".((int) $result["time_limit"]) : "0".((int) $_SESSION["general"]["general_time_limit"]);

				$_SESSION["general"]["general_correct_answer"] = (
					!isset($_SESSION["general"]["general_correct_answer"])
				) ? $result["show_correct_answer"] : $_SESSION["general"]["general_correct_answer"];

				$_SESSION["general"]["general_grade_result"] = (
					!isset($_SESSION["general"]["general_grade_result"])
				) ? $result["show_grade_result"] : $_SESSION["general"]["general_grade_result"];

				$_SESSION["general"]["general_hide_quiz"] = (
					!isset($_SESSION["general"]["general_hide_quiz"])
				) ? $result["display"] : $_SESSION["general"]["general_hide_quiz"];

				// question list data

				$query = API_access(
					"data_select?name=data_question_list",
					true,
					["cluster_id" => $result['cluster']]
				);

				$show = $query;

				unset($show["total_data"]);
				unset($show["total_data_this_page"]);
				unset($show["response"]);

				$sum = 1;

				foreach($show as $index => $result){
					
					$_SESSION["edit_list"][$sum] = $result["id"];
					
					switch($result["question_type"]){

						case 0:

						$_SESSION["number-".$sum]["answer_type"] = (
							!isset($_SESSION["number-".$sum]["answer_type"])
						) ? $result["question_type"] : $_SESSION["number-".$sum]["answer_type"];

						$_SESSION["number-".$sum]["multiple_choice_question"] = (
							!isset($_SESSION["number-".$sum]["multiple_choice_question"])
						) ? $result["question"] : $_SESSION["number-".$sum]["multiple_choice_question"];

						$_SESSION["number-".$sum]["multiple_choice"] = (
							!isset($_SESSION["number-".$sum]["multiple_choice"])
						) ? $result["answer"] : $_SESSION["number-".$sum]["multiple_choice"];

						$_SESSION["number-".$sum]["true_answer"] = (
							!isset($_SESSION["number-".$sum]["true_answer"])
						) ? $result["true_answer"] : $_SESSION["number-".$sum]["true_answer"];

						$_SESSION["number-".$sum]["opportunity_answer"] = (
							!isset($_SESSION["number-".$sum]["opportunity_answer"])
						) ? $result["chance"] : $_SESSION["number-".$sum]["opportunity_answer"];

						break;

						case 1:

						$_SESSION["number-".$sum]["answer_type"] = (
							!isset($_SESSION["number-".$sum]["answer_type"])
						) ? $result["question_type"] : $_SESSION["number-".$sum]["answer_type"];

						$_SESSION["number-".$sum]["essay_question"] = (
							!isset($_SESSION["number-".$sum]["essay_question"])
						) ? $result["question"] : $_SESSION["number-".$sum]["essay_question"];

						$_SESSION["number-".$sum]["attach_files"] = (
							!isset($_SESSION["number-".$sum]["attach_files"])
						) ? $result["attach_form"] : $_SESSION["number-".$sum]["attach_files"];

						break;

						case 2:

						$_SESSION["number-".$sum]["answer_type"] = (
							!isset($_SESSION["number-".$sum]["answer_type"])
						) ? $result["question_type"] : $_SESSION["number-".$sum]["answer_type"];

						$_SESSION["number-".$sum]["mc_question"] = (
							!isset($_SESSION["number-".$sum]["mc_question"])
						) ? $result["question"] : $_SESSION["number-".$sum]["mc_question"];

						$_SESSION["number-".$sum]["true_answer"] = (
							!isset($_SESSION["number-".$sum]["true_answer"])
						) ? $result["true_answer"] : $_SESSION["number-".$sum]["true_answer"];


						break;

					}

					$sum++;

				}

			}else{

				// reset data for add new quiz
				if(!empty($this->get("new"))){

					$_SESSION["EDIT_DATA"] = time();

					unset($_SESSION["general"]);

					for($i = 1; $i < 200; $i++){

						if(isset($_SESSION["number-".$i])) unset($_SESSION["number-".$i]);
						else break;

					}
				}

			}

		}

		// --------------------------------------------------------------------

	    /**
	     * Generate General Data Of Quiz Data
	     * Read data from database set it to session
	     * 
	     * @return array
	     */

		protected function generate_temporary_data_quiz($main_index, $general_index){

			$show = API_access("data_select?name=data_topic",true,array(

				"id" => clean_xss_string($this->get("id"))

			))[0];

			$data_activity = API_access("list_activity", true,[
				"teacher_id" => userData()['nidn'],
				"id" => $show['activity_id']
			])[0];

			$show['title0'] = $data_activity['title'];

			foreach($general_index as $key => $index){

				if(($index == "correct_answer") or ($index == "grade_result") or ($index == "hide_quiz"))
					$show["general_".$index] = (!empty($_SESSION["general"]["general_".$index])) ? 
				"checked" : null;

				else $show["general_".$index] = (!empty($_SESSION["general"]["general_".$index])) ? 
				clean_xss_string($_SESSION["general"]["general_".$index]) : null;

			}

			$number = (int) clean_xss_string($this->get("number"));

			if($number == 0) $number = 1;

			foreach($main_index as $key => $val){

				if(isset($_SESSION["number-".$number][$val])) {

					$show[$val] = ($_SESSION["number-".$number][$val] !== "") ? 
					$_SESSION["number-".$number][$val] : null;

					if($val == "multiple_choice"){

						$show["answer_list_data"] = null;

						foreach(json_decode($_SESSION["number-".$number][$val]) as $key1 => $val1){
							
							if(in_array($val1, json_decode($_SESSION["number-".$number]["true_answer"],true)))
							$checked = "checked"; else $checked = null;

							$show["answer_list_data"] .= $this->multiple_choice_themplate($val1,$checked);

						}
					}

					if($val == "attach_files"){

						if(($show["attach_files"] !== "") and ($show["attach_files"] == 1))  $show["attach_files"] = "checked";

					}
					

				}else{

					$show[$val] = null;
					$show["answer_list_data"] = null;

				}

				if(isset($_SESSION["number-".$number]["mc_question"])) {

					$show["match_choice_list"] = null;

					foreach(json_decode($_SESSION["number-".$number]["mc_question"]) as $key1 => $val1){
						
						$checked = json_decode($_SESSION["number-".$number]["true_answer"],true)[$key1];

						$show["match_choice_list"] .= $this->match_choice_themplate($val1,$checked);

					}

				}else $show["match_choice_list"] = null;

			}

			return $show;

		}

		// --------------------------------------------------------------------

	    /**
	     * Quiz Data Joinner
	     *
	     * @return array
	     */

		protected function quiz_data(){

			$general_index = ["title","start_time","start_time_hour","end_time","end_time_hour","time_limit", "correct_answer","grade_result","hide_quiz"];

			$main_index = ["mc_question","essay_question","multiple_choice_question","attach_files","true_answer","opportunity_answer","multiple_choice","answer_type"];

			$this->generate_edit_quiz();

			return $this->generate_temporary_data_quiz($main_index, $general_index);

		}

		// --------------------------------------------------------------------

	    /**
	     * Generate Section data
	     *
	     * @return array
	     */

		protected function section_data(){

			$show = API_access("data_select?name=data_topic",true,array(

				"id" => clean_xss_string($this->get("id"))

			))[0];

			$data_activity = API_access("list_activity", true,[
				"teacher_id" => userData()['nidn'],
				"id" => $show['activity_id']
			])[0];

			$display = ["Hide","Show"];

			$html = null;

			foreach($display as $key => $val){

				$html .= ($key == $show['display']) ? 
				"<option selected value='".$key."'>".$val."</option>" : "<option value='".$key."'>".$val."</option>";

			}

			$show['title0'] = $data_activity['title'];
			$show['display'] = $html;
			$show['check_forum'] = ($show['attach_forum'] == 1) ? "checked" : null;
			$show['forum_title'] = ($show['attach_forum'] == 1) ? $show['forum_title'] : null;
			$show['title-status'] = ($show['attach_forum'] == 1) ? null : "disabled";

			if(!empty($show['attach_file'])) $show['attach_file'] = "/".$show['attach_file'];

			$attach_file = explode("/", $show['attach_file']);

			$html = null;

			foreach($attach_file as $key => $val){

				if(!empty($val)){
					$ext = explode(".", $val);
					$ext = end($ext);
					$name = str_replace(".".$ext, null, $val);
					$name = stringLimit($name, 20, "...").$ext;

					$html .= '<p style="border:1px #ddd dashed;padding: 5px;margin:10px;color:#666">';
	        		$html .= '<img src="'.sourceUrl().'/media/web-icon/'.$ext.'.png" width="18"> '.$name;
					$html .= '<img realname="'.$val.'" src="'.sourceUrl().'/media/web-icon/times.png" width="10" style="cursor:pointer;float:right;margin-top:5px;" onClick="return remove_file(this)">';
					$html .= '</p>';
				}
			}

			$show['attach_list'] = $html;

			return $show;

		}

		// --------------------------------------------------------------------

	    /**
	     * Generate Detail Activity data
	     *
	     * @return array
	     */

		protected function activity_data(){

			$data_activity = API_access("list_activity", true,[
				"teacher_id" => userData()['nidn'],
				"id" => $this->get("id")
			]);

			$data_activity = $data_activity[0];

			$teacher_info = API_access("list_teacher?q=".$data_activity['teacher_id'],true)[0];

			$data_activity['teacher_name'] = $teacher_info['first_name']." ".$teacher_info['last_name'];
			$data_activity['teacher_email'] = $teacher_info['email'];
			$data_activity['teacher_profile'] = $teacher_info['profile_pict'];
			$data_activity['teacher_phone'] = $teacher_info['phone'];

			$query = API_access("data_select?name=data_topic",true,array(

				"activity_id" => clean_xss_string($this->get("id"))

			));

			$html = null;
			$number = 1;
			foreach($query as $key => $show){

				if(is_numeric($key)){
					$show['number'] = $number;
					$show['teacher_id'] = $data_activity['teacher_id'];
					$html .= $this->HTML_section_themplate($show);
					$number++;
				}

			}

			$data_activity['list_section'] = $html;

			return $data_activity;

		}

		// --------------------------------------------------------------------

	    /**
	     * Generate list activity data
	     *
	     * @return array
	     */

		protected function list_activity(){

			$data_activity = API_access("list_activity".$this->search_paramater(1), true,
				["teacher_id" => userData()['nidn']]
			);

			$HTML = null;

			if($data_activity['total_data'] == 0) 
			$HTML .= "<tr><td colspan='6'><p style='text-align:center;font-size:14px;'>Data Not Found</p></td></tr>";

			foreach($data_activity as $key => $value){
				
				if(is_numeric($key))
				$HTML .= $this->HTML_themplate($value);

			}

			return [
				"list_data" => $HTML, 
				"pagination" => $this->pagination($data_activity['total_data'])
			];
		}

		// --------------------------------------------------------------------

	    /**
	     * Generate Pagination
	     *
	     * @return string
	     */

		protected function pagination($totaldata){

			return pagination(
				$this->search_paramater()["page"],
				$this->search_paramater()["limit"],
				$totaldata,
				HomeUrl()."/activity".$this->search_paramater(2),
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
	     * Search query builder
	     *
	     * @return string
	     */

		protected function search_paramater($response = 0){

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
	     * Generate activity data for editing
	     *
	     * @return string
	     */

		protected function component(){

			$my_data = userData();

			$activity_data = API_access("list_activity",true,[
				"teacher_id" => userData()['nidn'],
				"id" => $this->get("id")
			]);

			if($activity_data["response"] == true){

				$build['title'] = $activity_data[0]['title'];
				$build['description'] = $activity_data[0]['description'];
				$build['display'] = null;
				foreach(["Hide","Show"] as $key => $val){
					$build['display'] .= ($key == $activity_data[0]['display']) ?
					"<option value='$key' selected>$val</option>" : 
					"<option value='$key'>$val</option>";
				}

				$build['start_date'] = date("Y-m-d", $activity_data[0]['start_date']);
				$build['end_date'] = date("Y-m-d", $activity_data[0]['end_date']);

				$class = str_split($activity_data[0]['class']);
				$class = $class[0].$class[1]."{major}".$class[count($class)-2].$class[count($class)-1];

			}else $class = "{major}";

			$build['class_select'] = $this->class_select($class);
			$build['level_select'] = $this->level_select($class);

			if(isset($activity_data[0]['faculty'])) 
				$paramater = "?faculty=".$activity_data[0]['faculty']."&major=".$activity_data[0]['major'];

			else $paramater = null;

			$data_faculty = API_access("select_education".$paramater);

			$build["faculty_select"] = $data_faculty->select_faculty;
			$build["major_select"] = $data_faculty->select_major;

			$active_course = "<select name='course_id' class='input'  required>";

			foreach(explode(",", $my_data['active_course']) as $key => $val){

				$show = API_access("data_select?name=data_course",true,array(

					"kdmk" => clean_xss_string($val)

				))[0];

				if((isset($activity_data[0])) and ($activity_data[0]['course_id'] == $show['kdmk']))
				$active_course .= "<option value='".$show['kdmk']."' selected>".$show['title']."</option>";
				else
				$active_course .= "<option value='".$show['kdmk']."'>".$show['title']."</option>";

			}

			$active_course .= "</select>";

			$build['my_course'] = $active_course;

			$data_faculty = API_access("select_education".$paramater);

			$build["faculty_select"] = $data_faculty->select_faculty;
			$build["major_select"] = $data_faculty->select_major;

			return $build;

		}

		// --------------------------------------------------------------------

	    /**
	     * Generate html themplate for select student level
	     *
	     * @return string
	     */

		protected function level_select($data = "{major}"){

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
	     * Generate html themplate for select student class
	     *
	     * @return string
	     */

		protected function class_select($data = "{major}"){

			$data = explode("{major}", $data);

			$html = null;

			for($i = 1; $i < 100; $i++){

				$html .= ($data[1] == $i) ? "<option selected>".sprintf("%02d",$i)."</option>" :
				"<option>".sprintf("%02d",$i)."</option>";

			}

			return $html;
		}

		// --------------------------------------------------------------------

	    /**
	     * Generate html themplate for multiple choice in quiz manipulate
	     *
	     * @return string
	     */

		protected function multiple_choice_themplate($value = null, $checked = null){

			$data["checked"] = $checked;
			$data["value"] = $value;

			return $this->view("activity/html_part/multiple_choice",$data, false);
		}

		// --------------------------------------------------------------------

	    /**
	     * Generate html themplate for match choice in quiz manipulate
	     *
	     * @return string
	     */

		protected function match_choice_themplate($quest = null, $ans = null){

			if(!empty($quest) and !empty($ans)){

				$data["question"] = $quest;
				$data["answer"] = $ans;

				return $this->view("activity/html_part/match_choice",$data, false);

			}
			
			return null;

		}

		// --------------------------------------------------------------------

	    /**
	     * Generate html list course
	     *
	     * @return string
	     */

		protected function HTML_themplate_grade($object){

			return $this->view("activity/html_part/list_grade", $object, false);

		}

		// --------------------------------------------------------------------

	    /**
	     * Generate html themplate for activity list
	     *
	     * @return string
	     */

		protected function HTML_themplate($object){

			$object["display"] = ($object['display'] == 0) ? 
			"<span class=\"red-breadcum\" >Hide</span>" : null;

			$object["start_date"] = date("M d, Y H:i", $object["start_date"]);

			$object["end_date"] = date("M d, Y H:i", $object["end_date"]);

			return $this->view("activity/html_part/list",$object, false);

		}

		// --------------------------------------------------------------------

	    /**
	     * Generate html themplate for section in activity
	     *
	     * @return string
	     */

		protected function HTML_section_themplate($object){

			$attach_file = explode("/",$object['attach_file']);

			$html = null;

			$tmp_data = $object;

			foreach($attach_file as $key => $val){

				$ext = explode(".", $val);

				$tmp_data["ext"] = end($ext);
				$tmp_data["value"] = $val;
                
                if(!empty(trim($val)))
				$html .= $this->view("activity/html_part/file_attach",$tmp_data, false);

			}

			if($object['attach_forum'] == 1)

				$html .= $this->view("activity/html_part/list_forum",$tmp_data, false);


			$list_quiz = API_access("data_select?name=data_question",true,array(

							"topic_id" => clean_xss_string($object['id'])

						));

			foreach($list_quiz as $key => $show_quiz){

				if(is_numeric($key)){
					
					$tmp_data["quiz_display"] = ($show_quiz["display"] == 1) ? 
					"<span class=\"red-breadcum\" >Hide</span>" : null;
					$tmp_data["quiz_id"] = $show_quiz['id'];
					$tmp_data["quiz_title"] = $show_quiz['title'];

					$attempt = API_access("data_select?name=data_attempt", true, [
						"quiz_id" => $show_quiz['id'],
						"status" => 0,
						"attempt" => 1
					]);

					if($attempt["total_data"] > 0) $tmp_data["alert"] = "<span style='margin:5px;font-size:10px;color:#ff0000'>".$attempt["total_data"]." Need Reviews</span>";
					else $tmp_data["alert"] = null;

					$html .= $this->view("activity/html_part/list_quiz",$tmp_data, false);

				}

			}
		
			$tmp_data["section_display"] = ($object['display'] == 0) ? 
			"<span class='big-red-breadcum'>Hide</span>" : null;
			$tmp_data["html"] = $html;
		
			return $this->view("activity/html_part/list_section",$tmp_data, false);

		}

	}


?>