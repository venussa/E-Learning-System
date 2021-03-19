
<p><?php echo $vals["question"]?></p>

<p style="font-family: 'Segoe UI Bold';margin-top:10px;margin-bottom: 10px;">Answer :</p>

<?php 



foreach(json_decode($vals["answer"]) as $key => $val){ 

$true_bg = null;

$index = $key + 1;

$true = json_decode($vals["true_answer"],true)[0];

if($true == $val) {

	$true = $index;
	$true_bg = "true-answer";

}

if(($vals["my_answer"] !== "") and ($vals["my_answer"] == $index)){

	if($true == $vals["my_answer"]) $true_bg = "true-answer";

	else $true_bg = "false-answer";

	$check = "checked";


}else{

	$check = null;

}

$mc[] = '<p class="check-box '.(

	(($_SESSION["show_correct_answer"] == 1) or (userData()["user_type"] == "teacher"))
	 ? $true_bg : null).'">
<input type="checkbox" '.$check.' disabled> '.$val.'
</p>';

shuffle($mc);
} 
echo implode(null, $mc);

unset($mc);
?>

