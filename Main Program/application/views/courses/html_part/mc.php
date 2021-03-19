<?php foreach(json_decode($data["question"]) as $key => $val){ ?>

<div class="check-box">
	<p style="float: right;width: 20%;margin-top: -5px;padding-top:5px;">
	<select class="input" name="my_answer[]">
		<option value="data-0">--- Select ---</option>
		<?php foreach(json_decode($data["answer"]) as $k => $v){ 

			$active_index = "data-".($k+1);
			$answer_data = explode(",", $data["my_answer"]);
			
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

<?php } ?>