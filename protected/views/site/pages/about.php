<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<div class="row">
	<div class="col-lg-6">
		<h1><center>About <span class="logo">Po<span class="maniac">maniac</span></span></center></h1>
				<img class="img-thumbnail" src="<?php echo Yii::app()->request->baseUrl; ?>/images/clock.jpg" alt="" style="width:180px;float:right; margin-left: 20px; margin-bottom:100px">
		<p>Not too much to tell here. I made this webapp because I believe most of the others don't fully function by the pomodoro technique standards.
		I hope this one does :) <br><br>If you don't agree with me, like to see stuff added or changed or whatever, don't fear to contact me at the contact page!</p>
	</div>
	<div class="col-lg-6">
		<div style="margin-top:280px"></div>
		<h1><center>About <span class="logo">le<span class="maniac">creator</span></span></center></h1>
		<img class="img-thumbnail" src="<?php echo Yii::app()->request->baseUrl; ?>/images/awesome-small.jpg" alt="" style="width:200px;float:left; margin-right: 20px; margin-bottom:100px">
		I'm simon and I do unbelievably fascinating shit. Do not ever visit my <a href="http://simonnouwens.org">website</a> as
		all you know will never be the same again. <br><br>Well maybe it will still be. <br><br>It probably will.</span>
	</div>
</div>
