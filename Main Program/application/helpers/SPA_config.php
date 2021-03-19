<?php

if(!function_exists("SPA")){
	
	/**
	 * Single Page Application Javascript configuration
	 *
	 * @param	string
	 * @return	string
	 */

	function SPA(){

		$SPA_data = array(

			"before" => "

				$('.loading').show();	
				
			",
			"success" => "
				tinyMCE();
				$('.loading').hide();
				$('.loading p').hide();
				$('.side-bar-left').css({'height' : ($(window).height() - 80)+'px'});
				$('.new-type').click();

				if($('#time_limit').length)
				$('#time_limit').click();
		
			",
			"error" => "
				$('.loading').hide();
				$('#text-alert').html('Connection Timeout');
				$('.alert-box').show();
			"

		);

		$SPA = pjax_load("SPA", "SPA-container", "SPA-content", $SPA_data); 

		return $SPA;

	}

}

if(!function_exists("SPA_attribute")){
	
	/**
	 * Generate HTML attribut element for SIngle Page Application
	 *
	 * @return	string
	 */

	function SPA_attribute($response = true){

		$result = 'class="'.SPA()->class.'" data-pjax="'.SPA()->data_pjax.'"';

		if($response == false) return $result;

		echo $result;

		

	}

}

if(!function_exists("menu")){
	
	/**
	 * Coloring menu background when the menu is active
	 *
	 * @return	string
	 */

	function menu($data = null){

		if($data == splice(1)) echo "class=\"active\"";

	}

}