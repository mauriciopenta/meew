<?php
/* @var $this MViralController */
/* @var $model MViral */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_mviral'); ?>
		<?php echo $form->textField($model,'id_mviral'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mviral_url_fb'); ?>
		<?php echo $form->textArea($model,'mviral_url_fb',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mviral_url_tw'); ?>
		<?php echo $form->textArea($model,'mviral_url_tw',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mviral_url_inst'); ?>
		<?php echo $form->textArea($model,'mviral_url_inst',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aplicacion_idaplicacion'); ?>
		<?php echo $form->textField($model,'aplicacion_idaplicacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aplicacion_usuario_id_usuario'); ?>
		<?php echo $form->textField($model,'aplicacion_usuario_id_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'correo_contacto'); ?>
		<?php echo $form->textArea($model,'correo_contacto',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->