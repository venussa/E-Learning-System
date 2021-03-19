<p class="check-box" style="margin-left: 0px;">
	<a href="{homeURL}/activity/detail_quiz?main_id={activity_id}&id={quiz_id}" <?php SPA_attribute()?>>
		<img style="position: absolute;" src="{sourceURL}/media/web-icon/quiz.png" width="25"> <span style="margin-left: 30px;color:#09f">{quiz_title}</span>
		{quiz_display} {alert}
	</a>

	<span style="float:right">
	<a href="{homeURL}/activity/update_quiz?id={id}&cluster={quiz_id}" <?php SPA_attribute()?>>
		<img src="{sourceURL}/media/web-icon/cog.png" width="15">
	</a>
	</span>
</p>