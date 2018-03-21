<?php
/* @var $this TerminosController */
/* @var $model Terminos */
/* @var $form CActiveForm */
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/ckeditor/ckeditor.js",CClientScript::POS_END);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js",CClientScript::POS_END);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/Terminos/Terminos.js",CClientScript::POS_END);
?>

<div class="form" id="divTerminos">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'terminos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<div class="form-group has-feedback" id="articulo">
		<?php echo $form->textArea($model,'terminos',array('id'=>'html_text','rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'terminos'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array ('class' => 'btn btn-info pull-right')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->