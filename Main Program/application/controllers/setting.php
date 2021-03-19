<?php

/**
 * Setting class
 *
 * Show general setting of website
 *
 * @category	controller
 * @package		controllers
 * @uses 		models/setting
 */

	class setting extends load{

		// --------------------------------------------------------------------

	    /**
	     * Default Page of HTTP access
	     *
	     * @return string
	     */

		public function home(){
		    
		    if((userData()["level"] == 0)){
		        
    	    	header("location:".HomeUrl()."/profile");
    	        exit;	
		    }

			$this->view(["header","navbar","setting/index","footer"], $this->fetch_setting());

		}

		// --------------------------------------------------------------------

	    /**
	     * General setting data
	     *
	     * @return string
	     */

		protected function fetch_setting(){

			$data_setting = API_access("show_setting");

			foreach ($data_setting as $key => $value) {
					
				if(in_array($key,["logo","favicon","logo_full_color"])) 
				$build[$key] = sourceUrl()."/media/web-image/".$value;

				else $build[$key] = $value;
				
				if($key == "login_status"){

					$build["enable_status"] = ($value == "1") ? "checked" : null;
					$build["disable_status"] = ($value == "0") ? "checked" : null;

				}
				
			}

			return $build;

		}

	}

?>
