<?php

/**
 * add_data Class
 *
 * Add new student
 *
 * @category	models
 * @package		models
 * @uses 		controller/student
 */
	
	class add_data extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return string
	     */

		function __construct(){

			if(userData()["level"] == 0) return false;

			$this->save_data();
			
		}

		// --------------------------------------------------------------------

	    /**
	     * Save data to database
	     *
	     * @return string
	     */

		function save_data(){

			$upload = $this->upload_image();

			if($upload == false) {

				echo "Only images in the format jpg, png and jpeg can be uploaded";
				exit;
			}

			$join_data = (is_array($upload)) ? array_merge($upload, $_POST) : $_POST;

			foreach ($join_data as $key => $value) {

				if($key == "nim"){

					if($this->check_nim($value) == false){

						echo "Identity number already used";
						exit;

					}

					$build[$key] = clean_xss_string($value);

				}elseif($key == "birth_day"){

					$build[$key] = strtotime(clean_xss_string($value));

				}elseif($key == "password"){

					if(strlen($value[0]) > 8){

						if($value[0] == $value[1]){

							$build[$key] = md5(clean_xss_string($value[0]));

						}else{

							echo "Password do not match";
							exit;
						}

					}else{
						echo "Password must be more than 8 characters";
						exit;
					}


				}elseif($key == "email"){

					if($this->check_email($value) == false){

						echo "email is already in use";
						exit;

					}

					$build[$key] = clean_xss_string($value);


				}else if($key == "class") {

						$c_patern0 = strip_tags(str_replace("'",null,ltrim($value[0], ',')));
						$c_patern1 = strip_tags(str_replace("'",null,ltrim($value[1], ',')));
						$build[$key] = $c_patern0."{major}".$c_patern1;

				}else if($key == "active_course") {

					if(!empty($value)) $build[$key] = clean_xss_string(ltrim($value, ','));
					else{
						echo "Must teach at least 1 course";
						exit;
					}

				}else{

					$build[$key] = clean_xss_string($value);

				}

				if(($key !== "profile_pict") and ($key !== "account_status"))
					
					if(empty($value) and ($value !== "0")){
						echo "Please complete all data correctly";
						exit;
					}

			}

			$build['online'] = time();
			$build['register_date'] = time();
			$build['display'] = 1;

			API_access("data_insert?name=data_student", true, $build);

			$path = SERVER."/sources/repository/".$build['nim'];
			if(!file_exists($path)){
				mkdir($path);
				mkdir($path."/participant_upload/");
				mkdir($path."/upload/");
				file_put_contents($path."/welcome.txt", "This Is Your Repository");
			}

		}

		// --------------------------------------------------------------------

	    /**
	     * Upload image
	     *
	     * @return mixed
	     */

		function upload_image(){

			$path = SERVER."/sources/media/user-picture";

			foreach($_FILES as $key => $value){

				if(!empty($_FILES[$key]['name'])){

					$finfo = finfo_open(FILEINFO_MIME_TYPE);

					$mime = finfo_file($finfo, $_FILES[$key]['tmp_name']);

					$split = explode("/",$mime);

					$extention = end($split);

					$name = time().".".$extention;

					$upload_path = $path."/".$name;

					if($this->verify_extention($mime) == false) return false;

					move_uploaded_file($_FILES[$key]["tmp_name"], $upload_path);

					$build[$key] = $name;

				}

			}

			return (isset($build)) ? $build : true; 

		}

		// --------------------------------------------------------------------

	    /**
	     * check extention
	     *
	     * @return boolean
	     */

		function verify_extention($data = null){

			$allow = [content_type("jpg"), content_type("png"), content_type("jpeg")];

			if(!in_array(strtolower($data), $allow)) return false;

			return true;

		}

		// --------------------------------------------------------------------

	    /**
	     * Check is nim exist
	     *
	     * @return boolean
	     */

		function check_nim($nim = 0){

			$query = API_access("data_select?name=data_teacher",true, ["nidn" => $nim]);

			if($query["total_data"] > 0) return false;

			$query = API_access("data_select?name=data_student",true, ["nim" => $nim]);
			
			if($query["total_data"] > 0) return false;

			return true;

		}

		// --------------------------------------------------------------------

	    /**
	     * check is email exist
	     *
	     * @return boolean
	     */

		function check_email($email){

			$query = API_access("data_select?name=data_teacher",true, ["email" => $email]);

			if($query["total_data"] > 0) return false;

			$query = API_access("data_select?name=data_student",true, ["email" => $email]);
			
			if($query["total_data"] > 0) return false;

			return true;
		}

	}