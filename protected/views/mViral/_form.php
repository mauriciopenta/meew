<?php
/* @var $this MViralController */
/* @var $model MViral */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mviral-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'mviral_url_fb'); ?>
		<?php echo $form->textArea($model,'mviral_url_fb',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'mviral_url_fb'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mviral_url_tw'); ?>
		<?php echo $form->textArea($model,'mviral_url_tw',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'mviral_url_tw'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mviral_url_inst'); ?>
		<?php echo $form->textArea($model,'mviral_url_inst',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'mviral_url_inst'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'correo_contacto'); ?>
		<?php echo $form->textArea($model,'correo_contacto',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'correo_contacto'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->