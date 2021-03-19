<div class="main-container" >
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span><a href="{homeURL}" <?php SPA_attribute()?> >Dashboard</a> / Setting</span>
	</div>

	<div class="content">
		<div class="header" style="padding: 10px;">
			Site Configuration
		</div>
		<div class="alert-yellow">
			This page can only be accessed by the manager
		</div>
		<form class="form-group" method="POST" action="{homeURL}/setting/update_setting" redirect="{homeURL}/setting" onSubmit="return submit_form(this)" enctype="multipart/form-data">

			<table>
				
				<tr>
					<td class="label">
						<p>Institution Name</p>
					</td>
					<td>
						<input type="text" name="institution_name" class="input" value="{institution_name}">
					</td>
				</tr>

				<tr>
					<td class="label">
						<p>Contact Number</p>
					</td>
					<td>
						<input type="text" name="phone" class="input" value="{phone}">
					</td>
				</tr>


				<tr>
					<td class="label">
						<p>SMTP Host</p>
					</td>
					<td>
						<input type="text" name="smtp_host" class="input" value="{smtp_host}">
					</td>
				</tr>

				<tr>
					<td class="label">
						<p>SMTP Username</p>
					</td>
					<td>
						<input type="text" name="smtp_username" class="input" value="{smtp_username}">
					</td>
				</tr>

				<tr>
					<td class="label">
						<p>SMTP Password</p>
					</td>
					<td>
						<input type="text" name="smtp_password" class="input" value="{smtp_password}">
					</td>
				</tr>

				<tr>
					<td class="label">
						<p>SMTP Port</p>
					</td>
					<td>
						<input type="text" name="smtp_port" class="input" value="{smtp_port}">
					</td>
				</tr>

				<tr>
					<td class="label">
						<p>Logo</p>
					</td>
					<td>
						<img class="logos" src="{logo}" style="width: 200px;height:53px;">
						<p class="thumb-note">Image Size : 630 x 170</p>
						<input type="file" name="logo" target=".logos" onChange="return readURL(this)" style="padding:10px;padding-left: 0px;border:transparent;">
					</td>
				</tr>

				<tr>
					<td class="label">
						<p>Logo Full Color</p>
					</td>
					<td>
						<img class="logoss" src="{logo_full_color}" style="width: 200px;height:53px;margin-top:10px;">
						<p class="thumb-note">Image Size : 630 x 170</p>
						<input type="file" name="logo_full_color" target=".logoss" onChange="return readURL(this)" style="padding:10px;padding-left: 0px;border:transparent;">
					</td>
				</tr>

				<tr>
					<td class="label">
						<p>Favicon</p>
					</td>
					<td>
						<img class="favicon" src="{favicon}">
						<p class="thumb-note">Image Size : 200 x 200</p>
						<input type="file" name="favicon" target=".favicon" onChange="return readURL(this)" style="padding:10px;padding-left: 0px;border:transparent;">
					</td>
				</tr>

				<tr>
					<td class="label">
						<p>Login Access</p>
					</td>
					<td>
						<p style="font-size: 14px;">
							<input type="radio" name="login_status" class="checkbox" target=".checkbox" onClick="return checkbox(this)" value="1" {enable_status}> Enable
							<input type="radio" name="login_status" class="checkbox" target=".checkbox" onClick="return checkbox(this)" value="0" {disable_status}> Disable
						</p>
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