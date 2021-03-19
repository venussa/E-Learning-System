<div class="main-container">
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span><a href="{homeURL}" <?php SPA_attribute()?> >Dashboard</a> / My Grade</span>
	</div>

	<div class="content">

		<table class="list-table">
			<tr>
				<td style="font-family:Segoe UI Bold;font-size:14px;width:100px">Course Code</td>
				<td style="font-family:Segoe UI Bold;font-size:14px;">Title</td>
				<td style="font-family:Segoe UI Bold;font-size:14px;width: 150px;">Status</td>
				<td style="font-family:Segoe UI Bold;font-size:14px;width:150px">Grade</td>
				<td style="font-family:Segoe UI Bold;font-size:14px;">Finish On</td>
			</tr>
			{list_data}
		</table>

		{pagination}

		<p></p>

	</div>
</div>