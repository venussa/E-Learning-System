<?php

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

			$post["token"] = (isset($_POST["token"])) ? $_POST["token"] : null;

			$post["domain"] = (isset($_POST["domain"])) ? $_POST["domain"] : null;

			$data = Curl(HomeUrl()."/api/".$api_func, $post);

			return json_decode($data, $response);

		}

		return false;

	}

}