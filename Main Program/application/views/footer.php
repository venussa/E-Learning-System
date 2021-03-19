
</div> <!-- SPA content -->
</div> <!-- SPA container -->
</div> <!-- web content -->
<script>

	$(document).ready(function(){
		tinyMCE();
		setTimeout(function(){

			$("#web-content").show();
			$(".loading").hide();

			if($('#time_limit').length)
			time_limit('{time_finish}');

		},2000);

		$('.side-bar-left').css({'height' : ($(window).height() - 80)+'px'});

		$(".login-background").css({
			"height": $(window).height()+"px"
		});


		$(window).resize(function(){

			$(".login-background").css({
				"height": $(window).height()+"px"
			});

			$(".main-container .content").css({

				"width" : $(window).width() - ($(".side-bar-left").width()+70)+"px"

			});

			$(".side-bar-left").css({
				"height" : ($(window).height() - 80)+"px"
			});

		});

	});

</script>

</body>
</html>