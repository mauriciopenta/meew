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
	'id'=>'',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
 <div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Usuarios</h3>
	</div>
	<div class="box-body">
	  
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
	

 
<?php $this->endWidget(); ?>

</div><!-- form -->

</div>
	</div>
 </section>