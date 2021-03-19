<div class="main-container">
	<div class="navigator">
		<img src="{sourceURL}/media/web-icon/home.png">
		<span>
			<a href="{homeURL}" <?php SPA_attribute()?> >Dashboard</a> / 
			<a href="{homeURL}/activity/" <?php SPA_attribute()?> >Activity</a> / 
			<a href="{homeURL}/activity/manage?id={activity_id}" <?php SPA_attribute()?> >{title0}</a> / 
			<a href="{homeURL}/activity/manage?id={activity_id}" <?php SPA_attribute()?> >Section {title}</a> /
			Edit Section
		</span>
	</div>

	<div class="content" style="background: transparent;border: transparent;">
		<form method="POST" class="form-group" action="{homeURL}/activity/edit_section?id={[id]}" redirect="{homeURL}/activity/manage?id={activity_id}#sec-{[id]}" onSubmit="return submit_form(this)" enctype="multipart/form-data">
			<div class="left-box">
				<div class="panel">
					<div class="panel-body">
						<p class="label-title">Title</p>
						<input type="text" name="title" class="input" style="width: 97%" placeholder="Section title ..." value="{title}">

						<p class="label-title">Display</p>
						<select class="input" style="width: 100%" name="display">
							{display}
						</select>

						<p class="label-title">Description</p>
						<div style="width: 100%;">
						<textarea class="textarea input" name="description" style="height:250px;">{description}</textarea>
						</div>
					</div>
				</div>
			</div>

			<div class="right-box">
				<div class="panel" style="display: none;">
					<p class="panel-heading">
						<img src="{sourceURL}/media/web-icon/cb.png">
						<span class="title"> Discussion</span>
					</p>
					<div class="panel-body">
						<p style="margin-bottom: 5px;margin-top: -10px;"><input type="checkbox" name="attach_forum" value="1" {check_forum} onClick="
							if($(this).is(':checked')){
								$('#fd').prop('disabled',false);
							}else{
								$('#fd').prop('disabled',true);
								$('#fd').val('');
							}"> Enable Discussion</p>
						
						<input type="text" name="forum_title"  id="fd" class="input" placeholder="Title" style="width: 93%" value="{forum_title}" {title-status}>
					</div>
				</div>

				<div class="panel">
					<p class="panel-heading">
						<img src="{sourceURL}/media/web-icon/paper.png">
						<span class="title"> Attach File</span>
					</p>
					<span id="attach-list">{attach_list}</span>
					<input type="text" class="attach-list" name="attach_file" value="{attach_file}" style="display: none;">
					
					<div class="panel-body">
						<input type="file" id="attach-file" class="input" style="width: 93%;margin-top: -10px;">
						<p style="color:#666;font-size:10px;margin-top: 0px;">* Allowed Type : Zip, Pdf, Doc, Ppt, Xls</p>
						<input type="text" id="attach-name" class="input" placeholder="Optional File Name" style="width: 93%">
						<button id="btn-loading" onClick="return attach_files()" class="btn-default" type="button" style="width: 100%;margin-left:0px;">Upload</button>
					</div>
				</div>

				<div class="panel">
					<div class="panel-body">
						<button class="btn" style="width: 100%;margin-left:0px;">Save</button>
					</div>
				</div>

			</div>

			
		</form>
	</div>
</div>