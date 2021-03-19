<p><?php echo $vals["question"]?></p>
<p style="font-family: 'Segoe UI Bold';margin-top:10px;margin-bottom: 10px;">Answer :</p>
<div style="width: 99%">
<div style="padding: 10px;width: 96%;border-radius:5px;margin-top:10px;background: #f5f5f5;border:1px #ddd solid;margin-bottom: 10px;"><?php echo $vals["my_answer"]?></div>
</div>


<?php if($vals["attach_form"] == 1){ ?>
<p style="font-family: 'Segoe UI Bold';margin-top:10px;margin-bottom: 15px;padding-top:15px;">Attach File :</p>
<div style="border:3px #ddd dashed;border-radius: 5px;margin-top: 10px;padding: 10px;width: 94%">
<span id="attach-list">
	<?php
	$file = explode("/", $vals["file_list"]);
	foreach($file as $key => $val){

		if(!empty($val)){ 

		$attach = true;
		$ext = explode(".", $val);
		$ext = end($ext);

		?>

		<?php if(userData()["user_type"] == "teacher"){ ?>
		<a href="{sourceURL}/repository/<?php echo userData()["nidn"]?>/participant_upload/<?php echo $val?>" target="_blank">
		<?php } ?>


			<p class="check-box" style="margin-left: 0px;">
				<img style="position: absolute;margin-top: -5px;" src="{sourceURL}/media/web-icon/<?php echo $ext?>.png" width="25"> <span style="margin-left: 30px;color:#434343"><?php echo $val?></span>
			</p>

		<?php if(userData()["user_type"] == "teacher"){ ?>
		</a>
		<?php } ?>

		<?php }

	}

	if(!isset($attach)){ ?>

		<p style="text-align: center;font-family: 'Segoe UI Bold'">Not Found</p>

	<?php } 
	?>
</span>
</div>
<?php }

if(userData()["user_type"] == "teacher"){

if($_SESSION["attempt_status"] == 1){
	$check1 = ($vals["score"] > 0) ? "checked" : null;
	$check2 = ($vals["score"] == 0) ? "checked" : null;

	if($vals["score"] > 0){
		$bg1 = "true-answer";
		$bg2 = null;
	}else{
		$bg1 = null;
		$bg2 = "false-answer";
	}

	$require = null;
}else{
	$check1 = null;
	$check2 = null;
	$bg1 = null;
	$bg2 = null;
	$bg = false;
	$require = "required";
}
?>
<p style="font-family: 'Segoe UI Bold';margin-top:10px;margin-bottom: 10px;">Result :</p>
<p class="<?php echo $bg1?> check-box confirm-box" style="width: 95%">
	<input name="id[]" value="<?php echo $vals["id"]?>" style="display: none">
	<input type="checkbox" <?php echo $check1?> name="score[]" class="checkbox-<?php echo $vals["id"]?>" target=".checkbox-<?php echo $vals["id"]?>" value="1" onclick="
	checkbox(this);
	if($(this).is(':checked')){
		$('.checkbox-<?php echo $vals["id"]?>').removeAttr('required');
	}

	" <?php echo $require ?>> True
</p>

<p class="<?php echo $bg2?> check-box confirm-box" style="width: 95%">
	<input type="checkbox" <?php echo $check2?> name="score[]" class="checkbox-<?php echo $vals["id"]?>" target=".checkbox-<?php echo $vals["id"]?>"  value="0" onclick="
	checkbox(this);
	if($(this).is(':checked')){
		$('.checkbox-<?php echo $vals["id"]?>').removeAttr('required');
	}
	" <?php echo $require ?>> False
</p>

<p style="font-family: 'Segoe UI Bold';margin-top:10px;margin-bottom: 10px;">Note :</p>
<div style="width: 98.5%">
<textarea class="textarea" name="note[]"><?php echo $vals["note"]?></textarea>
</div>

<?php } 

if($vals["score"] > 0){
	$bg = "true-answer";
	$msg = "Your answer is correct !";
}else{
	$bg = "false-answer";
	$msg = "Your answer is wrong !";
}

if($_SESSION["attempt_status"] == 1){ 

if(!empty($vals["note"]) and (userData()["user_type"] == "student") ){ ?>
<div style="padding: 10px;width: 96%;border-radius:5px;margin-top:10px;background: #f5f5f5;border:1px #ddd solid;margin-bottom: 10px;"><b>Note</b> : <?php echo $vals["note"]?></div>
<?php }

if(
	(($_SESSION["show_correct_answer"] == 1) and (userData()["user_type"] == "student"))
) { ?>
<div class="<?php echo $bg?>" style="padding: 10px;width: 96%;border-radius:5px;margin-top:10px;border:1px #ddd solid;"><?php echo $msg?></div>
<?php }} ?>
