function readURL(input) {

	var target = $(input).attr("target");

 	if (input.files && input.files[0]) {

	    var reader = new FileReader();
	    
	    reader.onload = function(e) {

	    	var mime = input.files[0].type;
	    		mime = mime.split("/");
	    		mime = mime[1].toLowerCase();

	    	var ext = ["jpg","png","jpeg"];

	    	for(var i = 0; i < ext.length; i++){

	    		if(mime == ext[i]){

	    			$(target).attr("src",e.target.result);
	    			break;

	    		}

	    	}
	    }
    
  		reader.readAsDataURL(input.files[0]);
  	}
}

function browse_image(id = null){

	$(id).click();

}

function open_edit(id = ""){

	var base_url = $("meta[property=\"url\"]").attr("content");

	if($(".edit-"+id).css("display") == "none"){
		$(".box-edit").hide();
		$(".edit-"+id).show();
		$(".right-img").attr("src",base_url+"/sources/media/web-icon/chevron-bottom.png");
		$(".img-"+id).attr("src",base_url+"/sources/media/web-icon/chevron-top.png");
	}else{
		$(".edit-"+id).hide();
		$(".img-"+id).attr("src",base_url+"/sources/media/web-icon/chevron-bottom.png");
	}

}


function remove_browse(id_input, id_image, object){

	$(id_input).val("");

	$(id_image).attr("src", $(object).attr("img"));
}

function delete_teacher(nidn = ""){
	$(".background-float-box").show();
	$(".delete-verif").show();
	$("#float-del-user").val(nidn);
}

function delete_faculty(id = "", url = null){
	
	var base_url = $("meta[property=\"url\"]").attr("content");

	$(".form-faculty").attr("action",base_url+"/faculty/"+url);

	$(".background-float-box").show();
	$(".delete-verif").show();
	$("#float-del-user").val(id);
}

function close_float_box(id = ""){
	$("."+id).hide();
	$("."+id+" input").val("");
	$(".background-float-box").hide();
}

function checkbox(object){
	
	var id = $(object).attr("target");

	$(id).prop("checked",false);

	$(object).prop("checked",true);

}

function multiselect(e){

	if($(e).attr("class") == "multiselect-master"){

		if($(e).is(":checked") == true){

			$(".multiselect").prop("checked",true);

		}else{
			
			$(".multiselect").prop("checked",false);			
		}

	}else{

		if($(e).is(":checked") == false){

			$(".multiselect-master").prop("checked", false);

		}

	}

}

function reload_quiz(object){

	var base_url = $("meta[property=\"url\"]").attr("content")+"/activity/tmp_quiz";

	$.ajax({

		url : base_url,
		type : "POST",
		data : {
			index : $(object).attr("name"),
			value : $(object).val()
		}
	});
}

function select_palce(object){

	var province = $("select[name='province']");
	var district = $("select[name='district']");
	var village = $("select[name='village']");
	var postal_code = $("select[name='postal_code']");
	var base_url = $("meta[property=\"url\"]").attr("content");

	var url = base_url+"/setting/select_place";

	if($(object).attr("name") == "province") 
		var param = {
			province : province.val()
		}

	if($(object).attr("name") == "district") 
		var param = {
			province : province.val(),
			district : district.val()
		}

	if($(object).attr("name") == "village") 
		var param = {
			province : province.val(),
			district : district.val(),
			village : village.val()
		}

	if($(object).attr("name") == "postal_code") 
		var param = {
			province : province.val(),
			district : district.val(),
			village : village.val(),
			postal_code : postal_code.val()
		}

	$.ajax({

		url : url,
		type : "POST",
		data : param,
		success : function(data){

			var JsonData = data;

			province.replaceWith(JsonData.provinsi);
			district.replaceWith(JsonData.kabupaten);
			village.replaceWith(JsonData.kecamatan);
			postal_code.replaceWith(JsonData.kodepos);

		},
		error : function(){
			$('#text-alert').html('Connection Timeout');
			$('.alert-box').show();
		}

	});

}

function select_faculty(object){

	var faculty = $("select[name='faculty']");
	var major = $("select[name='major']");
	var base_url = $("meta[property=\"url\"]").attr("content");

	var url = base_url+"/faculty/select_education";

	if($(object).attr("name") == "faculty") 
		var param = {
			faculty : faculty.val()
		}

	if($(object).attr("name") == "major") 
		var param = {
			faculty : faculty.val(),
			major : major.val()
		}


	$.ajax({

		url : url,
		type : "POST",
		data : param,
		success : function(data){

			var JsonData = data;

			faculty.replaceWith(JsonData.select_faculty);
			major.replaceWith(JsonData.select_major);

		},
		error : function(){
			$('#text-alert').html('Connection Timeout');
			$('.alert-box').show();
		}

	});

}


