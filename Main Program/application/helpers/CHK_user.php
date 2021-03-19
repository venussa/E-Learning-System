<?php

if(!function_exists("userData")){
	
	/**
	 * Get User login information
	 *
	 * @param	nim, email
	 * @return	mixed	depends on what the array contains
	 */

	function userData(){

		if(!isset($_SESSION['username'])) return false;

		if($_SESSION['user_type'] == "student")

			$data = array(
				"nim%%" => $_SESSION["username"],
				"email%%" => $_SESSION["username"],
				"account_status" => 1,
				"display" => 1
			);

		else if($_SESSION['user_type'] == "teacher")

			$data = array(
				"nidn%%" => $_SESSION["username"],
				"email%%" => $_SESSION["username"],
				"account_status" => 1,
				"display" => 1
			);

		else return false;

		$query = API_access("data_select?name=data_".$_SESSION['user_type'],true,$data);


		if($query["total_data"] > 0){
			
			if(!isset($query[0]["nim"])) $query[0]["nim"] = null;
			if(!isset($query[0]["nidn"])) $query[0]["nidn"] = null;
			if(!isset($query[0]["level"])) $query[0]["level"] = 0;
			$query[0]["user_type"] = $_SESSION['user_type'];

			if(isset($query[0]["class"]))
			$query[0]["class"] = str_replace("{major}", $query[0]["major"], $query[0]["class"]);
			else $query[0]["class"] = null;

			return $query[0];

		}

		return false;

	}

}

if(!function_exists("check_login")){
	
	/**
	 * Check login status user
	 *
	 * @return	void
	 */

	function check_login(){

		if(splice(1) !== "api")
			if(splice(1) == "account"){
				if(userData() !== false){
					header("location:".HomeUrl());
					exit;
				}

			}elseif(splice(1) !== "account"){
				if(userData() == false){
					session_destroy();
					header("location:".HomeUrl()."/account/login");
					exit;
				}

			}
	}

}

$_SESSION['username'] = $_SESSION['username'];
$_SESSION['user_type'] = $_SESSION['user_type'];