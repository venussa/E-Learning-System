<?php

/**
 * ad_quiz Class
 *
 * Add new quiz
 *
 * @category	models
 * @package		models
 * @uses 		controller/activity
 */


	class add_quiz extends load{

		/**
	    * Initial quiz id
	    *
	    * @var  string
	    */

		var $cluster;

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return mixed
	     */
		function __construct(){

			if(userData()["user_type"] == "student") return false;

			$this->cluster = userData()["nidn"]."-".time();

			if(!empty($this->get("action"))){
				
				if($this->get("action") == "insert")
				$this->insert_question();
				if($this->get("action") == "update")
				$this->update_question();
			}
			else $this->insert_tmp_question();

		}

		// --------------------------------------------------------------------

	    /**
	     * Query Builder for general data of question
	     *
	     * @return array
	     */

		function build_question_query(){

			$start = $_SESSION["general"]["general_start_time"]." ".$_SESSION["general"]["general_start_time_hour"];
			$end = $_SESSION["general"]["general_end_time"]." ".$_SESSION["general"]["general_end_time_hour"];

			if(!isset($_SESSION["general"]["general_hide_quiz"])) 
				$_SESSION["general"]["general_hide_quiz"] = null;

			if(!isset($_SESSION["general"]["general_correct_answer"])) 
				$_SESSION["general"]["general_correct_answer"] = null;

			if(!isset($_SESSION["general"]["general_grade_result"])) 
				$_SESSION["general"]["general_grade_result"] = null;
    
            $start_time = strtotime(clean_xss_string($start));
            $end_time = strtotime(clean_xss_string($end));
            
            if($end_time <= $start_time or $end_time < time()) {
                echo "Incorrect quiz time settings";
                exit;
            }
            
            
			$tb_name = [
				"title" => clean_xss_string($_SESSION["general"]["general_title"]),
				"start_time" => strtotime(clean_xss_string($start)),
				"end_time" => strtotime(clean_xss_string($end)),
				"time_limit" => clean_xss_string($_SESSION["general"]["general_time_limit"]),
				"show_correct_answer" => ((int) clean_xss_string($_SESSION["general"]["general_correct_answer"])),
				"show_grade_result" => ((int) clean_xss_string($_SESSION["general"]["general_grade_result"])),
				"display" => ((int) clean_xss_string($_SESSION["general"]["general_hide_quiz"])),
				"topic_id" => clean_xss_string($this->get("id")),
				"register_date" => time(),
				"cluster" => $this->cluster
			];

			return $tb_name;

		}

		// --------------------------------------------------------------------

	    /**
	     * Query Builder for list_question
	     *
	     * @return array
	     */

		function build_question_list_query($number){

			$number = "number-".$number;

			switch((int) $_SESSION[$number]["answer_type"]){

				case 0:

					$quest = str_replace("'",null,$_SESSION[$number]["multiple_choice_question"]);
					$ans_list = str_replace("'",null,$_SESSION[$number]["multiple_choice"]);
					$true_ans = str_replace("'",null,$_SESSION[$number]["true_answer"]);

				break;

				case 1:

					$quest = str_replace("'",null,$_SESSION[$number]["essay_question"]);
					$ans_list = null;
					$true_ans = null;

				break;

				case 2:

					$quest = str_replace("'",null,$_SESSION[$number]["mc_question"]);
					$ans_list = str_replace("'",null,$_SESSION[$number]["true_answer"]);
					$true_ans = str_replace("'",null,$_SESSION[$number]["true_answer"]);


				break;

			}

			if(!isset($_SESSION[$number]["attach_files"])) 
				$_SESSION[$number]["attach_files"] = null;

			if(!isset($_SESSION[$number]["opportunity_answer"])) 
				$_SESSION[$number]["opportunity_answer"] = null;

			$tb_name = [
				"question" => $quest,
				"question_type" => $_SESSION[$number]["answer_type"],
				"answer" => $ans_list,
				"true_answer" => $true_ans,
				"attach_form" => ((int) $_SESSION[$number]["attach_files"]),
				"chance" => ((int) $_SESSION[$number]["opportunity_answer"]),
				"cluster_id" => $this->cluster
			];

			return $tb_name;
		}

		// --------------------------------------------------------------------

	    /**
	     * Build temporary data
	     *
	     * @return void
	     */

		function insert_tmp_question(){

			$number = (int) clean_xss_string($this->post("number"));

			if($number == 0) $number = 1;

			$number = "number-".$number;

			if(isset($_POST)){
		
				$answer_type = (!isset($_SESSION[$number]["answer_type"]))
				? 0 : $_SESSION[$number]["answer_type"];

				unset($_SESSION[$number]);

				foreach($this->post() as $key => $val){

					if(($key !== "number") and ($val !== ""))

					if(is_array($val)){

						$new_val = null;

						foreach ($val as $k => $v) {
							
							$new_val[] = clean_xss_string(htmlspecialchars($v));

						}

						$_SESSION[$number][$key] = json_encode($new_val);

					}else $_SESSION[$number][$key] = clean_xss_string($val,false);

				}

			}

		}

		// --------------------------------------------------------------------

	    /**
	     * Insert question
	     *
	     * @return mixed
	     */

		function insert_question(){

			$data = $this->build_question_query();

			API_access("data_insert?name=data_question",true, $data);

			unset($_SESSION["general"]);

			$i = 1;
			$last_number = 1;
			while(true){

				if(isset($_SESSION["number-".$i])) $last_number = $i;
				else break;
				$i++;
			} 

			for($i = 1; $i <= $last_number; $i++){

				$data = $this->build_question_list_query($i);

				API_access("data_insert?name=data_question_list",true, $data);

				unset($_SESSION["number-".$i]);

			}

		}

		// --------------------------------------------------------------------

	    /**
	     * Update question
	     *
	     * @return mixed
	     */

		function update_question(){

			$data = $this->build_question_query();
			unset($data["cluster"]);

			$data["where-cluster"] = $_SESSION["EDIT_DATA"];

			API_access("data_update?name=data_question",true, $data);

			unset($_SESSION["general"]);


			$i = 1;
			$last_number = 1;
			while(true){

				if(isset($_SESSION["number-".$i])) $last_number = $i;
				else break;
				$i++;
			} 

			for($i = 1; $i <= $last_number; $i++){

				$data = $this->build_question_list_query($i);
				$backup = $data;

				unset($data['cluster_id']);

				if(isset($_SESSION["edit_list"][$i]))
				$data["where-id"] = $_SESSION["edit_list"][$i];

				$data["where-cluster_id"] = $_SESSION["EDIT_DATA"];
				$backup["cluster_id"] = $_SESSION["EDIT_DATA"];

				if(isset($_SESSION["edit_list"][$i]))
					API_access("data_update?name=data_question_list",true,$data);
					
				else
					API_access("data_insert?name=data_question_list",true,$backup);
                
                
				unset($_SESSION["number-".$i]);
				$build = null;

			}
			
			unset($_SESSION["edit_list"]);

		}

	}