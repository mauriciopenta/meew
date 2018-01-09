<?php
/* @var $this MContactoController */
/* @var $model MContacto */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_mcontacto'); ?>
		<?php echo $form->textField($model,'id_mcontacto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mcontacto_mensaje'); ?>
		<?php echo $form->textArea($model,'mcontacto_mensaje',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'asunto'); ?>
		<?php echo $form->textArea($model,'asunto',array('rows'=>6, 'cols'=>50)); ?>
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
		<?php echo $form->label($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'respuesta'); ?>
		<?php echo $form->textField($model,'respuesta',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->