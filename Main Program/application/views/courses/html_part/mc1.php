<?php foreach(json_decode($vals["question"]) as $key => $val){ 

	$bg = "false-answer";
	$true_list = null;
	$my_answer = explode(",",$vals["my_answer"]);
	$true_answer = json_decode($vals["answer"],true);



	if($my_answer[$key] == "data-".($key+1)){

		$the_answer = null;
		$bg = "true-answer";

	}else $the_answer = $true_answer[$key];



	

	

?>

<div class="check-box <?php echo (($_SESSION["show_correct_answer"] == 1) or (userData()["user_type"] == "teacher")) ? $bg : null;?>">
	<p style="float: right;width: 20%;margin-top: -5px;padding-top:5px;">
	<select class="input" disabled>
		<option value="data-0">--- Select ---</option>
		<?php foreach(json_decode($vals["answer"]) as $k => $v){ 

			$active_index = "data-".($k+1);
			$answer_data = explode(",", $vals["my_answer"]);
			
			if(isset($answer_data[$key])){
				if($active_index == $answer_data[$key]) $selected = "selected";
				else $selected = null;
			}else $selected = null;

		
			$mc[] = '<option value="data-'.($k+ 1).'" '.$selected.'>'.$v.'</option>';	

		 }

		 shuffle($mc);

		 echo implode(null, $mc);

		 $mc = null;


	 	 ?>
	</select>
	</p>
	<p style="width: 70%;margin-top: 10px;margin-top: 3px"><?php echo $val?><br><span style="color: transparent;">.</span></p>
	
</div>

<?php if(!empty($the_answer) and (($_SESSION["show_correct_answer"] == 1) or (userData()["user_type"] == "teacher"))) { ?>
<p style="padding: 5px;border:1px #ddd dashed;width: 96%"><b>The Correct Answer</b> : <?php echo $the_answer?></p>
<?php } ?>

<?php } ?>