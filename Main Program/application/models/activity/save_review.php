<?php

class save_review extends load{

	function __construct(){

		if(userData()["user_type"] == "teacher"){

			if($this->get("action") == "delete"){

				$quiz = API_access("data_select?name=data_attempt",true,[
					"id" => clean_xss_string($_POST["id"][0])
				]);

				if($quiz["total_data"] > 0){

					$question = API_access("data_select?name=data_question", true, [
						"id" => $quiz[0]["quiz_id"]
					]);

					if($question["total_data"] > 0){

						API_access("data_delete?name=data_attempt",true,[
							"id" => $quiz[0]["id"]
						]);

						API_access("data_delete?name=data_answer",true,[
							"cluster_id" => $quiz[0]["cluster"],
							"student_id" => $quiz[0]["student_id"]
						]);

					}

				}

			}elseif(isset($_POST["id"])){

				foreach ($_POST["id"] as $key => $value) {
					
					API_access("data_update?name=data_answer", true, [
						"score" => ((int) $_POST["score"][$key]),
						"note" => clean_xss_string($_POST["note"][$key],false),
						"where-id" => $value
					]);

				}
				
				$max = 0;
				$get = 0;
				
				$query = API_access("data_select?name=data_answer",true,[
				        "id" => $value    
				    ]);
				    
				$query = API_access("data_select?name=data_answer",true,[
				        "cluster_id" => $query[0]["cluster_id"]    
				    ]);
				
				foreach ($query as $key => $val) {
				    
				    if(is_numeric($key)){
				        
    				    $try = count(json_decode($val["true_answer"]));
    				    
    				    if($try == 0) $try = 1;
    				    
    				    $max += $try;
    				    $get += $val["score"];
    				    
				    }
				       
				}
				

				API_access("data_update?name=data_attempt", true, [
					"grade" => ($get * 100 / $max),
					"status" => 1,
					"where-id" => $_SESSION["attempt_id"]
				]);

			}
		}

	}

}