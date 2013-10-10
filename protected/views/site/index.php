<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1 class="logo" style="font-size: 4em"><center>Po<span class="maniac">maniac</span></center></h1>
<blockquote class="pull-right">
<p>The last pomodoro app you'll ever use</p>
</blockquote>
<br><br><br><br>
<div class="row">
	<div class="col-lg-7">
		<h1>The f*ck is a pomodoro?</h1>
		<p>Are you a student or freelancer who finds him/her/it self distracted more then doing what you're supposed to?
		The pomodoro is a motivation and focus technique which actually works (according to me and quite some others). 
		Not sure why they called it pomodoro, which is Spanish for tomato. Well at least it's healthy I guess. <br>
		<br>
		Check out this video if you're a first-timer, otherwise, get cracin' and become a pomaniac!

		</p>
		<iframe width="460" height="315" src="//www.youtube.com/embed/9KH084K8cfs" frameborder="0" allowfullscreen></iframe>
	</div>
	<div class="col-lg-5" style="margin-top:150px">
		<button class="btn btn-primary btn-mainpage" onClick="parent.location='page.html'">
			<a href=""><i class="icon-facebook-sign icon-large"></i>Log in with Facebook</a>
		</button>
		<button class="btn btn-primary btn-mainpage" onClick="parent.location='<?php echo Yii::app()->createUrl('user/registration'); ?>'">
			Register
		</button><br>
		<button class="btn btn-primary btn-mainpage" onClick="parent.location='<?php echo Yii::app()->createUrl('login'); ?>'">
			Login
		</button><br>
	</div>
</div>
