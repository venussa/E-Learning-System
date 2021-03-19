<p><?php echo $data["question"]?></p>
<p style="font-family: 'Segoe UI Bold';margin-top:10px;margin-bottom: 10px;">Answer :</p>
<div style="width: 99%">
<textarea class="textarea" name="my_answer" style="height: 250px;"><?php echo $data["my_answer"]?></textarea>
</div>


<?php if($data["attach_form"] == 1){ ?>
<p style="font-family: 'Segoe UI Bold';margin-top:10px;margin-bottom: 15px;padding-top:15px;">Attach File :</p>
<div style="border:3px #ddd dashed;border-radius: 5px;margin-top: 10px;padding: 10px;width: 94%">
<span id="attach-list">
	<?php
	$file = explode("/", $data["file_list"]);
	foreach($file as $key => $val){

		if(!empty($val)){ 

		$ext = explode(".", $val);
		$ext = end($ext);

		?>

			<p class="check-box" style="margin-left: 0px;">
				<img style="position: absolute;margin-top: -5px;" src="{sourceURL}/media/web-icon/<?php echo $ext?>.png" width="25"> <span style="margin-left: 30px;color:#434343"><?php echo $val?></span>
				<img realname="<?php echo $val?>" src="{sourceURL}/media/web-icon/times.png" width="10" style="cursor:pointer;float:right;margin-top:5px;" onClick="return remove_file(this)">

			</p>

		<?php }

	}
	?>
</span>
<input type="text" class="attach-list" name="file_list" value="<?php echo $data["file_list"]?>" style="display: none;">
	<input type="file" id="attach-file" class="input" style="width: 96%;">
	<p style="color:#666;font-size:10px;margin-top: 0px;">* Allowed Type : Zip, Pdf, Doc, Ppt, Xls</p>
	<input type="text" id="attach-name" class="input" placeholder="Optional File Name" style="width: 96%">
	<button id="btn-loading" onClick="return attach_files('-')" class="btn-default" type="button" style="margin-left:0px;">Upload</button>
</div>
<?php } ?>
