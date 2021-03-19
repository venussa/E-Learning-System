<div class="main-container">
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span>
			<a href="{homeURL}" <?php SPA_attribute()?> >Dashboard</a> / 
			<a href="{homeURL}/activity/" <?php SPA_attribute()?> >Activity</a> / 
			<a href="{homeURL}/activity/manage?id={[id]}" <?php SPA_attribute()?> >{title}</a> /
			Edit
		</span>
	</div>

	<div class="content" style="background: transparent;border: transparent;">

	<form method="POST" action="{homeURL}/activity/edit_activity?id={[id]}" redirect="{homeURL}/activity/manage?id={[id]}" onSubmit="return submit_form(this)" enctype="multipart/form-data">
	<div class="left-box">

		<div class="panel form-group">

			
			<div class="panel-body">

			<p class="label-title">Activity Title</p>
			<input type="text" name="title" class="input" value="{title}" placeholder="* Optional ">

			<p class="label-title">Select Courses</p>
			{my_course}

			<p class="label-title">Display</p>
			
			<select class="input" name="display">
				{display}
			</select>

			<p class="label-title">Description</p>
			<textarea class="input textarea" name="description" style="height: 300px;">{description}</textarea>
			</div>
		<br>
	</div>

	</div>

	<div class="right-box">
		
		
		<div class="panel">
			<p class="panel-heading">
				<img src="{sourceURL}/media/web-icon/calendar.png">
				<span class="title"> validity period</span>
			</p>

			<p style="margin-left: 10px;" class="form-group">
				<span style="font-size: 14px;">Start Date : </span>
				<input type="date" class="input" name="start_date" value="{start_date}" style="width: 87%">
				<br>
				<span style="font-size: 14px;">End Date : </span>
				<input type="date" class="input" name="end_date" value="{end_date}" style="width: 87%">
			</p>
			
		</div>

		<div class="panel">
			<p class="panel-heading">
				<img src="{sourceURL}/media/web-icon/courses.png">
				<span class="title"> Participant</span>
			</p>

			<p style="margin-left: 10px;" class="form-group">
				<span style="font-size: 14px;">Faculty : </span> {faculty_select}
				<span style="font-size: 14px;">Majors : </span>{major_select}
				<span style="font-size: 14px;">Level : </span>
				<select name="class[]" class="input" style="width:94%" required>{level_select}</select>
				<span style="font-size: 14px;">Class Number : </span>
				<select name="class[]" class="input" style="width:94%" required>{class_select}</select>
			</p>
			
		</div>

	

		<div class="panel">
			<button class="btn" style="width: 97%">Save Data</button>
			<a href="{homeURL}/activity/" <?php SPA_attribute()?>><button class="btn-default" type="button" style="width: 97%">Cancel</button></a>
		</div>
	</div>

	</form>
	</div>

</div>

<div class="background-black transparent background-float-box"></div>
<div class="float-box delete-verif" style="display: none;">
	<div class="header">
		<img src="{sourceURL}/media/web-icon/complain-icon.png">
		System Notice
	</div>
	<form class="form-group body" method="POST" action="{homeURL}/student/action" redirect="{homeURL}/student/" onSubmit="return submit_form(this)">
		<input type="text" id="float-del-user" name="id[]" style="display: none;">
		<p style="font-size: 14px;">Are you sure you want to delete it?</p>
		<button class="btn-default" type="button" onclick="close_float_box('delete-verif')">Cancel</button>
		<button class="btn click-hide" data="delete-verif">Delete</button>
	</form>
</div>