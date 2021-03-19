<div id="bg-section" style="width: 100%;height: 100%;position: fixed;z-index: 899;display: none;" onclick="$('.popup-section').hide();$(this).hide()"></div>
<div class="main-container">
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span>
			<a href="{homeURL}" <?php SPA_attribute()?> >Dashboard</a> / 
			<a href="{homeURL}/activity" <?php SPA_attribute()?> >Activity</a> / 
			{title} 
		</span>
	</div>

	<div class="content" style="background: transparent;border: transparent;">
		<div class="left-box">
			<div class="panel">
				<p class="panel-heading">
					<img src="{sourceURL}/media/web-icon/alert.png">
					<span class="title"> Description</span>
					<a href="{homeURL}/activity/edit?id={[id]}" <?php SPA_attribute()?> style="float:right;margin-right:20px;">
				<img style="position: absolute;" src="{sourceURL}/media/web-icon/cog.png" width="22">
			</a>
				</p>
				<div id="source-text" style="padding: 10px;margin-top:-30px;height: 95px;overflow: hidden;">{description}</div>
				<div id="source-btn" onClick="$('#source-text').css({'height':'95px','overflow':'hidden'});$(this).hide();$('#target-btn').show();" style="color:#09f;padding: 10px;display: none;cursor:pointer">Hide</div>
				<div id="target-btn" onClick="$('#source-text').css({'height':'','overflow':''});$(this).hide();$('#source-btn').show();" style="color:#09f;padding: 10px;cursor:pointer">View More</div>
			</div>

			{list_section}



			

		</div>

		<div class="right-box">
			<div class="panel">
				<p class="panel-heading">
					<img src="{sourceURL}/media/web-icon/role.png">
					<span class="title"> Administration By</span>
				</p>
				<img src="{teacher_profile}" style="width: 60px;height:60px;margin-left: 10px;position: absolute;margin-top:4px;">
				<p style="margin-left: 80px;font-family: 'Segoe UI Bold'">{teacher_name}</p>
				<p style="margin-left: 80px;font-size:13px;margin-top:-9px;"><a href="mailto:{teacher_email}">{teacher_email}</a></p>
				<p style="margin-left: 80px;font-size:12px;margin-top:-10px;color:#666;">{teacher_phone}</p>

			</div>

			<div class="panel">

			<a href="{homeURL}/activity/new_section?id={[id]}" <?php SPA_attribute()?>>
			<button class="btn" style="width: 96%">
				Add New Section
			</button>
			</a>

			<a href="{homeURL}/activity/edit?id={[id]}" <?php SPA_attribute()?>>
			<button class="btn-cancel" style="width: 96%">
				Edit Activity
			</button>
			</a>

			<button class="btn-default" type="button" style="width: 96%" onclick="
			delete_teacher('{[id]}');
			$('.delete-verif form').attr('redirect', $('.delete-verif form').attr('redirect1'));

			">Delete</button>
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
	<form class="form-group body" method="POST" action="{homeURL}/activity/action" redirect1="{homeURL}/activity/" redirect2="{documentURL}" redirect="{homeURL}/activity/" onSubmit="return submit_form(this)">
		<input type="text" id="float-del-user" name="id[]" style="display: none;">
		<p style="font-size: 14px;">Are you sure you want to delete it?</p>
		<button class="btn-default" type="button" onclick="close_float_box('delete-verif')">Cancel</button>
		<button class="btn click-hide" data="delete-verif">Delete</button>
	</form>
</div>