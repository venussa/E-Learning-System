<?php

/**
 * update_setting Class
 *
 * updating the latest data about 
 * the majors on university data
 *
 * @category	models
 * @package		models
 * @uses 		controller/setting
 */

	class update_setting extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor
	     *
	     * @return void
	     */

		function __construct(){

			if(userData()["level"] == 0) return false;

			$this->save_data();
			
		}

		// --------------------------------------------------------------------

	    /**
	     * Save Data
	     *
	     * @return void
	     */

		function save_data(){

			$upload = $this->upload_image();

			if($upload == false) return false;

			$join_data = (is_array($upload)) ? array_merge($upload, $_POST) : $_POST;

			foreach ($join_data as $key => $value) {
				
				$value = clean_xss_string($value);

				$data["conf"] = $value;
				$data["where-title"] = $key;

				API_access("data_update?name=data_setting", true, $data);

			}

		}

		// --------------------------------------------------------------------

	    /**
	     * Upload image
	     *
	     * @return mixed
	     */

		function upload_image(){

			$path = SERVER."/sources/media/web-image";

			foreach($_FILES as $key => $value){

				if(!empty($_FILES[$key]['name'])){

					$extention = get_extention($_FILES[$key]['name']);

					$name = time().".".$extention;

					$upload_path = $path."/".$name;

					if($this->verify_extention($extention) == false) return false;

					move_uploaded_file($_FILES[$key]["tmp_name"], $upload_path);

					$build[$key] = $name;

				}

			}

			return (isset($build)) ? $build : true; 

		}

		// --------------------------------------------------------------------

	    /**
	     * Extention check
	     *
	     * @return boolean
	     */

		function verify_extention($data = null){

			$allow = ["jpg","png", "jpeg"];

			if(!in_array(strtolower($data), $allow)) return false;

			return true;

		}

	}