function select_course(object){

	var base_url = $("meta[property=\"url\"]").attr("content");
	var url = base_url+"/courses/list_courses";

	if($(object).val() !== ""){

		$(".course-select-box").show();
		$(".selected-course").hide();

		$.ajax({

			url : url,
			type : "GET",
			data : {
				q : $(object).val()
			},
			success : function(data){

				var JsonData = data;

				var html = "";

				var sum = 1;

				$.each(JsonData, function(index, item) {

					if(index !== "response")
					html += list_course_html(index, item);

					sum += 1;

				});

				if(sum == 1) html += "<div class='list' style='text-align:center;font-size:14px;'>Not Found</div>";

				$(".course-select-box").html(html);


			},
			error : function(){
				$('#text-alert').html('Connection Timeout');
				$('.alert-box').show();
			}

		});

	}else{

		$(".course-select-box").hide();
		$(".selected-course").show();

	}

}

function list_course_html(index, item) {
  	
  	var data = '<div class="list ellipsis" data="'+item+'" index="'+index+'" onClick="return select_this_course(this)"><span class="breadcum" title="'+item+'">'+index+'</span> '+item+'</div>';

  	return data;

}

function select_this_course(a){

	var index = $(a).attr('index');
	var value = $(a).attr('data');

	$(".course-select-box").hide();
	$(".selected-course").show();

	$(".input-course").val("");

	var course = $("#course_data");

	var course_array = course.val().split(",");

	if(jQuery.inArray(index, course_array) == -1){

		course_array.push(index);

		course.val(course_array);

		var data = list_course_html2(index, value);
	
		$(".selected-course").append(data);

	}

}

function remove_course(a){	

	var index = $(a).attr("index");

	var course = $("#course_data");

	var course_array = course.val().split(",");

	build = [];

	for(var i = 0; i < course_array.length; i++){

		if(course_array[i] !== index){

			build.push(course_array[i]);
			
		}

	}

	$("p[index='"+index+"']").remove();

	course.val(build);
}

function list_course_html2(index, item) {

	var base_url = $("meta[property=\"url\"]").attr("content");
  	
  	var data = '<p class="ellipsis" index="'+index+'" style="margin-left:10px" onClick="return remove_course(this)"><img src="'+base_url+'/media/web-icon/times.png" width="10" style="margin-right:10px;cursor:pointer" index="'+index+'" onClick="return remove_course(this)"><span class="breadcum" title="'+item+'">'+index+'</span> '+item+'</p>';

  	return data;

}

function remove_file(obj){
	$(obj).parent().remove();
	var new_data = $(".attach-list").val().replace("/"+$(obj).attr("realname"), "");
	$(".attach-list").val(new_data);
}

