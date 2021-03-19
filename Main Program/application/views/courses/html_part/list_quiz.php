<p class="check-box" style="margin-left: 0px;">
	<a href="{homeURL}/my_courses/attempt?id={quiz_id}" <?php SPA_attribute()?>>
		<img style="position: absolute;" src="{sourceURL}/media/web-icon/quiz.png" width="25"> <span style="margin-left: 30px;color:#09f">{quiz_title}</span>
		{quiz_display}
	</a>

	<span style="float:right">
		<span style="margin-right: 30px;font-size:13px;">{my_grade}</span>
		{check_status}

	</span>
</p>