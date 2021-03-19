<li>
	<a href='javascript:void(0)'>
		<span class='breadcum'>{major_id}</span> {name}
	</a>
	
	<img class='right-img img-majors img-{major_id}' src='{sourceURL}/media/web-icon/chevron-bottom.png' onClick='return open_edit("{major_id}")'>

</li>

<li class='form-group box-edit box-majors edit-{major_id}' style='padding:5px;background:#f7f5f7;display:none;'>

	<form method="POST" action="{homeURL}/faculty/edit_majors" redirect="{documentURL}" onSubmit="return submit_form(this)" enctype="multipart/form-data">
			
		<input type='text' name='old-idm' class='input' style='width:5%;margin-left:5px;display:none;' value='{major_id}' required>

		<input type='text' name='idm' class='input' style='width:5%;margin-left:5px;' value='{major_id}' required>
			
		<input type='text' name='name' class='input' style='width:82%;margin-left:5px;' value='{name}' required>				

		<p style='margin-left:5px;'>
			<button class='btn' style='padding:5px;'> Save </button>
			<button type='button' onClick='return open_edit("{major_id}")' class='btn-cancel' style='padding:5px;'> Cancel </button>
			<button type='button' class='btn-default' style='padding:5px;' onClick='delete_faculty("{major_id}","edit_majors")'> Delete </button>
		</p>
	</form>
</li>