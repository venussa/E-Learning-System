<!-- NAVIGATION BAR -->
<div id="bg-profile" style="display:none;width: 100%;height: 100%;position: fixed;top:0px;left:0px;z-index: 997;" onclick="
	$('.popup-profile').hide();
	$('#bg-profile').hide();
"></div>
<div class="navigation-bar">
	<div class="left">
		
		<a href="{homeURL}" <?php SPA_attribute()?>>
			<img class="logo" src="{sourceURL}/media/web-image/logo-white.png">
		</a>

		
	</div>

	<div class="right">
		<span class="username" style="cursor: pointer;" onclick="
			if($('.popup-profile').css('display') == 'none'){
				$('.popup-profile').show();
				$('#bg-profile').show();
			}else{
				$('.popup-profile').hide();
				$('#bg-profile').hide();
			}
		">
			<?php echo userData()['first_name']?> <?php echo userData()['last_name']?>
			<img class="profile" src="{sourceURL}/media/user-picture/<?php echo userData()['profile_pict']?>">
		</span>
		<!-- <span class="username">
			<img class="bell" src="{sourceURL}/media/web-image/bell.png">
			<div>5</div>
		</span> -->

		<div class="popup-profile">
			<a href="{homeURL}/profile" <?php SPA_attribute()?>>
				<p style="margin-top: 5px;">
					<img src="{sourceURL}/media/web-icon/users.png" style="width: 20px;margin-top:2px;position: absolute;">
					<span style="margin-left: 30px;">My Profile</span>
				</p>
			</a>

			<a href="{homeURL}/profile/preference" <?php SPA_attribute()?>>
				<p>
					<img src="{sourceURL}/media/web-icon/cog.png" style="width: 20px;margin-top:2px;position: absolute;">
					<span style="margin-left: 30px;">Preference</span>
				</p>
			</a>

			<a href="{homeURL}/profile/logout" <?php SPA_attribute()?>>
				<p>
					<img src="{sourceURL}/media/web-icon/logout.png" style="width: 20px;margin-top:2px;position: absolute;">
					<span style="margin-left: 30px;">Logout</span>
				</p>
			</a>
		</div>
		
	</div>

</div>
<!-- END NAVIGATION BAR -->

<!-- SIDE BAR -->
<div class="side-bar-left">
	<ul class="menu">

		<li <?php menu("")?>>
			<a href="{homeURL}/" <?php SPA_attribute()?>>
				<img src="{sourceURL}/media/web-icon/home.png"><span>Dashboard</span>
			</a>
		</li>

		<?php if((userData()["user_type"] == "student")){ ?>
		<li <?php menu("my_courses")?>>
			<a href="{homeURL}/my_courses" <?php SPA_attribute()?>>
				<img src="{sourceURL}/media/web-icon/courses.png"><span>Courses</span>
			</a>
		</li>

		<li <?php menu("my_grade")?>>
			<a href="{homeURL}/my_grade" <?php SPA_attribute()?>>
				<img src="{sourceURL}/media/web-icon/grade.png"><span>Grade</span>
			</a>
		</li>
		<?php } ?>

		<?php if((userData()["user_type"] == "teacher") and (userData()["level"] >= 1)){ ?>
		<li <?php menu("courses")?>>
			<a href="{homeURL}/courses" <?php SPA_attribute()?>>
				<img src="{sourceURL}/media/web-icon/courses.png"><span>Courses</span>
			</a>
		</li>
		<?php } ?>

		<?php if((userData()["user_type"] == "teacher") and (userData()["level"] >= 0)){ ?>
		<li <?php menu("activity")?>>
			<a href="{homeURL}/activity" <?php SPA_attribute()?>>
				<img src="{sourceURL}/media/web-icon/blog.png"><span>Activity</span>
			</a>
		</li>
		<?php } ?>

		<?php if((userData()["user_type"] == "teacher") and (userData()["level"] >= 1)){ ?>
		<li <?php menu("faculty")?>>
			<a href="{homeURL}/faculty" <?php SPA_attribute()?>>
				<img src="{sourceURL}/media/web-icon/faculty.png"><span>Faculty</span>
			</a>
		</li>
		<?php } ?>

		<?php if((userData()["user_type"] == "teacher") and (userData()["level"] >= 0)){ ?>
		<li <?php menu("teacher")?>>
			<a href="{homeURL}/teacher" <?php SPA_attribute()?>>
				<img src="{sourceURL}/media/web-icon/teacher.png"><span>Teacher</span>
			</a>
		</li>

		<li <?php menu("student")?>>
			<a href="{homeURL}/student" <?php SPA_attribute()?>>
				<img src="{sourceURL}/media/web-icon/student.png"><span>Student</span>
			</a>
		</li>
		<?php } ?>

		<?php if((userData()["user_type"] == "teacher") and (userData()["level"] >= 1)){ ?>
		<li <?php menu("setting")?>>
			<a href="{homeURL}/setting" <?php SPA_attribute()?>>
				<img src="{sourceURL}/media/web-icon/cog.png">
				<span>Setting</span>
			</a>
		</li>
		<?php } ?>
	</ul>

	<div class="footer">
		2020 &copy; E-Learning
	</div>
</div>
<!-- END SIDE BAR -->