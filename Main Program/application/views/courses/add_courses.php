<div class="main-container" >
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span><a href="{homeURL}" <?php SPA_attribute()?> >Dashboard</a> /
		<a href="{homeURL}/courses" <?php SPA_attribute()?> >Courses</a> /
		Add Courses</span>
	</div>

	<div class="content">
		<div class="header" style="padding: 10px;">
			Add Course
		</div>
		<form class="form-group" method="POST" action="{homeURL}/courses/add_courses" redirect="{homeURL}/courses" onSubmit="return submit_form(this)" enctype="multipart/form-data">

			<table>
				
				<tr>
					<td class="label">
						<p>Course Code</p>
					</td>
					<td>
						<input type="text" name="kdmk" class="input">
					</td>
				</tr>

				<tr>
					<td class="label">
						<p>Title</p>
					</td>
					<td>
						<input type="text" name="title" class="input">
					</td>
				</tr>

				<tr>
					<td class="label">
						<p>Academic credit system</p>
					</td>
					<td>
						<input type="number" name="sks" class="input" value="1" onkeyup="
						var vals = parseInt($(this).val());
						if(Number.isInteger(vals) == false) $(this).val(1);
						else if(vals > 10) $(this).val(10);
						if(vals < 1) $(this).val(1);

						
					">
					</td>
				</tr>

				<tr>
					<td style="border:transparent;"></td>
					<td style="border:transparent;"><br><button class="btn btn-loading" type="submit">Save Setting</button></td>
				</tr>

			</table>
			<br>
		</form>
	</div>
</div>