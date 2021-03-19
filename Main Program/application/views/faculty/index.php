<div class="main-container">
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span>
			<a href="{homeURL}" <?php SPA_attribute()?> >Dashboard</a> / 
			Faculty
		</span>
	</div>

	<div class="content" style="background: transparent;border: transparent;">

		<div class="left-box" style="width: 49%">

			<div class="panel">

				<p class="panel-heading">
					<img src="{sourceURL}/media/web-icon/plus.png">
					<span class="title">Add New Study Division</span>
					
				</p>


				<form method="POST" class="form-group form-add-faculty add-new-faculty" action="{homeURL}/faculty/add_faculty" redirect="{documentURL}" onSubmit="return submit_form(this)" enctype="multipart/form-data">

					<input type='text' name='idf' class='input' style='width:5%;margin-left:10px;' value='' required placeholder="ID">
					
					<input type='text' name='name' class='input' style='width:67%;margin-left:5px;' value='' required placeholder="Faculty Name">

					<select type='text' name='degree' class='input' style='width:11%;margin-left:7px;' required><?php echo $this->degree_select() ?></select>

					<p style="margin-left: 5px;"><button class='btn' style='padding:5px;'> Save </button>
					<button type='reset' class='btn-cancel' style='padding:5px;'> Reset </button></p>
				</form>

			</div>

			<div class="panel">

				<p class="panel-heading">
					<img src="{sourceURL}/media/web-icon/faculty.png">
					<span class="title">University Study Division</span>
				</p>

				<ul class="menu-container menu-faculty">
					{faculty}
				</ul>
			</div>
		</div>

		<div class="right-box" style="width: 49%">

			<div class="panel">

				<p class="panel-heading">
					<img src="{sourceURL}/media/web-icon/plus.png">
					<span class="title">Add New Majors</span>
				</p>

				<form method="POST" class="form-group form-add-faculty add-new-majors" action="{homeURL}/faculty/add_majors" redirect="{documentURL}" onSubmit="return submit_form(this)" enctype="multipart/form-data">

					<input type='text' name='idm' class='input' style='width:5%;margin-left:10px;' value='' required placeholder="ID">
					
					<input type='text' name='name' class='input' style='width:80%;margin-left:5px;' value='' required placeholder="Majors Name">

					<span style="margin-left: 10px;">{select_faculty}</span>

					<p style="margin-left: 5px;"><button class='btn' style='padding:5px;'> Save </button>
					<button type='reset' class='btn-cancel' style='padding:5px;'> Reset </button></p>
				</form>

			</div>

			<div class="panel">

				<p class="panel-heading">
					<img src="{sourceURL}/media/web-icon/major.png">
					<span class="title">{faculty_title}</span>
				</p>

				<ul class="menu-container menu-majors">
					{majors}
				</ul>
			</div>
		</div>

	</div>

</div>



<div class="background-black transparent background-float-box"></div>
<div class="float-box delete-verif" style="display: none;">
	<div class="header">
		<img src="{sourceURL}/media/web-icon/complain-icon.png">
		System Notice
	</div>
	<form class="form-group body form-faculty" method="POST" action="{homeURL}/faculty" redirect="{documentURL}" onSubmit="return submit_form(this)">
		<input type="text" id="float-del-user" name="id" style="display: none;">
		<p style="font-size: 14px;">Are you sure you want to delete it?</p>
		<button class="btn-default" type="button" onclick="close_float_box('delete-verif')">Cancel</button>
		<button class="btn click-hide" data="delete-verif">Delete</button>
	</form>
</div>