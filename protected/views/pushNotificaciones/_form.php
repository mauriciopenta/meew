<?php
/* @var $this PushNotificacionesController */
/* @var $model PushNotificaciones */
/* @var $form CActiveForm */
?>



<section class="content" >
<div class="row">
    <div class="col-md-12">
	<div class="form" id="divPush">

     
  

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'push-notificaciones-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
 <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Crear Notificación</h3>
            </div>
            <div class="box-body">
         			
	  
<p class="note">Seleccione Los usuarios a los que desea enviar un mensaje</p>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
       <div class="col-md-4">
			<div class="form-group has-feedback">
					<?php echo $form->labelEx($model,'Género'); ?><br>
						<?php 
							echo $form->dropDownList($model,'genero', $genero, array('id'=>'genero' , 'class' => 'form-control','empty'=>'Todos los Géneros','disabled'=>!$model->isNewRecord));
						?>
					<?php echo $form->error($model,'genero'); ?>
			</div>
		</div>
	<div class="col-md-4">	

		<div class="form-group has-feedback">
				<?php echo $form->labelEx($model,'Edad'); ?><br>
					<?php 
					
						echo $form->dropDownList($model,'edad', $edades, array('id'=>'edades' , 'class' => 'form-control','empty'=>'Todas las edades','disabled'=>!$model->isNewRecord));
					?>
				<?php echo $form->error($model,'edad'); ?>
		</div>
	</div>
	<div class="col-md-4">	

	    <br> <br>
    
		<div class="form-group has-feedback buttons">
	     	<?php echo CHtml::submitButton( 'Filtrar', array ('class' => 'btn btn-info pull-right')); ?>
    	</div>
	
	 
	</div>

	</div>

    <?php $this->renderPartial('userlist',array(
            "modeloUsuario"=>$modeloUsuario,
            "modeloPersona"=>$modeloPersona,
            "personas"=>$personas,
            "dataTipoLogin"=>$dataTipoLogin
        )); ?>





     </div></div>
	
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Mensaje</h3>
	</div>
	<div class="box-body">

	<div  class="form-group has-feedback">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo',array('class'=>'form-control','size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

	<div  class="form-group has-feedback">
		<?php echo $form->labelEx($model,'cuerpo'); ?>
		<?php echo $form->textField($model,'cuerpo',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cuerpo'); ?>
	</div>



	
	<div class="form-group has-feedback">
			<?php echo $form->labelEx($model,'id_modulo'); ?><br>
				<?php 
					$sql1 = "select id_modulo_app, nombre_modulo from modulo_app a where a.aplicacion_usuario_id_usuario=".Yii::app()->user->getState('id_usuario');
					$consulta1 = Yii::app()->db->createCommand($sql1)->queryAll();
					$type_list=CHtml::listData($consulta1,'id_modulo_app','nombre_modulo');
					echo $form->dropDownList($model,'id_modulo', $type_list, array('id'=>'tipo_modulo' , 'class' => 'form-control','empty'=>'Seleccione','disabled'=>!$model->isNewRecord));
				?>
			<?php echo $form->error($model,'id_modulo'); ?>
    </div>


	<div class="form-group has-feedback buttons">
		<?php echo CHtml::submitButton('Enviar', array ('class' => 'btn btn-info pull-right')); ?>
	</div>
  </div>
 
<?php $this->endWidget(); ?>

</div><!-- form -->

</div>
	</div>
 </section>