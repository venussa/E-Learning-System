<tr>

	<?php if(userData()["level"] == 1) { ?>
	<td style='width:10px;' valign='top'><input type='checkbox' style='margin-top:25px;' class='multiselect' name='id[]' value='{nim}' onClick='return multiselect(this)'></td>
	<?php } ?>

	<td style='width:70px;' valign='top'>
	<img class='profile-pict' src='{profile_pict}'>

	</td>

	<td valign='top'>
	<p class='name'>{name}</span>

	{account_status}

	</p>
	<p class='address'>{address}<br>{village}, {district}, {province}, {postal_code}</p>
	</td>

	<td>

	<p class='address' style='margin-top:0px;'>Student ID : {nim}</p>
	<p class='address' style='margin-top:-5px;'>Tlp : {phone}</p>
	<p class='address' style='margin-top:-5px;'>email :  <a href='mailto:{email}'>{email}</a></p>

	</td>


	<td style='text-align:right'>
		<a href='{homeURL}/student/detail?nim={nim}' <?php SPA_attribute()?>>
			<button class='btn-default' style='padding:5px;' type='button'>
				<i class='fa fa-search-plus'></i> Detail
			</button>
		</a>

		<?php if(userData()["level"] == 1) { ?>
		<a href='{homeURL}/student/edit?nim={nim}' <?php SPA_attribute()?>>
			<button class='btn-default' style='padding:5px;' type='button'>
				<i class='fa fa-edit'></i> Edit
			</button>
		</a>

		<button class='btn-default' type='button' style='padding:5px;' onClick="delete_teacher('{nim}')">
			<i class='fa fa-times'></i> Delete
		</button>
		<?php } ?>
	</td>

</tr>