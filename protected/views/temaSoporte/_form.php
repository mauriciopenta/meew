<?php
/* @var $this TemaSoporteController */
/* @var $model TemaSoporte */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/style_form.css');

?>


<div class="form">
<section class="content" >
<p class="note">Campos con <span class="required">*</span> requeridos.</p>

<div class="row">
      <div class="col-md-6">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'tema-soporte-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
	)); ?>


				<?php echo $form->errorSummary($model); ?>

				<div class="form-group has-feedback">
					<?php echo $form->labelEx($model,'titulo'); ?>
					<?php echo $form->textArea($model,'titulo',array('class' => 'form-control', 'rows'=>6, 'cols'=>50)); ?>
					<?php echo $form->error($model,'titulo'); ?>
				</div>

				<div class="form-group has-feedback">
					<?php echo $form->labelEx($model,'descripcion'); ?>
					<?php echo $form->textArea($model,'descripcion',array('class' => 'form-control', 'rows'=>6, 'cols'=>50)); ?>
					<?php echo $form->error($model,'descripcion'); ?>
				</div>
				
				<div class="form-group has-feedback">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array ('class' => 'btn btn-info pull-right')); ?>
				</div>

	<?php $this->endWidget(); ?>
	</div>
	</div>
	</section>	
	</div><!-- form -->