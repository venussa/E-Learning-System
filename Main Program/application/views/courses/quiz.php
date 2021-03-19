<?php 

$data = $this->attempt_quiz();

$page = (int) $this->get("page");

$number = $page;
if($page < 1) $number = 1;

$page = $number;

if($page > $data["total_page"]) $page = $data["total_page"];

?>
<div class="main-container">
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span>

			<a href="{homeURL}" <?php SPA_attribute()?> >Dashboard</a> / 
			<a href="{homeURL}/my_courses" <?php SPA_attribute()?> >My Courses</a> / 
			<a href="{homeURL}/my_courses/detail?id={activity_id}" <?php SPA_attribute()?> >{title0}</a> /
			<a href="{homeURL}/my_courses/detail?id={activity_id}" <?php SPA_attribute()?> >{title1}</a> / {title2}
			
		</span>
	</div>

	<div class="content" style="background: transparent;border: transparent;">

	<form method="POST" id="quiz-form" action="{homeURL}/my_courses/add_data" redirect="{homeURL}/my_courses/quiz?id={[id]}&page=<?php echo ($page+1)?>" onSubmit="return submit_form(this)" enctype="multipart/form-data">


	<div class="left-box">
		<div class="panel form-group">
			<div class="panel-heading">
				<img src="{sourceURL}/media/web-icon/paper.png">
				<span class="title">Quiz Number : <?php echo $number?></span>
				
			</div>
			<div class="panel-body">

				<?php 

				switch ($data["question_type"]) {
					case 0:
						require_once(SERVER."/application/views/courses/html_part/pg.php");
					break;

					case 1:
						require_once(SERVER."/application/views/courses/html_part/es.php");
					break;

					case 2:
						require_once(SERVER."/application/views/courses/html_part/mc.php");
					break;

				}

				?>

				<p style="text-align: right;">

				<?php if($number == $data["total_page"]){ ?>
				<button class="btn next" style="margin-right: 10px;display: none;">Next Number</button>

				<?php }else{ ?>
				<button class="btn next" style="margin-right: 10px;">Next Number</button>

				<?php } ?>

				</p>

			</div>
		</div>
	</div>

	<div class="right-box">

		<div class="panel">
				<p class="panel-heading">
					<img src="{sourceURL}/media/web-icon/role.png">
					<span class="title"> Administration By</span>
				</p>
				<img src="{profile_pict}" style="width: 60px;height:60px;margin-left: 10px;position: absolute;margin-top:4px;">
				<p style="margin-left: 80px;font-family: 'Segoe UI Bold'">{teacher_name}</p>
				<p style="margin-left: 80px;font-size:13px;margin-top:-9px;"><a href="mailto:{teacher_email}">{teacher_email}</a></p>
				<p style="margin-left: 80px;font-size:12px;margin-top:-10px;color:#666;">{teacher_phone}</p>

			</div>

		<div class="panel">
			<div class="panel-heading">
				<img src="{sourceURL}/media/web-icon/mark.png">
				<span class="title">Quiz Navigation</span>
			</div>
			<div class="panel-body">
				<p style="float: left;width: 92%" class="check-box time-limit">
					<img style="position: absolute;margin-top: -3px;" src="{sourceURL}/media/web-icon/stopwatch.png" width="25">
					<span id="time_limit" style="margin-left: 40px;color:#434343" onclick="time_limit('{time_finish}')">-</span>
				</p>
				<?php for($i = 0; $i < $data["total_page"]; $i++){ 

				$question = API_access("data_select?name=data_answer",true, [
					"cluster_id" => $data["cluster"],
					"student_id" => userData()["nim"]
				]);

				$nav = null;

				if((($i + 1) == $page)) $nav .= "border ";
				if(($question[$i]["my_answer"] !== "") and (!strpos(" ".$question[$i]["my_answer"],"data-0"))) $nav .= "normal-answer";

				?>

				<a href="{homeURL}/my_courses/quiz?id={[id]}&page=<?php echo ($i + 1)?>" <?php SPA_attribute()?> onclick="

				$('#quiz-form').attr('redirect','');
				$('#quiz-form').submit();
				">
					<div class="page-nav <?php echo $nav?>"><?php echo ($i + 1)?></div>
				</a>

				
				<?php }?>

				<p class="check-box confirm-box" style="float: left;width: 92%">
	        		<input type="checkbox" onclick="

	        			if($(this).is(':checked')){

							$('.confirm-box').css({

								'border' : '1px #ddd dashed'

							});

						}

	        		"> Check Finish Quiz
				</p>
				<div style="float: left;width: 100%;margin-bottom: 10px;">
					<button class="btn submit-btn" type="button" onclick="

					if($('.confirm-box input').is(':checked') == false){

						$('.confirm-box').css({

							'border' : '2px #ff0000 dashed'

						});

					}else{

						$(this).prop('disabled', true);
						$(this).html('Please Wait ...');
						
						$('#quiz-form').attr('redirect','');

						$('#quiz-form').submit();

						setTimeout(function(){
							move_page('{homeURL}/my_courses/finish_attempt?id={[id]}');
						},1000);
	


						
					}
					">Finish Quiz</button>	
				</div>
				
			</div>
		</div>
	</div>

	</form>

	</div>

</div>