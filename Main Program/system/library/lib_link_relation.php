<?php

namespace system\library;

use application\config\document;

 /**
 * link_relation Class
 *
 * rewire dir : application\views
 * for include some file from thasts path
 *
 * @package		system
 * @subpackage	library
 * @category	data transmision
 */

class link_relation{

	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * Set a new virtual path and rewrite path from /application/views/*
	 *
	 * @return	mixed
	 */

	public function __construct(){

		$this->rewriteDocument();

	}

	// --------------------------------------------------------------------

	/**
	 * get File name
	 *
	 * Get the original name from uri
	 *
	 * @return	string
	 */

	private function file_name(){

		return get_file_name(documenturl());

	}

	// --------------------------------------------------------------------

	/**
	 * Read File
	 *
	 * Scan and detection if file found or not found 
	 * if found, this function wiil be read the file target
	 *
	 * @return	bool
	 */

	private function defined_realpath($action = false){

		if(file_exists(DirSeparator(SERVER."/sources/".splice()))) {

			if($action == true){

				return true;

			}else{
					
				return read_file(SERVER."/sources/".splice());

			}

		}else{

			return false;

		}

	}

	// --------------------------------------------------------------------

	/**
	 * rewrite path of file
	 *
	 * By scanning the content-typr of file
	 *
	 * @return	void
	 */

	private function rewriteDocument(){

		$data = (new document)->content_type();

		$extention = get_extention($this->file_name());

		if($extention !== "php" and self::defined_realpath(true) and !empty($this->file_name()) and isset($data->$extention) ){

			$data = $data->$extention;

				if(is_array($data)){

					header("Content-type:".$data[0]);

				}else{
								
					header("Content-type:".$data);

				}

			echo self::defined_realpath();

			exit;	
		}	
	}
}