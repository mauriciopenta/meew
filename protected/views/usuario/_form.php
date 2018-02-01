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
			 
			 <h3>Agregar de usuario</h3>
			 </div>
			
			<div class="form" >
			   <div class="row" style="padding:15px;">
						<div class="col-md-12">
									<div class="row">
											<div class="col-md-6">
													<div class="form-group ">
														<?php echo $form->labelEx($model,'usuario'); ?>
														<?php echo $form->textField($model,'username', array ('class' => 'form-control','placeholder'=>'Digite el nombre de usuario')); ?>
														<?php echo $form->error($model,'username'); ?>
													</div>
													<div class="form-group ">
														<?php echo $form->labelEx($model,'contraseña'); ?>
														<?php echo $form->passwordField($model,'password', array ('class' => 'form-control','placeholder'=>'Digite su contraseña')); ?>
														<?php echo $form->error($model,'password'); ?>
													</div>
													<div class="form-group ">
														<?php echo $form->labelEx($model,'Confime contraseña'); ?>
														<?php echo $form->passwordField($model,'confirmPassword', array ('class' => 'form-control','placeholder'=>'Confirme su contraseña')); ?>
														<?php echo $form->error($model,'confirmPassword'); ?>
													</div>

													<div class="form-group ">
														<?php echo $form->labelEx($model,'nombres'); ?>
														<?php echo $form->textField($model,'nombres', array ('class' => 'form-control','placeholder'=>'nombres')); ?>
														<?php echo $form->error($model,'nombres'); ?>
													</div> 
													<div class="form-group ">
														<?php echo $form->labelEx($model,'apellidos'); ?>
														<?php echo $form->textField($model,'apellidos', array ('class' => 'form-control','placeholder'=>'Apellidos')); ?>
														<?php echo $form->error($model,'apellidos'); ?>
													</div> 
													<div class="form-group ">
														<?php echo $form->labelEx($model,'email'); ?>
														<?php echo $form->textField($model,'email', array ('class' => 'form-control','placeholder'=>'Correo')); ?>
														<?php echo $form->error($model,'email'); ?>
													</div>  

											</div>
									<div class="col-md-6">
											<div class="form-group ">
												<?php echo $form->labelEx($model,'tipo_ de documento'); ?><br>
												<?php 
												$consulta=Parametros::model()->findAll( array('select'=>'codigo, nombre',
												'condition'=> 'tipo=:tipo_doc','params'=> array(':tipo_doc'=>'tipo_documento')));
												$type_list=CHtml::listData($consulta,'codigo','nombre');
												echo $form->dropDownList($model,'tipo_documento', $type_list, array('class' => 'form-control','empty'=>'Seleccione') ) ?>
												<?php echo $form->error($model,'tipo_documento'); ?>
											</div> 
											<div class="form-group ">
												<?php echo $form->labelEx($model,'documento'); ?>
												<?php echo $form->textField($model,'documento', array ('class' => 'form-control','placeholder'=>'Número de documento')); ?>
												<?php echo $form->error($model,'documento'); ?>
											</div> 
									</div>
								
								</div> 
							<div class="form-group ">
									<?php echo CHtml::submitButton('Register', array ('class' => 'btn btn-info pull-right')); ?>
									
							</div>
			</div> 
	  	  </div>
		</div> 
	  </div>
	</section>    
  <?php $this->endWidget(); ?>
</div><!-- form -->
</div>