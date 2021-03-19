<div class="main-container">
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span>Dashboard</span>
	</div>

	<div class="content" style="background: transparent;border: transparent;">

		<div class="panel">
			<div class="panel-body">
				<img src="{sourceURL}/media/web-icon/alert.png" style="width: 25px;height: 25px;position: absolute;margin-top: -2px" >
				<span style="margin-left: 35px;">Welcome <a href="{homeURL}/profile" <?php SPA_attribute()?>><?php echo userData()["last_name"]?> <?php echo userData()["first_name"]?></a>, You have registered with our system as a teacher <?php if(userData()["level"] == 1) echo "and concurrently as a manager"?>.</span>
			</div>
		</div>

		<div class="left-box">
			
			<div class="panel">
				<p class="panel-heading">
					<img src="{sourceURL}/media/web-icon/major.png">
					<span class="title">My Activity</span>
				</p>

				<div class="panel-body">
					
					<table class="list-table" style="margin-top: -20px;">
						<tr>
						<td style='font-family:Segoe UI Bold;font-size:14px;width:170px'>Title</td>
						<td style='font-family:Segoe UI Bold;font-size:14px;width:200px'>Majors</td>
						<td style='font-family:Segoe UI Bold;font-size:14px;width:50px'>Class</td>
						</tr>
						{list_data}
					</table>
				</div>
			</div>

		</div>

		<div class="right-box">

			<div class="panel">
			<p class="panel-heading">
				<img src="{sourceURL}/media/web-icon/paper.png">
				<span class="title">Upcoming Quiz</span>
			</p>

			<div class="panel-body">
					
					<?php 

					$query = API_access("data_select?name=data_activity", true,[

						"teacher_id" => userData()["nidn"],

					]);

					if($query["total_data"] > 0){
						
						foreach($query as $key => $val){

							if(is_numeric($key)){

								$topic = API_access("data_select?name=data_topic", true,[

									"activity_id" => $val["id"]

								]);

								if($topic["total_data"] > 0)

									foreach ($topic as $k => $v) {
											
										if(is_numeric($k)){

											$question = API_access("data_select?name=data_question&order_by=start_time&sort_by=desc", true,[

												"topic_id" => $v["id"],
												"end_time>" => time()

											]);

											if($question["total_data"] > 0)

												foreach ($question as $kk => $vv) {

													$response = true;
													
													if(is_numeric($kk)){ ?>

<a href="{homeURL}/activity/detail_quiz?main_id=<?php echo $val["id"]?>&id=<?php echo $vv["id"]?>" <?php SPA_attribute()?>>												
	<div class="check-box" style="margin-left: 0px;margin-top: -10px;margin-bottom: 15px;">
		
			<img style="position: absolute;" src="{sourceURL}/media/web-icon/quiz.png" width="25"> 
			<p style="margin-left: 35px;color:#09f;margin-top: -5px;"><?php echo $vv["title"]?></p>
			<p style="margin-left: 35px;color:#666;font-size: 11px;margin-top: -10px;"><?php echo date("l, d M Y, H:i A",$vv["start_time"])?></p>
		
	</div>
</a>

													<?php }

												}

										}

									}

							}

						}
					}

					if(!isset($response)) { ?>

	<div class="check-box" style="margin-left: 0px;margin-top: -10px;margin-bottom: 15px;text-align: center;font-family: 'Segoe UI Bold'">

			Not Found
		
	</div>

					<?php } ?>

			</div>

		</div>
			
		</div>

	</div>
</div>