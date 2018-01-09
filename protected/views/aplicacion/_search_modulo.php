<?php
/* @var $this ModuloAppController */
/* @var $model ModuloApp */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_modulo_app'); ?>
		<?php echo $form->textField($model,'id_modulo_app'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre_modulo'); ?>
	</div>




	<div class="row">
		<?php echo $form->label($model,'texto_html'); ?>
		<?php echo $form->textArea($model,'texto_html',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_modulo'); ?>
		<?php echo $form->textField($model,'tipo_modulo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aplicacion_idaplicacion'); ?>
		<?php echo $form->textField($model,'aplicacion_idaplicacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aplicacion_usuario_id_usuario'); ?>
		<?php echo $form->textField($model,'aplicacion_usuario_id_usuario'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->