function html_choice_themplate(){

	var base_url = $("meta[property=\"url\"]").attr("content");

	var index = $(".select-ans").length;

	var value = $('#multiple-choice5').val();
		value = value.replace(/"/g,'');

	var html = '<p class="check-box select-ans">\
	<input type="checkbox" name="true_answer[]" class="pilih" target=".pilih" value="'+value+'" onclick="checkbox(this)">'+value+'\
	<img src="'+base_url+'/sources/media/web-icon/times.png" width="10"\
	 style="cursor:pointer;float:right;margin-top:5px;" onClick="remove_choice(this)">\
	';

		html += '<input type="text" name="multiple_choice[]" value="'+value+'" style="display:none"></p>';

	$('#multiple-choice4').append(html);

	$('#multiple-choice5').val('');
}

function htm_match_choice(){

	if(($("#question").val() !== "") && ($("#answer").val() !== "") ){

	var html ='<div class="match-choice">\
				<textarea class="input" name="mc_question[]" placeholder="Question">'+$("#question").val()+'</textarea>\
				<input type="text" class="input" name="true_answer[]" placeholder="Answer" style="border:1px #763996 solid" value="'+$("#answer").val()+'">\
			</div>';

	$("#question").val("");
	$("#answer").val("");

	$("#match-choice").append(html);

	}

}

function remove_choice(object){
	$(object).parent().remove();

}

function submit_form(object){

	if($(object).attr("form") !== "false")
	var formData = new FormData(object);
	else
	var formData = "";

	var url = $(object).attr("redirect");
	var button_original_text = $(".btn-loading").html();

    $.ajax({
        url: $(object).attr("action"),
        type: $(object).attr("method"),
        data: formData,
        beforeSend : function(){
        	$(".btn-loading").html("Please Wait");
        	$(".btn-loading").prop("disabled",true);
        },
        success: function (data) {
            
            if(data.length > 0){

            	$(".alert-box").show();
            	$("#text-alert").html(data);
            	$(".alert-btn").focus();
                $(".btn-loading").html("Try Again");
            }else if(url !== "") move_page(url);
            
            $(".btn-loading").prop("disabled",false);

        },
        error : function(){
        	$(".btn-loading").html(button_original_text);
        	$(".btn-loading").prop("disabled",false);
        	$('#text-alert').html('Connection Timeout');
			$('.alert-box').show();
        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;

}

function attach_files(file_path = ""){

	var button_original_text = $("#btn-loading").html();

	var base_url = $("meta[property=\"url\"]").attr("content");

	var object = $("#attach-file");

	formdata = new FormData();

    if(object.prop('files').length > 0) {

        var file = object.prop('files')[0];

        formdata.append("attach", file);
    }

    formdata.append("title", $("#attach-name").val());
    formdata.append("regulator", file_path);

    var mime = object.val().split(".");
    	mime = mime[mime.length - 1];

	var ext = ["pdf","doc","docx","ppt","pptx","xls","xlsx","zip"];
	var response = 0;
	for(var i = 0; i < ext.length; i++){

		if(mime == ext[i]){

			response = 1;

		}

	}

	if(response == 0){
		$('#text-alert').html('Not Allowed To Upload'+mime);
		$('.alert-box').show();
		return false;
	}

	if(file_path == "") var target_url = base_url+"/activity/tmp_upload";
	else var target_url = base_url+"/my_courses/tmp_upload";

    $.ajax({
        url: target_url,
        type: "POST",
        data: formdata,
        processData: false,
    	contentType: false,
        beforeSend : function(){
        	$("#btn-loading").html("Please Wait");
        	$("#btn-loading").prop("disabled",true);
        	$("#attach-name").prop("disabled", true);
        	$("#attach-file").prop("disabled", true);
        },
        success : function(event){

        	if(event !== ""){

	        	$('#text-alert').html(event);
				$('.alert-box').show();

        	}else{

        		if($("#attach-name").val() !== ""){
        			var new_name = $("#attach-name").val()+"."+mime;
        			var real_name = new_name;
        		}else{
        			var new_name = $("#attach-file").val().split('\\');
        				new_name = new_name[new_name.length - 1];
        				new_name = new_name.split(".");
        				var real_name = new_name[0]+"."+mime;
        				new_name = new_name[0].substring(0,15)+"."+mime;
        		}


        		var html = '<p style="border:1px #ddd dashed;padding: 5px;margin:10px;color:#666">';
        			html += '<img src="'+base_url+'/sources/media/web-icon/'+mime+'.png" width="18"> '+new_name;
					html += '<img realname="'+real_name+'" src="'+base_url+'/sources/media/web-icon/times.png" width="10" style="cursor:pointer;float:right;margin-top:5px;" onClick="return remove_file(this)">';
					html += '</p>';

				$("#attach-list").append(html);

				$(".attach-list").val($(".attach-list").val()+"/"+real_name);
        	}

        	$("#btn-loading").html(button_original_text);
	        $("#btn-loading").prop("disabled",false);
        	$("#attach-name").prop("disabled", false);
        	$("#attach-file").prop("disabled", false);
        	object.val('');
        	$("#attach-name").val('');
        },
        error : function (){
        	$("#btn-loading").html(button_original_text);
        	$("#btn-loading").prop("disabled",false);
        	$('#text-alert').html('Connection Timeout');
			$('.alert-box').show();
        }

	});
}


function tinyMCE(){
	tinymce.init({
	  selector: '.textarea',
	  plugins: ['autolink','image','link','lists','hr','paste','image','media','contextmenu','code','responsivefilemanager'],
	  paste_as_text: true,
	  menubar : 'edit insert format',
	  toolbar: ['bold italic underline | numlist bullist | codesample | link image media | responsivefilemanager'],
	  default_link_target: "_blank",
	  external_filemanager_path:"../sources/js/responsive_filemanager/filemanager/",
	  filemanager_title:"My Repository" ,
	  setup: function (editor) {
	  	 editor.on('keyup', function () {
	  	 	editor.save();
	  	 	console.log(editor.getContent());
	  	 });
	  	 editor.on('change', function () {
	  	 	editor.save();
	  	 });

	  	 editor.on('submit', function () {
	  	 	editor.save();
	  	 });
	  }
	});
}

function time_limit(time_limit){

	// Set the date we're counting down to
	var countDownDate = new Date((time_limit * 1000)).toUTCString();
	var countDownDate = new Date(countDownDate).getTime();

	// Update the count down every 1 second
	var x = setInterval(function() {

	  // Get today's date and time
	  var now = new Date().getTime();
	    
	  // Find the distance between now and the count down date
	  var distance = countDownDate - now;
	    
	  // Time calculations for days, hours, minutes and seconds
	  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
	    
	  // Output the result in an element with id="demo"

	  if(days > 1) var waktu = days + " Days";
	  else if(days >= 1) var waktu = days + " Days " + hours + " Hours";
	  else if(hours > 0) var waktu = hours + " : " + minutes + " Minutes";
	  else{

	  	var waktu = minutes + " : " +seconds +" Seconds";

	  	if(minutes < 1) $(".time-limit").addClass("false-answer");

	  }

	  document.getElementById("time_limit").innerHTML = waktu;
	    
	  // If the count down is over, write some text 

	  if($(".loading").css("display") !== "none") clearInterval(x); 

	  if (distance < 0) {
	    clearInterval(x);
	    document.getElementById("time_limit").innerHTML = "EXPIRED";
	    $(".confirm-box input").prop("checked", true);
	    $(".submit-btn").click();
	  }
	}, 1000);

}

