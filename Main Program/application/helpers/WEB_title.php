<?php

if(!function_exists("WEB_title")){
	
	/**
	 * Generate WEB Title
	 *
	 * @return	string
	 */

	function WEB_title($data = null){

		if(!empty($data)) $data = $data;
		else {

			$data[1] = splice(1);
			$data[2] = splice(2);
			$data[3] = splice(3);
			$data[4] = splice(4);

		}

		switch($data[1]){

			case "my_grade":

				$title = "My Grade";

			break;

			case "my_courses":

				if($data[2] == "detail") $title = "My Courses / {title}";
				elseif($data[2] == "attempt") $title = "My Courses / {activity_title} / {topic_title} / {title}";
				elseif($data[2] == "quiz") $title = "My Courses / {title0} / {title1} / {title2}";

				else $title = "My Course";

			break;

			case "teacher":

				if($data[2] == "add") $title = "Teacher / Add New Teacher";
				elseif($data[2] == "detail") $title = "Teacher / {first_name} {last_name}";
				elseif($data[2] == "edit") $title = "Teacher / {first_name} {last_name} / Edit";
				else $title = "Teacher Management";
			break;

			case "profile":
				if($data[2] == "preference") $title = "{first_name} {last_name} / Edit";
				else $title = "{first_name} {last_name}";
			break;

			case "courses":

				if($data[2] == "add") $title = "Courses / Add New";
				elseif($data[2] == "edit") $title = "Courses / {title} / Edit Courses";
				else $title = "Courses Management";
			break;

			case "student":
				if($data[2] == "add") $title = "Student / Add New Student";
				elseif($data[2] == "detail") $title = "Student / {first_name} {last_name}";
				elseif($data[2] == "edit") $title = "Student / {first_name} {last_name} / Edit";
				else $title = "Student Management";
			break;

			case "setting":
				$title = "Site Settings";
			break;

			case "faculty":
				$title = "University Study Division";
			break;

			case "account":

				if($data[2] == "login")
				$title = "Welcome To E-learning";

				if($data[2] == "forgot")
				$title = "Forgot Password";

				if($data[2] == "register")
				$title = "Register New Account";

				if($data[2] == "reset")
				$title = "Reset Password";
			break;

			case "activity":

				if($data[2] == "manage")
				$title = "Activity / {title}";

				elseif($data[2] == "add")
				$title = "Activity / New Activity";
				
				elseif($data[2] == "edit")
				$title = "Activity / {title} / Edit";

				elseif($data[2] == "new_section")
				$title = "Activity / New Section";

				elseif($data[2] == "update_section")
				$title = "Activity / {title0} / {title} / Update";

				elseif($data[2] == "new_quiz")
				$title = "Activity / {title0} / {title} / Add New Quiz";

				elseif($data[2] == "update_quiz")
				$title = "Activity / {title0} / {title} / Edit Quiz";

				else
				$title = "Activity Management";

			break;

			default:
				$title = "Dashboard";
			break;

		}

		return $title;

	}

}