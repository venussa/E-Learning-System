<div class="main-container">
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span>

			<a href="{homeURL}" <?php SPA_attribute()?> >Dashboard</a> / 
			<a href="{homeURL}/activity" <?php SPA_attribute()?> >Activity</a> / 
			<a href="{homeURL}/activity/manage?id={activity_id}" <?php SPA_attribute()?> >{activity_title}</a> / 
			<a href="{homeURL}/activity/manage?id={activity_id}" <?php SPA_attribute()?> >{topic_title}</a> / {title}
			
		</span>
	</div>

	<div class="content" style="background: transparent;border: transparent;">

		<div class="left-box">

			<div class="panel">
				
				<div class="panel-body">
					<table class="list-table">
						<tr>
							<td style="font-family:Segoe UI Bold;font-size:14px;">Name</td>
							<td style="font-family:Segoe UI Bold;font-size:14px;width:100px">Status</td>
							<td style="font-family:Segoe UI Bold;font-size:14px;width: 100px;">Grade</td>
							<td style="font-family:Segoe UI Bold;font-size:14px;width:150px">Finish On</td>
						</tr>
						{list_data}
					</table>
				</div>
			</div>
			

		</div>
		<div class="right-box">
			<div class="panel">
				<div class="panel-heading">
					<img src="{sourceURL}/media/web-icon/users.png">
					<span class="title"> Remaining Participants</span>
				</div>
				<div class="panel-body">
					<?php

						$activity = API_access("data_select?name=data_activity", true, [
							"id" => $this->get("main_id")
						]);

						if($activity["total_data"] > 0){

							$class = str_replace($activity[0]["major"],"{major}",$activity[0]["class"]);

							$user = API_access("data_select?name=data_student", true, [
								"class" => $class,
								"major" => $activity[0]["major"],
								"active_course%" => $activity[0]["course_id"]
							]);

							if($user["total_data"] > 0){

								foreach($user as $key => $val){

									if(is_numeric($key)){

										$query = API_access("data_select?name=data_attempt",true,[
											"quiz_id" => $this->get("id"),
											"student_id" => $val["nim"]
										]);

										if($query["total_data"] == 0){ ?>

<a href="{homeURL}/student/detail?nim=<?php echo $val["nim"]?>" <?php SPA_attribute()?>>												
	<div class="check-box" style="margin-left: 0px;margin-top: 0px;margin-bottom: 5px;">
		
			<img style="position: absolute;" src="{sourceURL}/media/user-picture/<?php echo $val["profile_pict"]?>" width="25"> 
			<p style="margin-left: 35px;color:#09f;margin-top: -5px;">
				<?php echo $val["first_name"]?> <?php echo $val["last_name"]?>		
			</p>
			<p style="margin-left: 35px;color:#666;font-size:10px;margin-top: -15px;margin-bottom: 0px;">
				<?php echo $val["email"]?>		
			</p>
			<p style="margin-left: 35px;color:#666;font-size:10px;margin-top: 0px;margin-bottom: 0px;">
				<b>NIM : </b><?php echo $val["nim"]?>		
			</p>
	</div>
</a>


										<?php $response = true;}

									}

								}

							}

						}

if(!isset($response)){ ?>

	<div class="check-box" style="margin-left: 0px;margin-top: 0px;margin-bottom: 15px;text-align: center;font-family: 'Segoe UI Bold'">

			Not Found
		
	</div>


<?php } ?>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="background-black transparent background-float-box"></div>
<div class="float-box delete-verif" style="display: none;">
	<div class="header">
		<img src="{sourceURL}/media/web-icon/complain-icon.png">
		System Notice
	</div>
	<form class="form-group body" method="POST" action="{homeURL}/activity/save_review?action=delete" redirect="{documentURL}" onSubmit="return submit_form(this)">
		<input type="text" id="float-del-user" name="id[]" style="display: none;">
		<p style="font-size: 14px;">Are you sure you want to delete it?</p>
		<button class="btn-default" type="button" onclick="close_float_box('delete-verif')">Cancel</button>
		<button class="btn click-hide" data="delete-verif">Delete</button>
	</form>
</div>