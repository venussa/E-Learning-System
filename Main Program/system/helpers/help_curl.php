<?php

use system\library\curlseton;

if(!function_exists("Curl")){

	/**
	 * Curl Set On
	 *
	 * Doing Curl Data From Other SOurce
	 * allowed Empty for secod paramater
	 *
	 * @uses 	CurlSetON
	 * @param	string
	 * @param	array
	 * @param	mixed
	 * @return	mixed	depends on what the array contains
	 */

	function Curl($url = false , array $data = array()){

		if($url !== false){

			$build[CURLOPT_POST] = 1;
			$build[CURLOPT_POSTFIELDS] = http_build_query($data, '', '&');

			return new curlseton($url,$build);
			
		}
	}

}
