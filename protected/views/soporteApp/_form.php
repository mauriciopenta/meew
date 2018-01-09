<?php
/* @var $this SoporteAppController */
/* @var $model SoporteApp */
/* @var $form CActiveForm */
?>

<div class="form">

<section class="content" >
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'soporte-app-form',
	'enableAjaxValidation'=>false,
 ));?>
	<?php echo $form->errorSummary($model); ?>
    <div class="form-group has-feedback">
	
	    <?php echo $form->labelEx($model,'Tema'); ?><br>
			<?php 
			$consulta=TemaSoporte::model()->find( array('select'=>'idtema_soporte, titulo',
            'condition'=> 'idtema_soporte=:idtema_soporte','params'=> array(':idtema_soporte'=> $model->id_tema)));
	        echo $consulta->titulo;
	 ?>
           
	
	</div>

	<div class="form-group has-feedback">
		<?php echo $form->labelEx($model,'mensaje'); ?>
		<?php echo $form->textArea($model,'mensaje',array('class' => 'form-control','rows'=>6, 'cols'=>50,'disabled'=>'true')); ?>
		<?php echo $form->error($model,'mensaje'); ?>
	</div>
	<div class="form-group has-feedback">
		<?php echo $form->labelEx($model,'respuesta'); ?>
		<?php echo $form->textArea($model,'respuesta',array('class' => 'form-control','rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'respuesta'); ?>
	</div>
	<div class="form-group has-feedback">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Responder',array ('class' => 'btn btn-info pull-right')); ?>
	</div>
<?php $this->endWidget(); ?>
</div>
</div><!-- form -->