<div class="transparent bg-login"></div>
<img class="login-background bg-login-image" src="{sourceURL}/media/web-image/thumbnail.jpg">

<?php $url = create_captcha()->captcha_image_url; ?>

<div class="box-login">
	<form class="form-group" method="POST" action="{homeURL}/account/proccess_login?cookie=<?php echo base64_encode($_SESSION["captcha_code"])?>" redirect="{homeURL}" onSubmit="return submit_form(this)" style="margin-left: -5px;">

		<p class="heading">
			<img src="{sourceURL}/media/web-image/logo.png">
		</p>

		<input type="text" class="input" name="username" placeholder="Email or User ID">

		<input type="password" class="input" name="password" placeholder="Password">

		<p class="labels">Captcha Code </p>
		<img class="captcha" src="<?php echo $url?>">
		<input type="text" class="input" placeholder="Enter Captcha" name="captcha">

		<button class="btn" style="width: 102.5%;margin:0px;margin-top:5px;">Login</button>
		<p style="color:#666;font-size: 14px;">
			<a href="{homeURL}/account/forgot" <?php SPA_attribute()?>>Forgot password ?</a>
			get it back soon.
		</p>
	</form>
</div>
