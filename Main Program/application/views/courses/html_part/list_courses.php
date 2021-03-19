<tr>

	<td style='width:10px;' valign='top'>
		<input type='checkbox' class='multiselect' name='id[]' value='{kdmk}' onClick='return multiselect(this)'>
	</td>

	<td style='padding-top:0px;padding-bottom:0px'>{kdmk}</td>
	<td style='padding-top:0px;padding-bottom:0px'>{title}</td>
	<td style='padding-top:0px;padding-bottom:0px;text-align:center'>{sks}</td>
	<td style='text-align:right;padding-top:0px;padding-bottom:0px'>
		<a href='{homeURL}/courses/edit?id={kdmk}' <?php SPA_attribute()?>>
			<button class='btn-default' type='button' style='padding:5px;'>
				<i class='fa fa-edit'></i> Edit
			</button>
		</a>

		<button class='btn-default' type='button' style='padding:5px;' onClick="delete_teacher('{kdmk}')">
			<i class='fa fa-times'></i> Delete
		</button>
	</td>

</tr>