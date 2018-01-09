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
	'id'=>'parametros-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
 


	<?php echo $form->errorSummary($model); ?>


	<div class="form-group has-feedback">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('class'=>'form-control', 'placeholder'=>'Digite el nombre' , 'size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>



	<div class="form-group has-feedback">
            <?php echo $form->labelEx($model,'tipo'); ?><br>
            <?php 
            echo $form->dropDownList($model,'tipo',  array('estado_app'=>'estado app','grupo_contenido'=>'grupo contenido', "tipo_contenido"=>"tipo contenido",'tipo_documento'=>'Tipo de documento','tipo_menu'=>'tipo menu','modulo'=>'Modulo' ), array('class' => 'form-control','empty'=>'Seleccione') ) ?>
            <?php echo $form->error($model,'tipo'); ?>
   </div>


	<div class="form-group has-feedback">
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo', array('class' => 'form-control','placeholder'=>'Digite el codigo')); ?>
		<?php echo $form->error($model,'codigo'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Guardar', array ('class' => 'btn btn-info pull-right')); ?>
	</div>

	


        <?php $this->endWidget(); ?>
      </div>
    </div>
	</section>	
</div><!-- form -->