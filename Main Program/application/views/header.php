<?php check_login() ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo WEB_title()?></title>

	<meta property="url" content="{homeURL}" />

	<link rel="stylesheet" type="text/css" href="{sourceURL}/css/style.css">
	<link rel="stylesheet" type="text/css" href="{sourceURL}/css/font-awesome.min.css">

	<link rel="shortcut icon" href="{sourceURL}/media/web-image/favicon.png">

	<script src="{sourceURL}/js/jquery-3.4.1.min.js"></script>
	<script src="{sourceURL}/js/tinymce/js/tinymce/tinymce.js"></script>
	<script src="{sourceURL}/js/javascript.js"></script>
	<?php echo SPA()->javascript ?>
</head>
<body>

<div class="loading transparent">
	<img src="{sourceURL}/media/web-image/ovalo.svg">
</div>

<div class="background-black transparent alert-box"></div>
<div class="float-box alert-box" style="display: none;">
	<div class="header">
		<img src="{sourceURL}/media/web-icon/complain-icon.png">
		System Notice
	</div>
	<p style="font-size: 14px;margin-left:10px;" id="text-alert"></p>
	<button class="btn-default alert-btn" type="button" onclick="close_float_box('alert-box')" style="width: 100px;">Close</button>
</div>
<div id="web-content">
<div class="SPA-container">
<div id="SPA-content">
