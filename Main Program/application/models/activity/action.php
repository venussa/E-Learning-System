<?php

/**
 * action Class
 *
 * Activiti action
 *
 * @category	models
 * @package		models
 * @uses 		controller/activity
 */
	
	class action extends load{

		// --------------------------------------------------------------------

	    /**
	     * Constructor Defauult Access
	     *
	     * @return mixed
	     */

		function __construct(){

			if(userData()["user_type"] == "student") return false;

			if(strpos(" ".clean_xss_string($this->post("id")[0]), "section")) {

				$this->delete_section();
				exit;
			}

			if(!empty(clean_xss_string($this->get("del_quiz")))){

				$this->delete_quiz();
				exit;
			}

			if(is_array($this->post("id")))
			switch($this->post("type")){

				case 1: $this->show(); break;
				case 2: $this->hide(); break;
				case 3: $this->delete(); break;
				case 4: return false; break;
				default: $this->delete(); break;

			}

		}

		// --------------------------------------------------------------------

	    /**
	     * Delete action
	     *
	     * @return void
	     */

		function delete(){

			foreach($_POST['id'] as $key => $value)

				API_access("data_delete?name=data_activity",true,["id" => $value]);

		}
		// --------------------------------------------------------------------

	    /**
	     * Hide activity
	     *
	     * @return void
	     */

		function hide(){

			foreach($_POST['id'] as $key => $value)

				API_access("data_update?name=data_activity", true, ["display" => 0, "where-id" => $value]);

		}

		// --------------------------------------------------------------------

	    /**
	     * Unide activity
	     *
	     * @return void
	     */

		function show(){

			foreach($_POST['id'] as $key => $value)

				API_access("data_update?name=data_activity", true, ["display" => 1, "where-id" => $value]);

		}

		// --------------------------------------------------------------------

	    /**
	     * Delete section
	     *
	     * @return void
	     */

		function delete_section(){

			foreach($_POST['id'] as $key => $value){

				$value = str_replace("-section", null, $value);

				API_access("data_delete?name=data_topic",true,["id" => $value]);

			}

		}

		// --------------------------------------------------------------------

	    /**
	     * Delete quiz
	     *
	     * @return void
	     */

		function delete_quiz(){

			foreach($_POST['id'] as $key => $value){

				$query = API_access("data_select?name=data_question",true,["id" => $value]);

				$show = $query[0];

				if($query["total_data"] > 0){

					API_access("data_delete?name=data_question",true,["id" => $show['id']]);
					API_access("data_delete?name=data_question_list",true,["cluster_id" => $show['cluster']]);
				}

			}

		}

	}