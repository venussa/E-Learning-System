<?php

/**
 * proccess_login Class
 *
 * Controller for user login
 *
 * @category	controller
 * @package		controllers
 * @uses 		models/account
 */
	
	class proccess_login extends load{
		
		/**
	    * Initial data username
	    *
	    * @var  string
	    */
		var $username;

		/**
	    * Initial data password
	    *
	    * @var  string
	    */
		var $password;

		/**
	    * Initial data captcha
	    *
	    * @var  string
	    */
		var $captcha;

		/**
	    * Initial data user type
	    *
	    * @var  string
	    */
		var $user_type;

		/**
	    * saving temporary data
	    *
	    * @var  array
	    */
		var $tmp_data;

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return string
	     */

		function __construct(){
		
			$this->anti_spm();

			$this->username = clean_xss_string($this->post("username"));
			$this->password = md5(clean_xss_string($this->post("password")));
			$this->captcha = clean_xss_string($this->post("captcha"));
			$this->user_type = null;

			$this->login_verification();

		}

		// --------------------------------------------------------------------

	    /**
	     * Data validator
	     *
	     * @return string
	     */

		function login_verification(){

			foreach($this->post() as $key => $val)
				if(empty(clean_xss_string($val))){
					echo "Please complete all fields";
					exit;
				}

			if($this->check_data_captcha() == false){
				echo "Invalid captcha";
				exit;
			}
		
			if($this->check_data_username() == false){
				echo "Username not registered";
				exit;
			}

			if($this->check_data_password() == false){
				echo "Invalid Password";
				exit;
			}

			$_SESSION['username'] = (isset($this->tmp_data['nidn'])) ? 
			$this->tmp_data['nidn'] : $this->tmp_data['nim'];

			$_SESSION['user_type'] = $this->user_type;

			$this->login_time();

		}

		// --------------------------------------------------------------------

	    /**
	     * Set login time
	     *
	     * @return void
	     */

		function login_time(){

			if($_SESSION['user_type'] == "student") 
				$query["where%%nim"] = $_SESSION['username'];
			else
				$query["where%%nidn"] = $_SESSION['username'];
			$query["online"] = time();
            
			API_access("data_update?name=data_".$_SESSION['user_type'],true,$query);

		}

		// --------------------------------------------------------------------

	    /**
	     * check student exist
	     *
	     * @return boolean
	     */

		function check_data_student(){

			$query = API_access("data_select?name=data_student",true,[

				"nim%%" => ((int) $this->username),
				"email%%" => $this->username,
				"account_status" => 1

			]);

			if($query["total_data"] > 0){

				$this->user_type = "student";
				$this->tmp_data = $query[0];
				return true;
			}

			return false;

		}

		// --------------------------------------------------------------------

	    /**
	     * check teacher exist
	     *
	     * @return boolean
	     */

		function check_data_teacher(){

			$query = API_access("data_select?name=data_teacher",true,[

				"nidn%%" => ((int) $this->username),
				"email%%" => $this->username,
				"account_status" => 1

			]);

			if($query["total_data"] > 0){

				$this->user_type = "teacher";
				$this->tmp_data = $query[0];
				return true;
			}

			return false;

		}

		// --------------------------------------------------------------------

	    /**
	     * Combine User Checking
	     *
	     * @return boolean
	     */

		function check_data_username(){

			if($this->check_data_student()) return true;

			if($this->check_data_teacher()) return true;

			return false;

		}

		// --------------------------------------------------------------------

	    /**
	     * check password
	     *
	     * @return boolean
	     */

		function check_data_password(){

			if($this->password !== $this->tmp_data['password']) return false;

			return true;

		}

		// --------------------------------------------------------------------

	    /**
	     * check captcha
	     *
	     * @return boolean
	     */

		function check_data_captcha(){

			if($this->captcha !== base64_decode($this->get("cookie"))) return false;

			return true;

		}

		// --------------------------------------------------------------------

	    /**
	     * Set Login repeat
	     *
	     * @return mixed
	     */

		function anti_spm(){

			if(!isset($_SESSION['log_count'])) $_SESSION['log_count'] = 0;

			$_SESSION['log_count'] += 1;


			if($_SESSION['log_count'] == 3) {

				$_SESSION['timeout'] = time();
				echo "try again in a few moments";
				exit;
			}

			if(isset($_SESSION['timeout'])){
				if((time() - $_SESSION['timeout']) < 60){
					echo "try again in a few moments";
					exit;
				}else{
					unset($_SESSION['timeout']);
					$_SESSION['log_count'] = 0;
				}
			}
		}

	}