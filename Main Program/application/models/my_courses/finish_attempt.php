<?php 

class finish_attempt extends load{

	function __construct(){

		$grade = 0;
		$type = 0;
		$total_question = 0;

		if(isset($_SESSION["attempt_id"])){

			$build["status"] = 1;
				
			$query = API_access("data_select?name=data_answer",true,[
				"cluster_id" => $_SESSION["cluster_data"],
				"student_id" => userData()["nim"]
			]);


			$attempt = API_access("data_select?name=data_attempt",true,[
				"quiz_id" => $_SESSION["quiz_id"],
				"student_id" => userData()["nim"]
			]);


			if(($query["total_data"] > 0) and (isset($attempt[0]["attempt"])) and ($attempt[0]["attempt"] == 0)) {

				foreach($query as $key => $val){

					if(is_numeric($key)){

						$grade += $val["score"];

						if($val["question_type"] == 1) $type = 1;

						if($val["question_type"] == 2){

							$total_question += count(json_decode($val["question"]));

						}else $total_question += 1;

					}

				}

				if($type > 0) $build["status"] = 0;

				$build["attempt"] = 1;
				$build["grade"] = $grade * 100 / $total_question; 
				$build["submit_time"] = time();
				$build["where-quiz_id"] = $_SESSION["quiz_id"];
				$build["where-student_id"] = userData()["nim"];

				API_access("data_update?name=data_attempt", true, $build);

				unset($_SESSION["regulator"]);
				unset($_SESSION["cluster_data"]);
				unset($_SESSION["quiz_id"]);
				unset($_SESSION["attempt_id"]);
				unset($_SESSION["list_id"]);

			}

		}

		header("location:".HomeUrl()."/my_courses/attempt?id=".$this->get("id"));

	}

}