<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',

	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array( 
		'class'=>'col-lg-5')
)); ?>
	<fieldset>
    <legend>Login</legend>
		<?php echo $form->textField($model,'username', array('class' => 'form-control', 'placeholder' => 'Username', 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>

		<?php echo $form->passwordField($model,'password', array('class' => 'form-control', 'placeholder' => 'Password', 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'password'); ?>

		<?php echo $form->hiddenField($model,'rememberMe',  array('value' => 1)); ?>
		<?php echo $form->error($model,'rememberMe'); ?>

		<?php echo CHtml::submitButton('Login', array('class' => 'btn btn-primary')); ?>
	</fieldset>
<?php $this->endWidget(); ?>
</div><!-- form -->
