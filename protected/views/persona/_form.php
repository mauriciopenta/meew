<?php
/* @var $this PersonaController */
/* @var $model Persona */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'persona-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_doc'); ?>
		<?php echo $form->textField($model,'id_doc'); ?>
		<?php echo $form->error($model,'id_doc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'persona_doc'); ?>
		<?php echo $form->textField($model,'persona_doc',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'persona_doc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'persona_nombre'); ?>
		<?php echo $form->textField($model,'persona_nombre',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'persona_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'persona_apellidos'); ?>
		<?php echo $form->textField($model,'persona_apellidos',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'persona_apellidos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'persona_correo'); ?>
		<?php echo $form->textField($model,'persona_correo',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'persona_correo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_genero'); ?>
		<?php echo $form->textField($model,'id_genero'); ?>
		<?php echo $form->error($model,'id_genero'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_rango_edad'); ?>
		<?php echo $form->textField($model,'id_rango_edad'); ?>
		<?php echo $form->error($model,'id_rango_edad'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->