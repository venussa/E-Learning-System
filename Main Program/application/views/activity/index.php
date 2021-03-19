<div class="main-container">
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span><a href="{homeURL}" <?php SPA_attribute()?> >Dashboard</a> / Activity</span>
	</div>

	<div class="content">
		<div class="header">
		<form method="get" class="form-group" action="{homeURL}/activity" onSubmit="return search_form(this)">
			<span style="margin-left:10px;font-size: 13px;">
				
				<a href="{homeURL}/activity/add" <?php echo SPA_attribute()?>><button class="btn" style="padding: 6px;" type="button">Add New</button></a>
				
			</span>

			<span style="float: right;margin-right: 10px">
				<input type="text" class="input" name="q" style="width: 350px;padding: 5px;" placeholder="Ex : Class Name , Activity Title" value="{urldecode[q]}">
				 <select name="limit" class="input" style="width: 70px;padding: 5px;">
				 	<?php 

				 	$sort_data = [10,50,100,500];

				 	foreach ($sort_data as $key => $value) {
				 		
				 		echo ($this->get("limit") == $value) ? "<option selected>".$value."</option>":
				 		"<option>".$value."</option>";


				 	} ?>
				</select>
				<button class="btn" style="padding: 6px;">Filter</button>
			</span>
		</form>
		</div>

		<form method="post" class="form-group" action="{homeURL}/activity/action" redirect="{documentURL}" onSubmit="return submit_form(this)" style="margin-top: 0px;">

		<table class="list-table">
			<tr>
			<td style='width:30px;'><input type="checkbox" class="multiselect-master" onClick="return multiselect(this)"></td>
			<td style='font-family:Segoe UI Bold;font-size:14px;width:170px'>Title</td>
			<td style='font-family:Segoe UI Bold;font-size:14px;width:200px'>Majors</td>
			<td style='font-family:Segoe UI Bold;font-size:14px;width:50px'>Class</td>
			<td style='font-family:Segoe UI Bold;font-size:14px;width:250px'>Validity Period</td>
			<td style='font-family:Segoe UI Bold;font-size:14px;'></td>
			</tr>
			{list_data}
		</table>

		<div class="form-group" style="margin-top: 7px;position: absolute;width: 500px;">
			<span style="margin-left:15px;font-size: 13px;">Action : <select name="type" class="input" style="width: 150px;padding: 5px;">
				<option value="4">Bulk Action</option>
				<option value="4">-----------</option>
				<option value="1">Show</option>
				<option value="2">Hide</option>
				<option value="3">Delete</option>
				</select>
				<button class="btn" type="submit" style="padding: 6px;">Apply</button>
			</span>
		</div>
		</form>

		{pagination}

		<p></p>

	</div>
</div>

<div class="background-black transparent background-float-box"></div>
<div class="float-box delete-verif" style="display: none;">
	<div class="header">
		<img src="{sourceURL}/media/web-icon/complain-icon.png">
		System Notice
	</div>
	<form class="form-group body" method="POST" action="{homeURL}/activity/action" redirect="{homeURL}/activity/" onSubmit="return submit_form(this)">
		<input type="text" id="float-del-user" name="id[]" style="display: none;">
		<p style="font-size: 14px;">Are you sure you want to delete it?</p>
		<button class="btn-default" type="button" onclick="close_float_box('delete-verif')">Cancel</button>
		<button class="btn click-hide" data="delete-verif">Delete</button>
	</form>
</div>