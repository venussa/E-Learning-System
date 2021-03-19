<div class="main-container">
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span>

			<a href="{homeURL}" <?php SPA_attribute()?> >Dashboard</a> / 
			<a href="{homeURL}/activity" <?php SPA_attribute()?> >Activity</a> / 
			<a href="{homeURL}/activity/manage?id={activity_id}" <?php SPA_attribute()?> >{activity_title}</a> / 
			<a href="{homeURL}/activity/manage?id={activity_id}" <?php SPA_attribute()?> >{topic_title}</a> / 
			<a href="{homeURL}/activity/detail_quiz?main_id={activity_id}&id={[id]}" <?php SPA_attribute()?>>{title}</a> / 
			Review {student_name}
			
		</span>
	</div>

	<div class="content" style="background: transparent;border: transparent;">

		<div class="panel">
			<div class="panel-body" style="padding-top: 5px;padding-bottom: 0px;">
				<p style="color:#696969;font-size: 14px;">{activity_major} | {course_name}</p>
				<p style="font-family:'Segoe UI Bold';font-size: 25px;margin-top: -10px;">{activity_title} | {activity_class}</p>

			</div>

		</div>

		<div class="panel">
			<div class="panel-body">
				<p style="text-align: center;font-family: 'Segoe UI Bold'; font-size: 19px;">{title}</p>

				<div style="padding-top: 10px;padding-bottom: 10px;border:3px #ddd dashed;border-radius: 5px;">

				<p style="text-align: center;">This quiz opened at {start_date}</p>
				<p style="text-align: center;">This quiz will close on {end_date}</p>
				<p style="text-align: center;">Time Limit : {time_limit}</p>	

				<a href="{homeURL}/student/detail?nim={student_id}" <?php SPA_attribute()?> >
				<p style="text-align: center;background: #f9f9f9;width: 98%;margin: auto;padding-top:10px;padding-bottom:10px;"><span style="margin-right: 25px;">Student : </span>
				<img src="{profile_pict}" style="width:20px;height:20px;position: absolute;margin-left:-20px;border-radius: 100%">
				<span style="margin-left:10px;color:#09f">{student_name}</span>
				</p>
				</a>

			</div>

			</div>
		</div>

		<?php 

		$my_id = userData()["nim"];

		$navigation = API_access("data_select?name=data_answer",true,[
			"cluster_id" => $_SESSION["attempt_cluster"],
			"student_id" => $my_id
		]);
		?>
		<div class="left-box" style="width: 59%">

			<form method="POST" action="{homeURL}/activity/save_review" redirect="{documentURL}" onsubmit="return submit_form(this)">

				<?php 

				$number = 1;

				foreach($navigation as $keys => $vals){

					if(is_numeric($keys)){ 

						if($vals["question_type"] == 1) $response = true;

					?>
						
						<div class="panel form-group">
							<div class="panel-heading">
								<img src="{sourceURL}/media/web-icon/paper.png">
								<span class="title">Quiz Number : <?php echo $number?></span>
								
							</div>
							<div class="panel-body" id="number-<?php echo $number?>">

							<?php switch ($vals["question_type"]) {
								case 0:
									require(SERVER."/application/views/courses/html_part/pg1.php");
								break;

								case 1:
									require(SERVER."/application/views/courses/html_part/es1.php");
								break;

								case 2:
									require(SERVER."/application/views/courses/html_part/mc1.php");
								break;

							} ?>
						</div>
					</div>

					<?php
					$number++;}
				}

				if(isset($response)) { ?>

					<div class="panel">
						<div class="panel-body">
							<button class="btn">Save Review</button>
						</div>
					</div>

				<?php }	?>

			</form>
		</div>
		<div class="right-box" style="width: 40%">
			<div class="panel">
				<div class="panel-heading">
					<img src="{sourceURL}/media/web-icon/grade.png">
					<span class="title">Attempt Status</span>
				</div>
			<div class="panel-body">
				<table style="width:100%">
					<tr>
						<td style="padding: 5px;border-bottom: 1px #ddd dashed">Start On</td>
						<td style="padding: 5px;border-bottom: 1px #ddd dashed">{q_start}</td>
					</tr>
					<tr>
						<td style="padding: 5px;border-bottom: 1px #ddd dashed">Status</td>
						<td style="padding: 5px;border-bottom: 1px #ddd dashed">{q_status}</td>
					</tr>
					<tr>
						<td style="padding: 5px;border-bottom: 1px #ddd dashed">Finish On</td>
						<td style="padding: 5px;border-bottom: 1px #ddd dashed">{q_finish}</td>
					</tr>
					<tr>
						<td style="padding: 5px;border-bottom: 1px #ddd dashed">Time Taken</td>
						<td style="padding: 5px;border-bottom: 1px #ddd dashed">{q_time_taken}</td>
					</tr>
					<tr>
						<td style="padding: 5px;">Grade</td>
						<td style="padding: 5px;">{q_grade}</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="panel">
			<div class="panel-heading">
				<img src="{sourceURL}/media/web-icon/mark.png">
				<span class="title">Quiz Navigation</span>
			</div>
			<div class="panel-body">
				<?php 
					
				$i = 1;

				foreach($navigation as $key => $val){

					if(is_numeric($key)){

						$nav = null;

		

						if($val["question_type"] < 2){
							if(($_SESSION["attempt_status"] == 1) and ($val["score"] > 0)) $nav .= "true-answer";
							elseif(($_SESSION["attempt_status"] == 1) and ($val["score"] == 0)) $nav .= "false-answer";
							else $nav .= "normal-answer ";

						}else $nav .= "normal-answer ";

						?>

						<a href="#number-<?php echo ($i)?>" <?php SPA_attribute()?>>
							<div class="page-nav <?php echo $nav?>"><?php echo ($i)?></div>
						</a>

				
				<?php $i++;}}?>
				<p style="float: left;width: 100%">

					<a href="{homeURL}/activity/detail_quiz?main_id={activity_id}&id={[id]}" <?php SPA_attribute()?> style='color:#09f'>
						Back To Quiz Detail
					</a>
				
				</p>
			</div>
		</div>
		</div>

	</div>
</div>