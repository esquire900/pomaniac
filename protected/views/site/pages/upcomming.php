<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Upcomming';
?>
<div class="row">
	<div class="col-lg-8 center">
		<h1><center>In the production @ <span class="logo">Po<span class="maniac">maniac</span></span></center></h1>
		<img class="img-thumbnail" src="<?php echo Yii::app()->request->baseUrl; ?>/images/clock.jpg" alt="" style="width:180px;float:right; margin-left: 20px; margin-bottom:100px">
		<p>While the <span class="logo">Po<span class="maniac">maniac</span></span> site base is done, I'm currently working
		on some new feauters:</p>
		<sl>
			<li>Going Mobile</li>
			<li>Stats Page</li>
			<li>Desktop App</li>
			<li>And more?</li>
		</sl>
		<br><br>
		<p><b>Going Mobile</b><br>
		Going mobile is one of the main points right now.
		The mobile app is in development, and can be viewed at <a href="<?php echo Yii::app()->request->baseUrl; ?>/m" ><?php echo Yii::app()->request->baseUrl; ?>/m</a>
		Whenever there is time (and money to buy the crushing $99 apple program), i'll finish the mobile app and deploy it by phonegap.
		</p><br>
		<p><b>Stats Page</b><br>
		A stats page where all your statistics about your workflow can be vieuwed (for example, how long you've been working on certain #hashtags,
		when you work most productive, etc). This should understand and improve your own workflow.
		</p><br>
		<p><b>Desktop App</b><br>
		Sort of speaks for itself. Not very high priority.
		</p><br>
		<p><b>More?</b><br>
		Got some tips or ideas? Don't be afraid to share. Sharing is good. As long as it's not on facebook. ;)s
		</p>
	</div>

</div>
