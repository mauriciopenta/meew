<?php
/* @var $this ModuloAppController */
/* @var $model ModuloApp */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'modulo-app-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_modulo'); ?>
		<?php echo $form->textArea($model,'nombre_modulo',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'nombre_modulo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'texto_html'); ?>
		<?php echo $form->textArea($model,'texto_html',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'texto_html'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_modulo'); ?>
		<?php echo $form->textField($model,'tipo_modulo'); ?>
		<?php echo $form->error($model,'tipo_modulo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'aplicacion_idaplicacion'); ?>
		<?php echo $form->textField($model,'aplicacion_idaplicacion'); ?>
		<?php echo $form->error($model,'aplicacion_idaplicacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'aplicacion_usuario_id_usuario'); ?>
		<?php echo $form->textField($model,'aplicacion_usuario_id_usuario'); ?>
		<?php echo $form->error($model,'aplicacion_usuario_id_usuario'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->