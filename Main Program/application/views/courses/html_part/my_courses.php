<div class="panel" style="float: left;width: 32%;margin-right:10px;overflow: hidden;">

	<a href="{homeURL}/my_courses/detail?id={id}" <?php echo SPA_attribute()?>>
		<div class="panel-body">
		<p style="font-size: 12px;color:#696969">{faculty} | {major}</p>
		</div>
		<div style="background: #<?php echo rand(111111,999999)?>;width: 100%;height:150px;text-align: center;vertical-align: middle;line-height: 140px;">
			<span style="color:#fff;font-size: 20px;font-family: 'Segoe UI Bold';text-shadow: 2px 2px 5px rgba(0,0,0,0.3);margin: auto;">{course_name}</span>
		</div>
		<div class="panel-body">
		<p style="font-family: 'Segoe UI Bold';font-size:20px;margin-top: 0px;">{title}</p>
		</div>
	</a>

	
	
	<div class="panel-body" style="margin-top:-40px">

			<p>
				<a href="{homeURL}/teacher/detail?nidn={teacher_id}" <?php echo SPA_attribute()?>>
					<img src="{profile_pict}" style="width:22px;height:22px;border-radius: 100%;position: absolute;">
					<span style="margin-left: 30px;color:#09f;font-size: 16px;">{teacher_name}</span>
					{alert_quiz}
				</a>
			</p>
		

	</div>
</div>