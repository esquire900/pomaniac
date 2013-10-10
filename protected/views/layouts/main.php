<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php //Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	<?php //Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>
	<script type="text/javascript" src="/pomodoro/assets/35b7a687/jquery.js"></script>
	<script type="text/javascript" src="/pomodoro/assets/35b7a687/jui/js/jquery-ui.min.js"></script>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css" rel="stylesheet">
	 
	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/flipclock/css/flipclock.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>
<body>
	<!-- Fixed navbar -->
    <div class="navbar navbar-fixed-top">
      <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo Yii::app()->request->baseUrl; ?>"><div class="logo" style="margin-right:30px">Po<span class="maniac">maniac</span></div></a>
        <div class="nav-collapse collapse">
          <ul class="nav navbar-nav pull-left">
            <?php if(!Yii::app()->user->isGuest){ ?>
              <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/pomodoro/index">Pomodoro</a></li>
            <?php } ?>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/upcomming">Upcomming Awesomeness</a></li> 
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/about">About</a></li> 
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/contact">Contact</a></li> 
          </ul>
          <ul class="nav navbar-nav pull-right">
            <?php if(Yii::app()->user->isGuest){ ?>
            	<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/login">Login</a></li> 
            <?php }else{ ?>
              <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/profile"><?php echo Yii::app()->user->name; ?></a></li> 
				      <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/logout">Logout</a></li> 
			       <?php } ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="clearme" style="height:70px"></div>

	
	<div class="container">
		<?php echo $content; ?>
	</div>

		<div class="clear"></div>

		<div id="footer">
      <div class="container" style="padding-top:10px">
        <p class="text-muted credit">Credits to me© 2013.</p>
      </div>
    </div>
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>

</body>
</html>
