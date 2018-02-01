<?php
/* @var $this PushParametrosController */
/* @var $model PushParametros */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'push-parametros-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>


	<div  class="form-group has-feedback">
		<?php echo $form->labelEx($model,'Paquete de la aplicación'); ?>
		<?php echo $form->textField($model,'restricted_package_name',array('class' => 'form-control', 'size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'restricted_package_name'); ?>
	</div>

	<div  class="form-group has-feedback">
		<?php echo $form->labelEx($model,'key FCM'); ?>
		<?php echo $form->textField($model,'key',array('class' => 'form-control', 'size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'key'); ?>
	</div>

	<div class="form-group has-feedback ">
		<?php echo CHtml::submitButton('Guardar',array ('class' => 'btn btn-info pull-right')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->