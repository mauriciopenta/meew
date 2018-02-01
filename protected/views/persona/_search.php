<?php
/* @var $this PersonaController */
/* @var $model Persona */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_persona'); ?>
		<?php echo $form->textField($model,'id_persona'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_doc'); ?>
		<?php echo $form->textField($model,'id_doc'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'persona_doc'); ?>
		<?php echo $form->textField($model,'persona_doc',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'persona_nombre'); ?>
		<?php echo $form->textField($model,'persona_nombre',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'persona_apellidos'); ?>
		<?php echo $form->textField($model,'persona_apellidos',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'persona_correo'); ?>
		<?php echo $form->textField($model,'persona_correo',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_genero'); ?>
		<?php echo $form->textField($model,'id_genero'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_rango_edad'); ?>
		<?php echo $form->textField($model,'id_rango_edad'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->