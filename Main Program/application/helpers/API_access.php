<?php

use application\config\dbconfig;

if(!function_exists("API_access")){
	
	/**
	 * Get API Resource
	 *
	 * Doing Curl Data From Other SOurce
	 *
	 * @uses 	CurlSetON
	 * @param	string
	 * @param	boolean
	 * @param	array
	 * @return	mixed	depends on what the array contains
	 */

	function API_access($api_func = null, $response = false, $post = []){

		if(!empty($api_func)){

			$api_url = (new dbconfig)->information()->APIurl;

			$post["token"] = (new dbconfig)->information()->APItoken;

			$post["domain"] = domain();

			$data = Curl($api_url."/api/".$api_func, $post);

			return json_decode($data, $response);

		}

		return false;

	}

}