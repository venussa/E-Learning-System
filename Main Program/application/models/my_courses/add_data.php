<?php

class add_data extends load{

	function __construct(){

		if(isset($_SESSION["list_id"])){

			$build = [];

			$query = API_access("data_select?name=data_answer", true, ["id" => $_SESSION["list_id"]]);

			foreach($_POST as $key => $val){

				if(is_array($val)){

					$build["score"] = 0;

					$build[$key] = clean_xss_string(implode(",", $val));

					foreach(json_decode($query[0]["answer"]) as $k => $v){

						$k_data = $k + 1;
						$index = "data-".$k_data;
						
						if($index == $val[$k]) $build["score"] += 1;

					}

				}else{

					$build[$key] = clean_xss_string($val,false);

					if(!empty($query[0]["answer"])){

						foreach(json_decode($query[0]["answer"]) as $k => $v){

							$true_answer = json_decode($query[0]["true_answer"], true);

							if($v == $true_answer[0]){
								
								$true_index = ($k + 1);

								$build["score"] =  0;

								if($true_index == $val) $build["score"] =  1;

							}

						}

					}

				}

			}

			API_access("data_update?name=data_answer",true,array_merge([
				"where-id" => $_SESSION["list_id"]
			],$build));

		}

	}

}