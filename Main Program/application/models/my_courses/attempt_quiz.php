<?php

class attempt_quiz extends load{

	function __construct(){

		$quiz = API_access("data_select?name=data_question", true, [

			"id" => $this->get("id")

		]);

		if($quiz["total_data"] > 0){

			$topic = API_access("data_select?name=data_topic", true, [

				"id" => $quiz[0]["topic_id"]

			]);

			if($topic["total_data"] > 0){

				$activity = API_access("data_select?name=data_activity", true, [

					"id" => $topic[0]["activity_id"],
					"class" => userData()["class"]

				]);

				if($activity["total_data"] > 0){

					$query = API_access("data_select?name=data_attempt",true, [

						"student_id" => userData()["nim"],
						"quiz_id" => $quiz[0]["id"]

					]);

					if($query["total_data"] == 0){

						$now = time();

						if($quiz[0]["time_limit"] > 0)
						$end = $now + ($quiz[0]["time_limit"] * 60);
						else{

							$end = $quiz[0]["end_time"] - $now;

							$end = $now + $end;

						}

						API_access("data_insert?name=data_attempt", true, [
							"student_id" => userData()["nim"],
							"quiz_id" => $quiz[0]["id"],
							"status" => 0,
							"start_date" => time(),
							"finish_date" => $end

						]);

						$list = API_access("data_select?name=data_question_list", true,[

							"cluster_id" => $quiz[0]["cluster"]

						]);

						foreach($list as $key => $val){

							if(is_numeric($key)){

								$random[] = [

									"question" => $val["question"],
									"question_type" => $val["question_type"],
									"answer" => $val["answer"],
									"true_answer" => $val["true_answer"],
									"attach_form" => $val["attach_form"],
									"chance" => $val["chance"],
									"cluster_id" => $val["cluster_id"],
									"student_id" => userData()["nim"],
									"note" => "",
									"status" => 0


								];
								
								
							}

						}

						shuffle($random);

						foreach($random as $ey => $val){
							API_access("data_insert?name=data_answer", true, $val);
						}

					}

				}

			}

		}
	}

}