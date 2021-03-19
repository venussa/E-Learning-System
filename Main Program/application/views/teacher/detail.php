<div class="main-container">
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span>
			<a href="{homeURL}" <?php SPA_attribute()?> >Dashboard</a> / 

			<?php if((splice(1) == "profile") or (userData()["user_type"] == "student")){ ?>
				{first_name} {last_name}
			<?php } else{ ?>
				<a href="{homeURL}/teacher/" <?php SPA_attribute()?> >Teacher</a> / 
				{first_name} {last_name}
			<?php } ?>
		
		</span>
	</div>

	<div class="content" style="background: transparent;border: transparent;">

	<div class="left-box">

		<div class="panel">

			<p class="panel-heading">
				<img src="{sourceURL}/media/web-icon/users.png">
				<span class="title">User Information</span>
			</p>
			
			<table width="100%" style="margin-left:30px;">
				<tr>
					<td class="table-title">Teacher ID</td>
					<td class="table-value">: {nidn}</td>
					<td class="table-profile-img" rowspan="4">
						<img src="{profile_pict}" alt="{profile_pict}">
					</td>
				</tr>
				<tr>
					<td class="table-title">Name</td>
					<td class="table-value">: {first_name} {last_name}</td>
				</tr>
				<tr>
					<td class="table-title">Gender</td>
					<td class="table-value">: {gender}</td>
				</tr>
				
				<tr>
					<td class="table-title">Birth Day</td>
					<td class="table-value">: {birth_day} / {birth_place}</td>
				</tr>

				<tr>
					<td class="table-title">Religion</td>
					<td class="table-value">: {religion}</td>
				</tr>


			</table>
		<br>
	</div>

	<div class="panel">

		<p class="panel-heading">
			<img src="{sourceURL}/media/web-icon/mark.png">
			<span class="title">Address Information</span>
		</p>
			
		<table width="100%" style="margin-left:30px;">
			
			<tr>
				<td class="table-title">Address</td>
				<td class="table-value">: {address}</td>
			</tr>
			<tr>
				<td class="table-title">Sub-district</td>
				<td class="table-value">: {village}</td>
			</tr>

			<tr>
				<td class="table-title">District</td>
				<td class="table-value">: {district}</td>
			</tr>

			<tr>
				<td class="table-title">Province</td>
				<td class="table-value">: {province}</td>
			</tr>

			<tr>
				<td class="table-title">Postal Code</td>
				<td class="table-value">: {postal_code}</td>
			</tr>

		</table>
		<br>
	</div>

	<div class="panel">

		<p class="panel-heading">
			<img src="{sourceURL}/media/web-icon/cs.png">
			<span class="title">Contact Infomation</span>
		</p>
			
		<table width="100%" style="margin-left:30px;">
			
			<tr>
				<td class="table-title">Email</td>
				<td class="table-value">: <a href="mailto:{email}" style="color: #09f;font-size: 13px;">{email}</a></td>
			</tr>
			<tr>
				<td class="table-title">Phone</td>
				<td class="table-value">: {phone}</td>
			</tr>

		</table>
		<br>
	</div>
		
	</div>

	<div class="right-box">
		
		<div class="panel">
			<p class="panel-heading">
				<img src="{sourceURL}/media/web-icon/courses.png">
				<span class="title">The courses is handled</span>
			</p>
			{active_course}
		</div>

		<div class="panel">
			<p class="panel-heading">
				<img src="{sourceURL}/media/web-icon/complain-icon.png">
				<span class="title">User Status</span>
			</p>
			<p style="font-size: 14px;margin-left: 10px;"><b>Registered</b> : {register_date}</p>
			<p style="font-size: 14px;margin-left: 10px;"><b>Last Login</b> : {online}</p>

			<?php if((splice(1) !== "profile") and  (userData()["level"] == 1)){?>
			<p style="font-size: 14px;margin-left: 10px;"><b>Account Status</b> : 
				<input type="radio" class="checkbox" target=".checkbox" onClick="return checkbox(this)" {active} disabled> Active
				<input type="radio" class="checkbox" target=".checkbox" onClick="return checkbox(this)" {suspend} disabled> Suspend
			</p>
			<p style="font-size: 14px;margin-left: 10px;"><b>Role</b> : 
				<input type="checkbox" disabled="" {level_check} style="cursor: pointer;" value="1" name="level"> Manager
			</p>

			<?php } ?>

		</div>

		

			<?php if(splice(1) == "profile") $url = "{homeURL}/profile/preference";
			else $url = "{homeURL}/teacher/edit?nidn={nidn}";
			?>

			<?php if((splice(1) == "profile") or (userData()["level"] == 1)) { ?>
			<div class="panel">
			<a href="<?php echo $url?>" <?php SPA_attribute()?>>
				<button class="btn" style="width: 97%">Changes Data</button>
			</a>
			</div>
			<?php } ?>

			<?php if(
				(splice(1) !== "profile") and  
				(userData()["level"] == 1) and 
				($this->get("nidn") !== userData()["nidn"])
			){?>
			<div class="panel">
			<button class="btn-default" style="width: 97%" onClick="delete_teacher('{nidn}')">Delete User</button>
			</div>
			<?php } ?>
		
	</div>


	</div>
</div>

<?php if(
	(splice(1) !== "profile") and  
	(userData()["level"] == 1) and 
	($this->get("nidn") !== userData()["nidn"])
){?>

<div class="background-black transparent background-float-box"></div>
<div class="float-box delete-verif" style="display: none;">
	<div class="header">
		<img src="{sourceURL}/media/web-icon/complain-icon.png">
		System Notice
	</div>
	<form class="form-group body" method="POST" action="{homeURL}/teacher/action" redirect="{homeURL}/teacher/" onSubmit="return submit_form(this)">
		<input type="text" id="float-del-user" name="id[]" style="display: none;">
		<p style="font-size: 14px;">Are you sure you want to delete it?</p>
		<button class="btn-default" type="button" onclick="close_float_box('delete-verif')">Cancel</button>
		<button class="btn click-hide" data="delete-verif">Delete</button>
	</form>
</div>
<?php } ?>