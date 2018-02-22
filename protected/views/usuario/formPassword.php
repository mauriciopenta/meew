<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div>
  <div >
  
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>false)
	)); ?>
			
		<section class="content" >       
		  <div class="box box-primary">  
		  <div class="box-header with-border">
			 
			 <h3>Cambiar contraseña</h3>
			 </div>
			
			<div class="form" >
			   <div class="row" style="padding:15px;">
						<div class="col-md-12">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group ">
												<?php echo $form->labelEx($model,'password'); ?>
												
												<?php echo $form->passwordField($model,'password', array ('class' => 'form-control','placeholder'=>'Digite su contraseña actual')); ?>
												
												<?php echo $form->error($model,'password'); ?>
											</div>
											<div class="form-group ">
												<?php echo $form->labelEx($model,'PasswordNew'); ?>
											
												<?php echo $form->passwordField($model,'PasswordNew', array ('class' => 'form-control','placeholder'=>'Digite su nueva contraseña')); ?>
											
												<?php echo $form->error($model,'PasswordNew'); ?>
											</div>
											<div class="form-group ">
												<?php echo $form->labelEx($model,'confirmPassword'); ?>
											
												<?php echo $form->passwordField($model,'confirmPassword', array ('class' => 'form-control','placeholder'=>'Confirme su nueva contraseña')); ?>
											
												<?php echo $form->error($model,'confirmPassword'); ?>
											</div>
										</div>
									</div> 
								<div class="form-group ">
										<?php echo CHtml::submitButton('Guardar', array ('class' => 'btn btn-info pull-right')); ?>
								</div>
			</div> 
	  	  </div>
		</div> 
	  </div>
	</section>    
  <?php $this->endWidget(); ?>
</div><!-- form -->
</div>