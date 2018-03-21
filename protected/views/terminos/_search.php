<?php
/* @var $this TerminosController */
/* @var $model Terminos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idterminos'); ?>
		<?php echo $form->textField($model,'idterminos'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'terminos'); ?>
		<?php echo $form->textArea($model,'terminos',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_aplicacion'); ?>
		<?php echo $form->textField($model,'id_aplicacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo'); ?>
		<?php echo $form->textField($model,'tipo',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->