
<p><?php echo $data["question"]?></p>

<p style="font-family: 'Segoe UI Bold';margin-top:10px;margin-bottom: 10px;">Answer :</p>

<?php foreach(json_decode($data["answer"]) as $key => $val){ 

$index = $key + 1;

if(($data["my_answer"] !== "") and ($data["my_answer"] == $index)) $check = "checked";
else $check = null;

$mc[] = '<p class="check-box">
<input type="checkbox" '.$check.' name="my_answer" value="'.$index.'" class="pilih" target=".pilih" onClick="checkbox(this)"> '.$val.'
</p>';

shuffle($mc);
} 
echo implode(null, $mc);
?>

