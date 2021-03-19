<div class="main-container">
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span>
			<a href="{homeURL}" <?php SPA_attribute()?> >Dashboard</a> / 
			
			<?php if(splice(1) == "profile"){ ?>
				<a href="{homeURL}/profile" <?php SPA_attribute()?> >{first_name} {last_name}</a> / Edit
			<?php } else{ ?>
				<a href="{homeURL}/teacher/" <?php SPA_attribute()?> >Teacher</a> /
				<a href="{homeURL}/teacher/detail?nidn={nidn}" <?php SPA_attribute()?> >{first_name} {last_name}</a> /
				Edit
			<?php } ?>
		</span>
	</div>

	<div class="content" style="background: transparent;border: transparent;">

	<?php 

	if((splice(1) !== "profile") and ($this->get("nidn") !== userData()["nidn"]))
		$url = "teacher/detail?nidn={nidn}";
	else
		$url = "profile";
	?>

	<form method="POST" action="{homeURL}/teacher/update_data" redirect="{homeURL}/<?php echo $url?>" onSubmit="return submit_form(this)" enctype="multipart/form-data">
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
						<img class="logos" src="{profile_pict}" style="width:100px;height: 100px;">
						<p class="thumb-note">Recomendation Size : 500 x 500</p>
						<input type="file" name="profile_pict" target=".logos" onChange="return readURL(this)" style="padding:10px;padding-left: 0px;border:transparent;">
					</td>
					
				</tr>

				<?php if((splice(1) !== "profile") and  (userData()["level"] == 1)){?>
						<tr>
					<td class="table-title">Teacher ID</td>
					<td class="table-value">
						<input type="text" name="nidn" value="{nidn}" class="input" style="width:89%;background: #f5f5f5;" readonly="" required>
					</td>
					
				</tr>
				<?php } ?>

				<tr>
					<td class="table-title">First Name</td>
					<td class="table-value">
						<input type="text" name="first_name" value="{first_name}" class="input" style="width:89%" required>
					</td>
				</tr>
				<tr>
					<td class="table-title">Last Name</td>
					<td class="table-value">
						<input type="text" name="last_name" value="{last_name}" class="input" style="width:89%" required>
					</td>
				</tr>
				<tr>
					<td class="table-title">Gender</td>
					<td class="table-value">
						<select name="gender" class="input" style="width:93%" required>{gender_select}</select>
					</td>
				</tr>
				
				<tr>
					<td class="table-title">Birth Place / Day</td>
					<td class="table-value">
						
						<input type="text" name="birth_place" value="{birth_place}" class="input" style="width:26%" required>

						<input type="date" name="birth_day" value="{birth_day_select}" class="input" style="width:58%" required>
					</td>
				</tr>

				<tr>
					<td class="table-title">Religion</td>
					<td class="table-value">
						<select name="religion" class="input" style="width:93%">
							{religion_select}
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
					<textarea name="address" class="input" style="width: 89%" required>{address}</textarea>
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
					<input type="email" name="email" value="{email}" class="input" style="width:89%" required>
				</td>
			</tr>
			<tr>
				<td class="table-title">Phone</td>
				<td class="table-value">
					<input type="text" name="phone" value="{phone}" class="input" style="width:89%" required>
				</td>
			</tr>

		</table>
		<br>
	</div>
		
	</div>

	<div class="right-box">
		
		<?php if((splice(1) !== "profile") and  (userData()["level"] == 1)){?>
		<div class="panel">
			<p class="panel-heading">
				<img src="{sourceURL}/media/web-icon/courses.png">
				<span class="title">The courses is handled</span>
			</p>

			<p style="margin-left: 10px;" class="form-group">
				<input type="text" class="input input-course" style="width:87%;" placeholder="Course Name" onKeyup="select_course(this)">
			</p>

			<div class="course-select-box">
			</div>

			<div class="selected-course">{active_course}</div>

			<input type="text" name="active_course" id="course_data" value="{list_course}" readonly="" style="display: none;" required>
		</div>
		<?php } ?>


		<div class="panel">
			<p class="panel-heading">
				<img src="{sourceURL}/media/web-icon/role.png">
				<span class="title">Set New Password <span style="color:#666;font-size:10px;">* optional</span></span>
			</p>

			<p style="margin-left: 10px;" class="form-group">
				<input type="password" class="input" name="password[]" style="width:87%;" placeholder="New Password" >
				<input type="password" class="input" name="password[]" style="width:87%;" placeholder="Re-type New Password" >
			</p>

		</div>

		<div class="panel">
			<p class="panel-heading">
				<img src="{sourceURL}/media/web-icon/complain-icon.png">
				<span class="title">User Status</span>
			</p>

			<p style="font-size: 14px;margin-left: 10px;"><b>Registered</b> : {register_date}</p>
			<p style="font-size: 14px;margin-left: 10px;"><b>Last Login</b> : {online}</p>

			<?php if((splice(1) !== "profile") and  (userData()["level"] == 1)) {?>
			<p style="font-size: 14px;margin-left: 10px;"><b>Account Status</b> : 
				<input type="radio" class="checkbox" target=".checkbox" onClick="return checkbox(this)" {active} style="cursor: pointer;" value="1" name="account_status"> Active
				<input type="radio" class="checkbox" target=".checkbox" onClick="return checkbox(this)" {suspend} style="cursor: pointer;" value="0" name="account_status"> Suspend
			</p>
			<p style="font-size: 14px;margin-left: 10px;"><b>Role</b> : 
				<input type="checkbox" {level_check} style="cursor: pointer;" value="1" name="level"> Manager
			</p>
			<?php } ?>

		</div>

		<div class="panel">
			<button class="btn" style="width: 97%">Save Data</button>

			<?php if(splice(1) == "profile") $url = "{homeURL}/profile";
			else $url = "{homeURL}/teacher/detail?nidn={nidn}";
			?>

			<a href="<?php echo $url?>" <?php SPA_attribute()?>><button class="btn-default" type="button" style="width: 97%">Cancel Changes</button></a>
		</div>
	</div>

	</form>
	</div>

</div>