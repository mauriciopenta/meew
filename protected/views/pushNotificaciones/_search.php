<?php
/* @var $this PushNotificacionesController */
/* @var $model PushNotificaciones */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idpush_notificaciones'); ?>
		<?php echo $form->textField($model,'idpush_notificaciones'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cuerpo'); ?>
		<?php echo $form->textField($model,'cuerpo',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genero'); ?>
		<?php echo $form->textField($model,'genero',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'edad'); ?>
		<?php echo $form->textField($model,'edad',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_aplicacion'); ?>
		<?php echo $form->textField($model,'id_aplicacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_modulo'); ?>
		<?php echo $form->textField($model,'id_modulo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->