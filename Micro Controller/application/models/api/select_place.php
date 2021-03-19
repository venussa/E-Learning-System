<?php

/**
 * select_place Class
 *
 * HTML template for selecting a list of 
 * indonesian place as user address data
 *
 * @category	models
 * @package		models
 * @uses 		controller/api
 */
	
	class select_place extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor
	     *
	     * @return JSON
	     */

		function __construct(){

			header_content_type("json");

			$id_provinsi = clean_xss_string($this->get("province"));
			$id_kabupaten = clean_xss_string($this->get("district"));
			$id_kecamatan = clean_xss_string($this->get("village"));
			$id_kodepos = clean_xss_string($this->get("postal_code"));


			// select province
			
			$provinsi = null;

			foreach(provinsi() as $key => $val){

				$provinsi .= (($id_provinsi == $val) or ($id_provinsi == $key)) ? 
					"<option selected>$val</option>" : 
					"<option>$val</option>";

				if(($id_provinsi == $val) or ($id_provinsi == $key)) $id_provinsi = $key;

			}

			// select district

			$kabupaten = null;

			foreach(kabupaten($id_provinsi) as $key => $val){

				$kabupaten .= (($id_kabupaten == $val) or ($id_kabupaten == $key)) ?
					"<option selected>$val</option>" : 
					"<option>$val</option>";

				if(($id_kabupaten == $val) or ($id_kabupaten == $key)) $id_kabupaten = $key;
			
			}

			if(empty($id_kabupaten)) $id_kabupaten = $key;

			// select subdistrict

			$kecamatan = null;

			foreach(kecamatan($id_kabupaten) as $key => $val){

				$kecamatan .= (($id_kecamatan == $val) or ($id_kecamatan == $key)) ?
					"<option selected>$val</option>" : 
					"<option>$val</option>";

				if(($id_kecamatan == $val) or ($id_kecamatan == $key)) $id_kecamatan = $val;

			}

			if(empty($id_kecamatan)) $id_kecamatan = $val;

			// select postal code

			$kodepos = null;
			foreach(kodepos($id_kabupaten, $id_kecamatan) as $key => $val){
				$kodepos .= (($id_kodepos == $val) or ($id_kodepos == $key)) ?
					"<option selected>$val</option>" : 
					"<option>$val</option>";
			}
		

			$html["provinsi"] = '<select onChange="select_palce(this)" class="input" name="province" style="width:93%">'.$provinsi.'</select>';

			$html["kabupaten"] = '<select onChange="select_palce(this)" class="input" name="district" style="width:93%">'.$kabupaten.'</select>';

			$html["kecamatan"] = '<select onChange="select_palce(this)" class="input" name="village" style="width:93%">'.$kecamatan.'</select>';

			$html["kodepos"] = '<select onChange="select_palce(this)" class="input" name="postal_code" style="width:93%">'.$kodepos.'</select>';

			echo json_encode($html);

		}

	}