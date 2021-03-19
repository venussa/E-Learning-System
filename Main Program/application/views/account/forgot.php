<div class="transparent bg-login"></div>
<img class="login-background bg-login-image" src="{sourceURL}/media/web-image/thumbnail.jpg">

<div class="box-login">
	<form class="form-group" style="margin-left: -5px;">

		<p class="heading">
			Forgot Password
		</p>

		<input type="text" class="input" placeholder="Ex : yourname@provider.domain">

		<p class="labels">Captcha Code</p>
		<img class="captcha" src="<?php echo create_captcha()->captcha_image_url?>">

		<input type="text" class="input" placeholder="Enter Captcha">

		<button class="btn" style="width: 102.5%;margin:0px;margin-top:5px;">Send Request</button>
		<p style="color:#666;font-size: 14px;">
			do you remember the password? try <a href="{homeURL}/account/login" <?php SPA_attribute()?>>Login</a> again.
		</p>
	</form>
</div>
