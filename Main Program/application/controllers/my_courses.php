<?php

class my_courses extends load{

	// --------------------------------------------------------------------

    /**
     * Default Constructoe
     *
     * @return string
     */

    public function __construct(){

    	if((userData()["user_type"] == "teacher"))

    	header("location:".HomeUrl()."/profile");

    }

	public function home(){

		$this->view(["header", "navbar", "courses/my_courses", "footer"], $this->data_courses());

	}

	public function detail(){

		$query = API_access("data_select?name=data_activity", true, [
			"id" => $this->get("id")
		]);

		if($query["total_data"] == 0){

			header("location:".HomeUrl()."/my_courses/");

		}else

		$this->view(["header", "navbar", "courses/detail", "footer"], $this->detail_courses());

	}

	public function attempt(){

		$query = API_access("data_select?name=data_attempt", true, [
			"quiz_id" => $this->get("id"),
			"student_id" => userData()["nim"]
		]);

		$data = $this->attempt_quiz();

		$detail_quiz = $this->detail_quiz();

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

		if(!isset($data["cluster"])) {

			header("location:".HomeUrl()."/my_courses/detail?id=".$data["activity_id"]);

		}elseif(time() < $data["quest_start"]){

			$this->view(["header", "navbar", "courses/prepare_quiz", "footer"], $detail_quiz);

		}elseif(($query["total_data"] > 0) and (time() > $data["finish_time"]) and ($query[0]["attempt"] == 0)) {

			header("location:".HomeUrl()."/my_courses/finish_attempt?id=".$this->get("id"));

		}elseif(($query["total_data"] > 0) and (time() < $data["finish_time"]) and ($query[0]["attempt"] == 0)) {

			header("location:".HomeUrl()."/my_courses/quiz?id=".$this->get("id"));

		}elseif(($query["total_data"] > 0) and ($query[0]["attempt"] == 1)) {

			$this->view(["header", "navbar", "courses/finish_quiz", "footer"], $detail_quiz);

		}elseif(time() > $data["quest_finish"]){

			$this->view(["header", "navbar", "courses/close_quiz", "footer"], $detail_quiz);

		}else{

			$this->view(["header", "navbar", "courses/attempt", "footer"], $detail_quiz);
		}

	}

	public function quiz(){

		$query = API_access("data_select?name=data_attempt", true, [
			"quiz_id" => $this->get("id"),
			"student_id" => userData()["nim"]
		]);

		$data = $this->attempt_quiz();

		if($query["total_data"] == 0){

			header("location:".HomeUrl()."/my_courses/detail?id=".$data["activity_id"]);

		}elseif($query[0]["attempt"] == 1){

			header("location:".HomeUrl()."/my_courses/attempt?id=".$this->get("id"));

		}elseif(time() < $data["start_time"]){

			header("location:".HomeUrl()."/my_courses/attempt?id=".$this->get("id"));

		}elseif(($query["total_data"] > 0) and (time() > $data["finish_time"])) {

			header("location:".HomeUrl()."/my_courses/finish_attempt?id=".$this->get("id"));

		}else if(time() > $data["end_time"]){

			header("location:".HomeUrl()."/my_courses/attempt?id=".$this->get("id"));

		}else{

			$this->view(["header", "navbar", "courses/quiz", "footer"], $data);

		}

	}

