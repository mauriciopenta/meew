<?php
/* @var $this AplicacionController */
/* @var $model Aplicacion */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/style_form.css');

?>

<div class="form">
<section class="content" >
<p class="note">Campos con <span class="required">*</span> requeridos.</p>

<div class="row">
      <div class="col-md-6">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mcontacto-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	
	<?php echo $form->errorSummary($model); ?>
	<div class="form-group has-feedback">
		<?php echo $form->labelEx($model,'Asunto'); ?>
		<?php echo $form->textArea($model,'asunto',array('class' => 'form-control','rows'=>6, 'cols'=>50,'disabled'=>'true')); ?>
		<?php echo $form->error($model,'asunto'); ?>
	</div>
	<div class="form-group has-feedback">
		<?php echo $form->labelEx($model,'Mensaje'); ?>
		<?php echo $form->textArea($model,'mcontacto_mensaje',array('class' => 'form-control','rows'=>6, 'cols'=>50,'disabled'=>'true')); ?>
		<?php echo $form->error($model,'mcontacto_mensaje'); ?>
	</div>

	

	<!--div class="form-group has-feedback">
		<?php echo $form->labelEx($model,'aplicacion_idaplicacion'); ?>
		<?php echo $form->textField($model,'aplicacion_idaplicacion', array('class'=>'form-control','disabled'=>'true')); ?>
		<?php echo $form->error($model,'aplicacion_idaplicacion'); ?>
	</div>

	<div class="form-group has-feedback">
		<?php echo $form->labelEx($model,'aplicacion_usuario_id_usuario'); ?>
		<?php echo $form->textField($model,'aplicacion_usuario_id_usuario',array('class'=>'form-control','disabled'=>'true')); ?>
		<?php echo $form->error($model,'aplicacion_usuario_id_usuario'); ?>
	</div-->

	<div class="form-group has-feedback">
		<?php echo $form->labelEx($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha', array('class'=>'form-control','disabled'=>'true')); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="form-group has-feedback">
		<?php echo $form->labelEx($model,'respuesta'); ?>
		<?php echo $form->textArea($model,'respuesta',array('class' => 'form-control','size'=>60,'rows'=>6, 'cols'=>50,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'respuesta'); ?>
	</div>

	<div class="form-group has-feedback">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array ('class' => 'btn btn-info pull-right')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div>
</section>	
</div><!-- form -->