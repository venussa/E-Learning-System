<div class="main-container">
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span>

			<a href="{homeURL}" <?php SPA_attribute()?> >Dashboard</a> / 
			<a href="{homeURL}/my_courses" <?php SPA_attribute()?> >My Courses</a> / 
			<a href="{homeURL}/my_courses/detail?id={activity_id}" <?php SPA_attribute()?> >{activity_title}</a> / 
			<a href="{homeURL}/my_courses/detail?id={activity_id}" <?php SPA_attribute()?> >{topic_title}</a> / {title}
			
		</span>
	</div>

	<div class="content" style="background: transparent;border: transparent;">

		<div class="panel">
			<div class="panel-body" style="padding-top: 5px;padding-bottom: 0px;">
				<p style="color:#696969;font-size: 14px;">{activity_major} | {course_name}</p>
				<p style="font-family:'Segoe UI Bold';font-size: 25px;margin-top: -10px;">{activity_title} | {activity_class}</p>

			</div>

		</div>

		<div class="panel">
			<div class="panel-body">
				<p style="text-align: center;font-family: 'Segoe UI Bold'; font-size: 19px;">{title}</p>

				<div style="padding-top: 10px;padding-bottom: 10px;border:3px #ddd dashed;border-radius: 5px;">

				<p style="text-align: center;background: #f7a094;width: 98%;margin: auto;padding-top:10px;padding-bottom:10px;">
					<i style="color:#434343">Sorry, the quiz is over.</i>
				</p>
				
				<p style="text-align: center;">This quiz opened at {start_date}</p>
				<p style="text-align: center;">This quiz will close on {end_date}</p>
				<p style="text-align: center;">Time Limit : {time_limit}</p>

				<a href="{homeURL}/teacher/detail?nidn={teacher_id}" <?php SPA_attribute()?> >
				<p style="text-align: center;background: #f9f9f9;width: 98%;margin: auto;padding-top:10px;padding-bottom:10px;"><span style="margin-right: 25px;">Teacher : </span>
				<img src="{profile_pict}" style="width:20px;height:20px;position: absolute;margin-left:-20px;border-radius: 100%">
				<span style="margin-left:10px;color:#09f">{teacher_name}</span>
				</p>
				</a>

			</div>

				<p style="text-align: center;">
					<a href="{homeURL}/my_courses/detail?id={activity_id}" <?php SPA_attribute()?> >
					<button class="btn-default">Back To Courses</button>
					</a>
				</p>
			</div>
		</div>

	</div>
</div>