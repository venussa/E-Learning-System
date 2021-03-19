<?php

/**
 * tmp_upload Class
 *
 * Save temporary upload data of section
 *
 * @category	models
 * @package		models
 * @uses 		controller/activity
 */

class tmp_upload extends load{

	// --------------------------------------------------------------------

    /**
     * Constructor Defauult Access
     *
     * @return string
     */

	function __construct(){

		if(userData()["user_type"] == "student") return false;

		if($this->upload_image() == false){
			echo "Only Zip, Doc, Docx, Ppt, Pptx, Xls, Xlsx, Pdf can be uploaded";
			exit;
		}

	}

	// --------------------------------------------------------------------

    /**
     * Upload image proccess
     * checking extension dan name
     *
     * @return mixed
     */

	function upload_image(){

			$path = SERVER."/sources/repository/".userData()['nidn']."/upload";

			foreach($_FILES as $key => $value){

				if(!empty($_FILES[$key]['name'])){
					
					$split = explode(".",$_FILES[$key]['name']);

					$extention = end($split);

					$title = clean_xss_string($this->post("title"));

					if(empty($title)) $name = $_FILES[$key]['name'];

					else $name = $title.".".$extention;

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
	     * List allowed extention to upload
	     *
	     * @return boolean
	     */

		function verify_extention($data = null){

			$allow = ["zip","doc","docx","ppt","pptx","xls","xlsx","pdf"];

			if(!in_array(strtolower($data), $allow)) return false;

			return true;

		}

}