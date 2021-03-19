<?php

class index extends load{

	function home(){

		$data = (userData()["user_type"] == "student") ? $this->list_courses() : $this->list_activity();
		
		$this->view(["header","navbar","home/".userData()["user_type"],"footer"], $data);

	}

	protected function list_activity(){

			$data_activity = API_access("list_activity", true,[
			    "teacher_id" => userData()['nidn'],
			    "major" => userData()["major"],
			    "faculty" => userData()["faculty"],
			    "class" => userData()["class"]
			    ]);

			$HTML = null;

			if($data_activity['total_data'] == 0) 
			$HTML .= "<tr><td colspan='3'><p style='text-align:center;font-size:14px;'>Data Not Found</p></td></tr>";

			foreach($data_activity as $key => $value){
				
				if(is_numeric($key))
				$HTML .= $this->HTML_themplate1($value);

			}

			return [
				"list_data" => $HTML
			];
		}

		// --------------------------------------------------------------------

	    /**
	     * Generate html themplate for activity list
	     *
	     * @return string
	     */

		protected function HTML_themplate1($object){

			$object["display"] = ($object['display'] == 0) ? 
			"<span class=\"red-breadcum\" >Hide</span>" : null;

			$object["start_date"] = date("M d, Y H:i", $object["start_date"]);

			$object["end_date"] = date("M d, Y H:i", $object["end_date"]);

			return $this->view("activity/html_part/list",$object, false);

		}

	// --------------------------------------------------------------------

    /**
     * Generate list course data
     *
     * @return array
     */

	protected function list_courses(){

		$data_courses = API_access("data_select".$this->search_paramater(1)."&name=data_attempt&sort_by=desc&order_by=id", true, [

			"student_id" => userData()["nim"]

		]);

		$HTML = null;

		if($data_courses["total_data"] == 0) 

		$HTML .= "<tr><td colspan='5'><p style='text-align:center;font-size:14px;'>Data Not Found</p></td></tr>";

		foreach($data_courses as $key => $value){

				if(is_numeric($key)){

					$question = API_access("data_select?name=data_question",true,[
						"id" => $value["quiz_id"]
					])[0];

					if($question["show_grade_result"] == 1){
						
						if(($value["attempt"] == 1) and ($value["status"] == 0))
						$value["grade"] = "Remaining";
						elseif(($value["attempt"] == 1) and ($value["status"] == 1))
						$value["grade"] = $value["grade"]."/100";
						else
						$value["grade"] = null;

					}else{
						$value["grade"] = "Not Display";
					}

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

					$value["course"] = "<p style='font-size:12px;'><i style='color:#666'>".$major["name"]." / ".$course["title"]."</i></p>";

					$value["finish_on"] = date("l, d M Y, H:i A", $value["submit_time"]);

					$value["no"] = $course["kdmk"];

					if($value["status"] == 1) $value["status"] = "Finish";
					elseif(($value["status"] == 0) and $value["attempt"] == 0) $value["status"] = "<span style='color:#ff0000'>On Progress</span>";
					elseif(($value["status"] == 0) and $value["attempt"] == 1) $value["status"] = "Pending";


					$HTML .= $this->HTML_themplate($value);

				}

			

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

		return $this->view("courses/html_part/list_grade", $object, false);

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
			HomeUrl()."/my_grade".$this->search_paramater(2),
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

		$data["page"] = ((int) $this->get("page") == 0) ? 1 : (int) $this->get("page");
		$data["limit"] = ((int) $this->get("limit") == 0) ? 10 : (int) $this->get("limit");

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