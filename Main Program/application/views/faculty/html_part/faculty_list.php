{header}

	<a href='{homeURL}/faculty?q={faculty_id}' <?php SPA_attribute()?>>
		<span class='breadcum'>{faculty_id}</span> {name} ({degree})
	</a>
				
	<img class='right-img img-faculty img-{faculty_id}' src='{homeURL}/media/web-icon/chevron-bottom.png' onClick='return open_edit("{faculty_id}")'>
			
</li>

<li class='form-group box-edit box-faculty edit-{faculty_id}' style='padding:5px;background:#f7f5f7;display:none;'>

	<form method=POST action="{homeURL}/faculty/edit_faculty" redirect="{documentURL}" onSubmit='return submit_form(this)' enctype='multipart/form-data'>
			
		<input type='text' name='old-idf' class='input' style='width:5%;margin-left:5px;display:none;' value='{faculty_id}' required>

		<input type='text' name='idf' class='input' style='width:5%;margin-left:10px;' value='{faculty_id}' required>
				
		<input type='text' name='name' class='input' style='width:67%;margin-left:5px;' value='{name}' required>
				
			
		<select type='text' name='degree' class='input' style='width:11%;margin-left:7px;' required>

		{degree1}

		</select>
				
		<p>
			<button class='btn' style='padding:5px;'> Save </button>

			<button type='button' onClick='return open_edit("{faculty_id}")' class='btn-cancel' style='padding:5px;'> Cancel </button>

			<button type='button' class='btn-default' style='padding:5px;' onClick='delete_faculty("{faculty_id}","edit_faculty")'> Delete </button>
		</p>

	</form>

</li>