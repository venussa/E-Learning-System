<div class="main-container">
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span><a href="{homeURL}" <?php SPA_attribute()?> >Dashboard</a> / Student</span>
	</div>

	<div class="content">
		<div class="header">
		<form method="get" class="form-group" action="{homeURL}/student" onSubmit="return search_form(this)">
			<?php if(userData()["level"] == 1) { ?>
			<span style="margin-left:10px;font-size: 13px;">
				<a href="{homeURL}/student/add" <?php echo SPA_attribute()?>><button class="btn" style="padding: 6px;" type="button">Add New</button></a>
				
			</span>

			<span style="float: right;margin-right: 10px">
			<?php }else{ ?>
			<span style="margin-left:10px;margin-right: 10px">
			<?php } ?>
				<input type="text" class="input" name="q" style="width: 350px;padding: 5px;" placeholder="Ex : Student ID, Name, address, Contact Number" value="{urldecode[q]}">
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

		<form method="post" class="form-group" action="{homeURL}/student/action" redirect="{documentURL}" onSubmit="return submit_form(this)" style="margin-top: 0px;">

		<table class="list-table">
			<tr>
				<?php if(userData()["level"] == 1) { ?>
				<td style="font-family:Segoe UI Bold;font-size:14px;width:30px;">
					<input type="checkbox" class="multiselect-master" onClick="return multiselect(this)">
				</td>
				<?php } ?>

				<td style="font-family:Segoe UI Bold;font-size:14px;" colspan="2">Name</td>
				<td style="font-family:Segoe UI Bold;font-size:14px;">Contact</td>
				<td></td>
			</tr>
			{list_data}
		</table>

		<?php if(userData()["level"] == 1) { ?>
		<div class="form-group" style="margin-top: 7px;position: absolute;width: 500px;">
			<span style="margin-left:15px;font-size: 13px;">Action : <select name="type" class="input" style="width: 150px;padding: 5px;">
				<option value="4">Bulk Action</option>
				<option value="4">-----------</option>
				<option value="1">Suspend</option>
				<option value="2">Unsuspend</option>
				<option value="3">Delete</option>
				</select>
				<button class="btn" type="submit" style="padding: 6px;">Apply</button>
			</span>
		</div>
		<?php } ?>
		</form>

		{pagination}

		<p></p>

	</div>
</div>

<?php if(userData()["level"] == 1) { ?>
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
<?php }?>