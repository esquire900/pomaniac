<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>

<h1><center class="logo">Contact</center></h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<div class="row">
	<div class="col-lg-8 center">
		<blockquote class="pull-right">
			<h4>"If you have business inquiries or other questions, please fill out the following form to contact us. Thank you."</h4>
		</blockquote>
		Is what my framework suggested to write here. In this case, i'll also allow contact messages from someone with a nice story. I like
		nice stories :) <br><br><br>

		
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'contact-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>

			<?php echo $form->errorSummary($model); ?>

			<?php echo $form->textField($model,'name', array('placeholder' => 'Your Name', 'class' => 'form-control name')); ?>
			<?php echo $form->error($model,'name'); ?>

			<?php echo $form->textField($model,'email', array('placeholder' => 'Email', 'class' => 'form-control email')); ?>
			<?php echo $form->error($model,'email'); ?>

			<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128, 'placeholder' => 'Subject', 'class' => 'form-control')); ?>
			<?php echo $form->error($model,'subject'); ?>

			<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50, 'placeholder' => 'Le message', 'class' => 'form-control')); ?>
			<?php echo $form->error($model,'body'); ?>

			<?php if(CCaptcha::checkRequirements()): ?>
				<br>
				<b><center>Please prove you're not a brain-eating zombie or any other not-living creature</b>(not case-sensitive)
				<div>
				<?php $this->widget('CCaptcha'); ?>
								<br><br>
				<?php echo $form->textField($model,'verifyCode', array('placeholder' => 'The code from above', 'class' => 'form-control')); ?>
				</div>
				</center>
				<?php echo $form->error($model,'verifyCode'); ?>
			<?php endif; ?>

			<?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-work')); ?>

		<?php $this->endWidget(); ?>
	</div>
</div>





<?php endif; ?>