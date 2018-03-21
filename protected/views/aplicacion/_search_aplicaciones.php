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
		<?php echo $form->label($model,'idaplicacion'); ?>
		<?php echo $form->textField($model,'idaplicacion'); ?>
	</div>

	<div class="row">
	<?php echo $form->label($model,'nombre'); ?>
	<?php echo $form->textField($model,'nombre',array('size'=>50,'maxlength'=>50)); ?>
    </div>

	<div class="row">
		<?php echo $form->label($model,'url_fondo'); ?>
		<?php echo $form->textField($model,'url_fondo',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'login_activo'); ?>
		<?php echo $form->textField($model,'login_activo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'login_facebook'); ?>
		<?php echo $form->textField($model,'login_facebook'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'facebook'); ?>
		<?php echo $form->textField($model,'facebook'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'twitter'); ?>
		<?php echo $form->textField($model,'twitter'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'instagram'); ?>
		<?php echo $form->textField($model,'instagram'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usuario_id_usuario'); ?>
		<?php echo $form->textField($model,'usuario_id_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_plantilla'); ?>
		<?php echo $form->textField($model,'id_plantilla'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado_app'); ?>
		<?php echo $form->textField($model,'estado_app'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'nombre_activo'); ?>
		<?php echo $form->textField($model,'nombre_activo'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'apellido_activo'); ?>
		<?php echo $form->textField($model,'apellido_activo'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'celular_activo'); ?>
		<?php echo $form->textField($model,'celular_activo'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'politicas_privacidad_activo'); ?>
		<?php echo $form->textField($model,'politicas_privacidad_activo'); ?>
	</div>
   <div class="row">
		<?php echo $form->label($model,'nombre_usuario_activo'); ?>
		<?php echo $form->textField($model,'nombre_usuario_activo'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'color_icon'); ?>
		<?php echo $form->textField($model,'color_icon'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'genero'); ?>
		<?php echo $form->textField($model,'genero'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'rango_edad'); ?>
		<?php echo $form->textField($model,'rango_edad'); ?>
	</div>
	<div class="row">
	<?php echo $form->label($model,'imagen_splash'); ?>
	<?php echo $form->textField($model,'imagen_splash',array('size'=>50,'maxlength'=>50)); ?>
   </div>
   <div class="row">
		<?php echo $form->label($model,'imagen_icon'); ?>
		<?php echo $form->textField($model,'imagen_icon',array('size'=>50,'maxlength'=>50)); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'icon_interno'); ?>
		<?php echo $form->textField($model,'icon_interno',array('size'=>50,'maxlength'=>50)); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'paquete'); ?>
		<?php echo $form->textField($model,'paquete',array('size'=>200,'maxlength'=>200)); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'estado'); ?>
		<?php echo $form->textField($model,'estado_search',array('size'=>200,'maxlength'=>200)); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- search-form -->