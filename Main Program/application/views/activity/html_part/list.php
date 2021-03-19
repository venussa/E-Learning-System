<tr>

	<?php if(!empty(splice(1))){ ?>
	<td style='width:10px;' valign='top'>
		<input type='checkbox' style='margin-top:13px;' class='multiselect' name='id[]' value='{id}' onClick='return multiselect(this)'>
	</td>
	<?php } ?>

	<td valign='top'>
		<p class='name' style='margin-top:10px;font-family:Segoe UI Regular'>
			<a href='{homeURL}/activity/manage?id={id}' <?php SPA_attribute() ?>>{title}</a> {display}</p>
	</td>

	<td valign='top'>
		<p title='Fakultas : {faculty_name}' class='name' style='margin-top:10px;font-family:Segoe UI Regular'>[{faculty}] {major_name}</p>
	</td>

	<td valign='top'>
		<p class='name' style='margin-top:10px;font-family:Segoe UI Regular'>{class}</p>
	</td>

	<?php if(!empty(splice(1))){ ?>
	<td valign='top'>
		<p class='name' style='margin-top:10px;font-family:Segoe UI Regular'>{start_date} - {end_date}</p>
	</td>
	<?php } ?>
	<?php if(!empty(splice(1))){ ?>
	<td style='text-align:right'>


		<a href='{homeURL}/activity/manage?id={id}' <?php SPA_attribute() ?>>
			<button class='btn-default' style='padding:5px;' type='button'>
				<i class='fa fa-edit'></i> Manage
			</button>
		</a>

		<a href='{homeURL}/activity/edit?id={id}' <?php SPA_attribute() ?>>
			<button class='btn-default' style='padding:5px;' type='button'>
				<i class='fa fa-edit'></i> Edit
			</button>
		</a>
		
		<button class='btn-default' type='button' style='padding:5px;' onClick="delete_teacher('{id}')">
			<i class='fa fa-times'></i> Delete
		</button>
	</td>
<?php } ?>
</tr>