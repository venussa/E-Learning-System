<div class="main-container">
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span>
			<a href="{homeURL}" <?php SPA_attribute()?> >Dashboard</a> / 
			<a href="{homeURL}/student/" <?php SPA_attribute()?> >Student</a> / 
			Add New
		</span>
	</div>

	<div class="content" style="background: transparent;border: transparent;">

	<form method="POST" action="{homeURL}/student/add_data" redirect="{homeURL}/student/" onSubmit="return submit_form(this)" enctype="multipart/form-data">
	<div class="left-box">

		<div class="panel">

			<p class="panel-heading">
				<img src="{sourceURL}/media/web-icon/users.png">
				<span class="title">User Information</span>
			</p>
			
			<table width="100%" style="margin-left:30px;" class="form-group">
				<tr>
					<td class="table-title" valign="top">Profile Picture</td>
					<td class="table-value">
						<img class="logos" src="{sourceURL}/media/web-image/user-dummy.png" style="width:100px;height: 100px;">
						<p class="thumb-note">Recomendation Size : 500 x 500</p>
						<input type="file" name="profile_pict" target=".logos" onChange="return readURL(this)" style="padding:10px;padding-left: 0px;border:transparent;">
					</td>
					
				</tr>

				<tr>
					<td class="table-title">Student ID</td>
					<td class="table-value">
						<input type="text" name="nim" class="input" style="width:89%;" required>
					</td>
					
				</tr>

				<tr>
					<td class="table-title">First Name</td>
					<td class="table-value">
						<input type="text" name="first_name" class="input" style="width:89%" required>
					</td>
				</tr>
				<tr>
					<td class="table-title">Last Name</td>
					<td class="table-value">
						<input type="text" name="last_name" class="input" style="width:89%" required>
					</td>
				</tr>
				<tr>
					<td class="table-title">Gender</td>
					<td class="table-value">
						<select name="gender" class="input" style="width:93%" required>
							<option value="1">Male</option>
							<option value="0">Female</option>
						</select>
					</td>
				</tr>
				
				<tr>
					<td class="table-title">Birth Place / Day</td>
					<td class="table-value">
						
						<input type="text" name="birth_place"  class="input" style="width:26%" required>

						<input type="date" name="birth_day" class="input" style="width:58%" required>
					</td>
				</tr>

				<tr>
					<td class="table-title">Religion</td>
					<td class="table-value">
						<select name="religion" class="input" style="width:93%">
							<?php echo $this->religion_select()?>
						</select>
					</td>
				</tr>


			</table>
		<br>
	</div>

	<div class="panel">

		<p class="panel-heading">
			<img src="{sourceURL}/media/web-icon/mark.png">
			<span class="title">Address Information</span>
		</p>
			
		<table width="100%" style="margin-left:30px;" class="form-group">
			
			<tr>
				<td class="table-title">Address</td>
				<td class="table-value">
					<textarea name="address" class="input" style="width: 89%" required></textarea>
				</td>
			</tr>

			<tr>
				<td class="table-title">Province</td>
				<td class="table-value">{province_select}</td>
			</tr>
			<tr>
				<td class="table-title">District</td>
				<td class="table-value">{district_select}</td>
			</tr>
			<tr>
				<td class="table-title">Sub-district</td>
				<td class="table-value">{village_select}</td>
			</tr>
			<tr>
				<td class="table-title">Postal Code</td>
				<td class="table-value">{postal_code_select}</td>
			</tr>

		</table>
		<br>
	</div>

	<div class="panel">

		<p class="panel-heading">
			<img src="{sourceURL}/media/web-icon/cs.png">
			<span class="title">Contact Infomation</span>
		</p>
			
		<table width="100%" style="margin-left:30px;" class="form-group">
			
			<tr>
				<td class="table-title">Email</td>
				<td class="table-value">
					<input type="email" name="email"  class="input" style="width:89%" required>
				</td>
			</tr>
			<tr>
				<td class="table-title">Phone</td>
				<td class="table-value">
					<input type="text" name="phone"  class="input" style="width:89%" required>
				</td>
			</tr>

		</table>
		<br>
	</div>
		
	</div>

	<div class="right-box">
		<div class="panel">
			<p class="panel-heading">
				<img src="{sourceURL}/media/web-icon/major.png">
				<span class="title">Courses Taken</span>
			</p>

			<p style="margin-left: 10px;" class="form-group">
				<input type="text" class="input input-course" style="width:87%;" placeholder="Course Name" onKeyup="select_course(this)">
			</p>

			<div class="course-select-box">
			</div>

			<div class="selected-course"></div>

			<input type="text" name="active_course" id="course_data" readonly="" style="display: none;" required>
		</div>
		
		<div class="panel">
			<p class="panel-heading">
				<img src="{sourceURL}/media/web-icon/courses.png">
				<span class="title"> Education Information</span>
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
			<p class="panel-heading">
				<img src="{sourceURL}/media/web-icon/role.png">
				<span class="title">Set Password <span style="color:#666;font-size:10px;">* Minimum 8 Character</span></span>
			</p>

			<p style="margin-left: 10px;" class="form-group">
				<input type="password" class="input" name="password[]" style="width:87%;" placeholder="Password" >
				<input type="password" class="input" name="password[]" style="width:87%;" placeholder="Re-type Password" >
			</p>

		</div>

		<div class="panel">
			<p class="panel-heading">
				<img src="{sourceURL}/media/web-icon/complain-icon.png">
				<span class="title">User Status</span>
			</p>
			<p style="font-size: 14px;margin-left: 10px;"><b>Account Status</b> : 
				<input type="radio" class="checkbox" target=".checkbox" onClick="return checkbox(this)" checked style="cursor: pointer;" value="1" name="account_status"> Active
				<input type="radio" class="checkbox" target=".checkbox" onClick="return checkbox(this)"  style="cursor: pointer;" value="0" name="account_status"> Suspend
			</p>

		</div>

		<div class="panel">
			<button class="btn" style="width: 97%">Save Data</button>
			<a href="{homeURL}/student/" <?php SPA_attribute()?>><button class="btn-default" type="button" style="width: 97%">Cancel</button></a>
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