	protected function attempt_quiz(){

		$build = [];

		$page = (int) clean_xss_string($this->get("page"));

		if($page < 1) $page = 1;

		$query = API_access("data_select?name=data_question",true,[

			"id" => $this->get("id")

		]);

		if($query["total_data"] > 0){
		    
		    $query[0]["quest_start"] = $query[0]["start_time"];
	    	$query[0]["quest_finish"] = $query[0]["end_time"];

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

					$teacher = API_access("list_teacher?q=".$activity[0]["teacher_id"]."&limit=1",true);
					$build["teacher_name"] = $teacher[0]["first_name"]." ".$teacher[0]["last_name"];
					$build["profile_pict"] = $teacher[0]["profile_pict"];
					$build["teacher_email"] = $teacher[0]["email"];
					$build["teacher_phone"] = $teacher[0]["phone"];

					$_SESSION["regulator"] = $build["teacher_id"];
					$_SESSION["cluster_data"] = $query[0]["cluster"];
					$_SESSION["quiz_id"] = $query[0]["id"];

					$query1 = API_access("data_select?name=data_attempt", true, [
						"quiz_id" => $this->get("id"),
						"student_id" => userData()["nim"]
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

	protected function detail_quiz(){

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

					$teacher = API_access("list_teacher?q=".$activity[0]["teacher_id"]."&limit=1",true);
					$build["teacher_name"] = $teacher[0]["first_name"]." ".$teacher[0]["last_name"];
					$build["profile_pict"] = $teacher[0]["profile_pict"];
					$build["teacher_id"] = $teacher[0]["nidn"];
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

	protected function detail_courses(){

			$data_activity = API_access("list_activity", true,[
				"id" => $this->get("id"),
				"display" => 1,
				"start_date<" => time(),
				"end_date>" => time()
			]);

			$data_activity = $data_activity[0];

			$teacher_info = API_access("list_teacher?q=".$data_activity['teacher_id'],true)[0];

			$data_activity['teacher_name'] = $teacher_info['first_name']." ".$teacher_info['last_name'];
			$data_activity['teacher_email'] = $teacher_info['email'];
			$data_activity['teacher_profile'] = $teacher_info['profile_pict'];
			$data_activity['teacher_phone'] = $teacher_info['phone'];

			$query = API_access("data_select?name=data_topic",true,array(

				"activity_id" => clean_xss_string($this->get("id")),
				"display" => 1

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

	protected function data_courses(){

		$userdata = userData();

		$active_course = explode(",", $userdata["active_course"]);

		$build["class"] = $userdata["class"];
		$build["display"] = 1;
		$build["start_date<"] = time();
		$build["end_date>"] = time();

		$query = API_access("data_select?name=data_activity", true, $build);

		$result["list_course"] = null;

		if($query["total_data"] > 0){

			foreach($query as $key => $val){

				if((is_numeric($key)) and (in_array($val["course_id"], $active_course))) {

					$majors = API_access("data_select?name=data_major",true, ["idm" => $val["major"]]);
					$val["major"] = $majors[0]["name"];

					$faculty = API_access("data_select?name=data_faculty",true, ["idf" => $val["faculty"]]);
					$val["faculty"] = $faculty[0]["name"];

					$course = API_access("data_select?name=data_course",true, ["kdmk" => $val["course_id"]]);
					$val["course_name"] = $course[0]["title"];

					$teacher = API_access("list_teacher?q=".$val["teacher_id"]."&limit=1",true);
					$val["teacher_name"] = $teacher[0]["first_name"]." ".$teacher[0]["last_name"];

					$val["profile_pict"] = $teacher[0]["profile_pict"];

					

					$topic = API_access("data_select?name=data_topic", true, [

						"activity_id" => $val["id"]

					]);

					$alert = 0;

					foreach($topic as $k => $v){

						if(is_numeric($k)){

							$attempt = API_access("data_select?name=data_question", true, [
								"topic_id" => $v["id"],
								"start_time<" => time(),
								"end_time>" => time()
							]);
                            
							foreach($attempt as $j => $k){

								if(is_numeric($j)){

									$count_attempt = API_access("data_select?name=data_attempt",true,[
										"student_id" => userData()["nim"],
										"quiz_id" => $k["id"]
									]);

									if($count_attempt["total_data"] > 0){

										if($count_attempt[0]["attempt"] == 0) $alert += 1; 

									}else $alert += 1;

								}

							}


						}

					}

					$val["alert_quiz"] = ($alert > 0) ? 
					'<button class="other-breadcum" title="'.$alert.' Quiz Remaining">'.$alert.'</button>' : null;
					
					$result["list_course"] .= $this->view("courses/html_part/my_courses",$val, false);

				}

			}

		}

		return $result;

	}	

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
			$html .= $this->view("courses/html_part/file_attach",$tmp_data, false);

		}

		if($object['attach_forum'] == 1)

			$html .= $this->view("courses/html_part/list_forum",$tmp_data, false);


		$list_quiz = API_access("data_select?name=data_question",true,array(

						"topic_id" => clean_xss_string($object['id']),
						"display" => 0

					));

		foreach($list_quiz as $key => $show_quiz){

			if(is_numeric($key)){
				
				$tmp_data["quiz_display"] = ($show_quiz["display"] == 1) ? 
				"<span class=\"red-breadcum\" >Hide</span>" : null;
				$tmp_data["quiz_id"] = $show_quiz['id'];
				$tmp_data["quiz_title"] = $show_quiz['title'];

				$grade = API_access("data_select?name=data_attempt", true, [

					"student_id" => userData()["nim"],
					"quiz_id" => $show_quiz["id"]

				]);

				if(isset($grade[0]["grade"])){

					if($grade[0]["status"] == 1){

						$tmp_data["check_status"] = '<img src="'.sourceUrl().'/media/web-icon/check.png" width="25" style="position: absolute;margin-left:-20px;">';
						$tmp_data["my_grade"] = "<b>Grade</b> : ".$grade[0]["grade"]."/100";


					}elseif($grade[0]["attempt"] == 1){

						$tmp_data["check_status"] = '<img src="'.sourceUrl().'/media/web-icon/check.png" width="25" style="position: absolute;margin-left:-20px;">';
						$tmp_data["my_grade"] = null;

					}else{

						$tmp_data["check_status"] = null;
						$tmp_data["my_grade"] = null;

					}	

				}else{

					$tmp_data["my_grade"] = null;
					$tmp_data["check_status"] = null;


				}

				if(($grade[0]["status"] == 0) and ($grade[0]["attempt"] == 1)) 
						$tmp_data["my_grade"] = "<b>Grade</b> : Remaining";

				if($show_quiz["show_grade_result"] == 0) $tmp_data["my_grade"] = null;

				$html .= $this->view("courses/html_part/list_quiz",$tmp_data, false);

			}

		}
	
		$tmp_data["section_display"] = ($object['display'] == 0) ? 
		"<span class='big-red-breadcum'>Hide</span>" : null;
		$tmp_data["html"] = $html;
	
		return $this->view("courses/html_part/list_section",$tmp_data, false);

	}

}