<div class="main-container">
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span>
			<a href="{homeURL}" <?php SPA_attribute()?> >Dashboard</a> / 
			<a href="{homeURL}/activity/" <?php SPA_attribute()?> >Activity</a> / 
			<a href="{homeURL}/activity/manage?id={activity_id}" <?php SPA_attribute()?> >{title0}</a> /

			<a href="{homeURL}/activity/manage?id={activity_id}" <?php SPA_attribute()?> >{title}</a> /
			Update Quiz
		</span>
	</div>

	<div class="content" style="background: transparent;border: transparent;">

		<div class="left-box" style="width: 33%">
			<div class="panel form-group">
				<div class="panel-heading" style="font-family: 'Segoe UI Bold';font-size:14px;">General Setting</div>
				<div class="panel-body">

					<p class="lebel-title">Title</p>
					<input type="text" class="input" name="general_title" value="{general_title}" style="width: 92%" onchange="return reload_quiz(this)">

					<p class="lebel-title">Start Time</p>
					<input type="date" name="general_start_time" value="{general_start_time}" class="input" style="width: 55.5%" onchange="return reload_quiz(this)">
					<input type="time" name="general_start_time_hour" value="{general_start_time_hour}" class="input" style="width: 28%" onchange="return reload_quiz(this)">

					<p class="lebel-title">End Time</p>

					<input type="date" name="general_end_time" value="{general_end_time}" class="input" style="width: 55.5%" onchange="return reload_quiz(this)">
					<input type="time" name="general_end_time_hour" value="{general_end_time_hour}" class="input" style="width: 28%" onchange="return reload_quiz(this)">

					<p class="lebel-title">Time Limit <span style="font-size:10px;color:#666;">* In Minutes</span></p>

					<input type="text" name="general_time_limit" value="{general_time_limit}" class="input" style="width: 91%" onchange="
					reload_quiz(this);
					var vals = parseInt($(this).val());
					if(Number.isInteger(vals) == false) $(this).val(0);
					">

					<p class="lebel-title">More Option</p>
					<p class="check-box">
		        		<input type="checkbox" name="general_correct_answer" value="1" {general_correct_answer} onchange="return reload_quiz(this)"> Show The Correct Answer 
					</p>
					<p class="check-box">
		        		<input type="checkbox" name="general_grade_result" value="1" {general_grade_result} onchange="return reload_quiz(this)"> Show Grade Result
					</p>

					<p class="check-box">
		        		<input type="checkbox" name="general_hide_quiz" value="1" {general_hide_quiz} onchange="return reload_quiz(this)"> Hide Quiz
					</p>
				</div>
			</div>

			<div class="panel">
				<div class="panel-body">
					<p class="check-box cq">
		        		<input type="checkbox" id="confirm" onclick="
		        		if($(this).is(':checked')){
							$('.cq').css({
								'border' : '1px #ddd dashed'
							});

							var redirect = $('.myform').attr('redirect');

							$('.myform').attr('redirect','');
							$('.myform').submit();

							setTimeout(function(){
								$('.myform').attr('redirect',redirect);
							},500);
							
						}
		        		"> Confirm to Save & Finish
					</p>
					<button class="btn" type="button" style="width: 100%;margin-left: 0px;width: 97%" onclick="

						if($('#confirm').is(':checked')){
							$(this).html('Please Wait...');
							$('.btn-submit').click();
						}else{
							$('.cq').css({
								'border' : '2px #ff0000 dashed'
							});
						}
						

					">Save & Finish</button>

					<button class="btn btn-default" onClick="delete_teacher('{[cluster]}')" style="margin-left: 0px;width: 97%">Delete Quiz</button>
					
					<a style='font-size:13px;' href="{homeURL}/activity/export_quiz?cluster={[cluster]}" target="_blank">Export Quiz</a>

				</div>

				
			</div>
		</div>

		<?php if(empty(clean_xss_string($this->get("number")))) $number = 1;
		else $number = clean_xss_string($this->get("number")); 

		$next_page = $number + 1;
		?>
		
		<div  class="right-box" style="width:65%;">

			<form class="form-group body myform" method="POST" action="{homeURL}/activity/add_quiz?id={[id]}" redirect="{homeURL}/activity/update_quiz?id={[id]}&cluster={[cluster]}&number=<?php echo $next_page?>" onSubmit="return submit_form(this)">

			<div class="panel form-group">
				<div class="panel-heading" style="font-family: 'Segoe UI Bold';font-size:14px;">Number <?php echo $number?>

				
					<span style="float: right;margin-top:-8px;">
					Jump Number : <select class="input" style="width: 60px;padding: 3px;" onchange="

						move_page('{homeURL}/activity/update_quiz?id={[id]}&cluster={[cluster]}&number='+$(this).val());

					">
						<?php 

						$i = 1;
						$last_number = 1;
						while(true){

							if(isset($_SESSION["number-".$i])) $last_number = $i;
							else break;
							$i++;

						} 

						if($number > $last_number) $last_number = $number;

						for($i = 1; $i <= $last_number; $i++){ 
							if($number == $i){?>
							<option selected><?php echo $i ?></option>
						<?php }else{ ?>
							<option><?php echo $i ?></option>
						<?php }} ?>
					</select>
				
					</span>

					<input type="text" name="number" value="<?php echo $number?>" style="display: none;">

				</div>

				<script>
					$(document).ready(function(){$('.new-type').click()});
				</script>
				<div class="panel-body">
					<span class="new-type" onclick="$('input[name=\'answer_type\'][value=\'{answer_type}\']').click();"></span>
					<p class="lebel-title">Question Type</p>
					<p class="check-box">
						<input type="checkbox" name="answer_type" value="0" class="checkbox1" target=".checkbox1" {question_type0} onclick="
						checkbox(this);
						$('.section').hide();
						$('#type-'+$(this).val()).show();
						$('.section input').prop('disabled',true);
						$('.section textarea').prop('disabled',true);
						$('#type-'+$(this).val()+' input').prop('disabled',false);
						$('#type-'+$(this).val()+' textarea').prop('disabled',false);
						"> Multiple Choice
					</p>
					<p class="check-box">
						<input type="checkbox" name="answer_type" value="1" class="checkbox1" target=".checkbox1" {question_type1} onclick="
						checkbox(this);
						$('.section').hide();
						$('#type-'+$(this).val()).show();
						$('.section input').prop('disabled',true);
						$('.section textarea').prop('disabled',true);
						$('#type-'+$(this).val()+' input').prop('disabled',false);
						$('#type-'+$(this).val()+' textarea').prop('disabled',false);
						"> Essay
					</p>
					<p class="check-box">
						<input type="checkbox" name="answer_type" value="2" class="checkbox1" target=".checkbox1" {question_type2} onclick="
						checkbox(this);
						$('.section').hide();
						$('#type-'+$(this).val()).show();
						$('.section input').prop('disabled',true);
						$('.section textarea').prop('disabled',true);
						$('#type-'+$(this).val()+' input').prop('disabled',false);
						$('#type-'+$(this).val()+' textarea').prop('disabled',false);
						"> Match Choice
					</p>


					<span class="section" id="type-0" style="display: none;"><?php require_once(SERVER."/application/views/activity/form_multiple_choice.php")?>
						<p style="color:#666;font-size:10px;">* Make sure the questions and answers are filled in correctly</p>
						<p style="border-top:1px #ddd dashed;margin-top:10px;padding-top:10px">
						<button class="btn btn-submit" type="button" style="margin-left:0px;display: none;"
						action="{homeURL}/activity/add_quiz?id={[id]}&action=update" redirect="{homeURL}/activity/manage?id={activity_id}" form="false" onclick="return submit_form(this)"
						>Save & Finish</button>
						<button class="btn-cancel" style="margin-left:0px;"> Next Number</button>
						</p>	
					</span>				

					<span class="section" id="type-1" style="display: none;"><?php require_once(SERVER."/application/views/activity/form_essay.php") ?>
						<p style="color:#666;font-size:10px;">* Make sure the questions and answers are filled in correctly</p>
						<p style="border-top:1px #ddd dashed;margin-top:10px;padding-top:10px">
						<button class="btn" type="button" style="margin-left:0px;display: none;"
						action="{homeURL}/activity/add_quiz?id={[id]}&action=update" redirect="{homeURL}/activity/manage?id={activity_id}" form="false" onclick="return submit_form(this)"
						>Save & Finish</button>
						<button class="btn-cancel" style="margin-left:0px;"> Next Number</button>
						</p>	
					</span>	

					<span class="section" id="type-2" style="display: none;"><?php require_once(SERVER."/application/views/activity/form_match_choice.php") ?>
						<p style="color:#666;font-size:10px;">* Make sure the questions and answers are filled in correctly</p>
						<p style="border-top:1px #ddd dashed;margin-top:10px;padding-top:10px">
						<button class="btn" type="button" style="margin-left:0px;display: none;"
						action="{homeURL}/activity/add_quiz?id={[id]}&action=update" redirect="{homeURL}/activity/manage?id={activity_id}" form="false" onclick="return submit_form(this)"
						>Save & Finish</button>
						<button class="btn-cancel" style="margin-left:0px;"> Next Number</button>
						</p>	
					</span>		

					<span id="move-to"></span>

				</div>
			</div>

			</form>
		</div>
	
	</div>
</div>

<div class="background-black transparent background-float-box"></div>
<div class="float-box delete-verif" style="display: none;">
	<div class="header">
		<img src="{sourceURL}/media/web-icon/complain-icon.png">
		System Notice
	</div>
	<form class="form-group body" method="POST" action="{homeURL}/activity/action?del_quiz=true" redirect="{homeURL}/activity/manage?id={activity_id}" onSubmit="return submit_form(this)">
		<input type="text" id="float-del-user" name="id[]" style="display: none;">
		<p style="font-size: 14px;">Are you sure you want to delete it?</p>
		<button class="btn-default" type="button" onclick="close_float_box('delete-verif')">Cancel</button>
		<button class="btn click-hide" data="delete-verif">Delete</button>
	</form>
</div>