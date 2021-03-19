<div class="panel" id="sec-{id}">
	<p class="panel-heading" style="font-family: Segoe UI Bold">
		Section {number} : {title} {section_display}

		<a href="javascript:void(0)" style="float:right;margin-right:0px;" 
			onclick="

				if($('#section-{id}').css('display') == 'none'){
					$('#bg-section').show();
					$('.popup-section').hide();
					$('#section-{id}').show();

				}else{

					$('#section-{id}').hide();
				}

		">
				
			<img style="position:relative;right:0px;" src="{sourceURL}/media/web-icon/cog.png" width="25">
			
			<img src="{sourceURL}/media/web-icon/chevron-bottom.png" style="width:12px;position:relative;top:-2px;">
				
		</a>

		<div id="section-{id}" class="popup-section">
			<p style="padding:5px;margin-top:0px;">
				<a href="{homeURL}/activity/update_section?id={id}" <?php SPA_attribute()?>>
					Edit Section
				</a>
			</p>

				
			<p style="padding:5px;margin-top:-20px;">
				<a href="{homeURL}/activity/new_quiz?id={id}&new=true" <?php SPA_attribute()?>>
						Create Quiz
				</a>
			</p>

			<p style="padding:5px;margin-top:-20px;margin-bottom:0px;">
				<a href="javascript:void(0)" onclick="

					$('#section-{id}').hide();
					$('#bg-section').hide();
					delete_teacher('{id}-section');
					$('.delete-verif form').attr('redirect', $('.delete-verif form').attr('redirect2'));

				">
					Delete
				</a>
			</p>

		</div>

	</p>
	<div style="padding: 10px">
		<p style="margin-top: -25px;">{description}</p>
		<div style="margin-top:40px;">{html}
		
		<p style="text-align:right;font-size:13px;margin-right:10px">
		    <a href="{homeURL}/activity/new_quiz?id={id}&new=true" <?php SPA_attribute()?>>Add New Quiz</a> · 
		      <a href="javascript:void(0)" onclick="
		      $('.form-upload').hide();
		      $('#topic-{id}').fadeIn();
		      ">Import Quiz</a> · 
		    <a href="{homeURL}/activity/update_section?id={id}" <?php SPA_attribute()?>>Upload Document</a>
		</p>
		</div>
	</div>
	
	<div id="topic-{id}" style="padding:10px;border-top:2px #ddd dashed;display:none" class="form-group form-upload" >
	    <p style="font-family:'Segoe UI Bold';font-size:14px;">Import Quiz</p>
	    <form method="POST" anctype="multipart/form-data" action="{homeURL}/activity/export_quiz" redirect="{documentURL}" style="margin-top:-10px;" onsubmit="return submit_form(this)">
	        <input type="file" name="file" class="input" style="width:93%">
	        <button class="btn-default" style="margin-left:0px">Import Quiz</button>
	        <input type="text" name="topic_id" value="{id}" style="display:none;">
	    </form>
	</div>
</div>