<tr>
	<td style="{review}" valign="top">
		<a href="{homeURL}/student/detail?nim={student_id}" <?php echo SPA_attribute()?>>
			<img src="{profile_pict}" style="width: 40px;height: 40px;position: absolute;margin-top:4px;">
			<span style="margin-left: 50px;font-size: 13px;color:#09f">{username} <span style="color:#666;font-size: 11px;">({student_id})</span></span> 
		</a>
		<p style="margin-top: 3px;margin-left: 50px;">
			<a style="color:#666;font-size: 11px;margin-left: 0px;" href="{homeURL}/activity/review_quiz?id={[id]}&nim={student_id}" <?php SPA_attribute()?>>Review</a> · 
			<a style="color:#666;font-size: 11px;" onclick="delete_teacher('{id}');" href="javascrip:void(0)">Delete</a>
		</p>
	</td>
	<td style="font-size: 13px;{review}" valign="top">{status}</td>
	<td style="color:#666;font-size: 13px;{review}" valign="top">{grade}</td>
	<td style="color:#666;font-size: 13px;width: 200px;{review}" valign="top">{finish_on}</td>
</tr>