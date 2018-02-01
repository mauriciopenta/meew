<div class="row">
<div class="col-md-12">
<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'aplicacionConfig-form',
			"method" => "post",
			'enableClientValidation'=>true,
			'enableAjaxValidation'=>true,
			'htmlOptions' => array(
				'enctype' => 'multipart/form-data'),
			'clientOptions'=>array(
					'validateOnSubmit'=>false)
		    
			)

		); ?>
   <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Estilo Aplicacion</h3>
            </div>
            <div class="box-body">
            <div class="row">
            <div class="col-md-12">
			<p class="note">Seleccione una plantilla</p>
			<br>
				<div class="row">
							<?php
								$type_list=Plantilla::model()->findAll();
							    if(!empty($type_list)){
									foreach($type_list as $plantilla):
									?>
                                    <div class="col-xs-12 col-sm-6 col-md-4" >

											<div class="form-group center_content" > 
											<label>
												<?php echo CHtml::image(Yii::app()->request->baseUrl.'/'.$plantilla['url_imagen'], $plantilla['nombre']); ?>
												<br>
												<?php	
												echo $form->radioButton($model, 'id_plantilla', array(
													'class'=>'minimal',
													'value'=>$plantilla['idplantilla'],
													'uncheckValue'=>null
												));
												  ?>
												
												
									      	</label>  
											</div>
                                      </div>
                                    <?php  endforeach;
                                }
							?>
							<div class="form-group center_content" > 
                              <?php echo $form->error($model,'id_plantilla'); ?>
					        </div>
		
                </div>
              <!-- Color Picker -->
			  <div class="row">
             <div class="col-md-6">

				<div class="form-group has-feedback">
						<?php echo $form->labelEx($model,'nombre'); ?>
						<?php echo $form->textField($model,'nombre', array ('class' => 'form-control','placeholder'=>'Ingrese nombre de la app')); ?>
						<?php echo $form->error($model,'nombre'); ?>
				</div>
				<div class="form-group">
					<label>Color Header:</label>

					<div class="input-group my-colorpicker2">
					<?php 
					
						echo $form->textField($model,'color', array ('class' => 'form-control','type'=>'text','empty'=>'Seleccione') ) ?>
		
					<div class="input-group-addon">
						<i></i>
					</div>
					</div>
				</div>
				<div class="form-group">
		     	  <label>Color icono:</label>

					<div class="input-group my-colorpicker2">
					<?php 
					
						echo $form->textField($model,'color_icon', array ('class' => 'form-control','type'=>'text','empty'=>'Seleccione') ) ?>
		
					<div class="input-group-addon">
						<i></i>
					</div>
					</div>
				</div>	
			
			</div>




             <div  class="row" style="margin-left:5px;" >
                <div class="col-md-6">
						<div class="form-group has-feedback" >
								<label >Imagen fondo</label>
								
								<?php echo $form->fileField($model, 'imageFile', array('size' => 48)); ?>  
								<?php echo $form->error($model,'imageFile'); ?>
						</div>
			    </div>


			  <div class="col-md-6">
				
						<?php 
								if(!empty($model->imageFile)){
								echo CHtml::image($model->imageFile,"image",array("width"=>100)); 
								}
						?>  
						
			  </div>
			 </div>

           
			</div>
            <div class="center_button" >
				<?php echo CHtml::submitButton('Guardar', array ('class' => 'btn btn-info pull-right')); ?>
			</div>
          </div>

	   </div>
	</div>


<div class="box box-primary"  id="estilo" action="#estilo" >
		<div class="box-header with-border">
			<h3 class="box-title"> Estructura</h3>
		</div>
		<div class="box-body">
		

			<div class="row">
					<div class="col-md-6">
							
				        	<p class="note"><b>Modulos</b></p>
						    <p>Selecciona los módulos que deseas ver en tu aplicación móvil. <p>
							<br>
								
							<div class="form-group has-feedback">
						
								<label>
							    	<?php echo $form->label($model,'Login'); ?>
									<?php echo $form->checkBox($model,'login_activo', array('class' => 'minimal') ); ?>
									
									<?php echo $form->error($model,'login_activo'); ?>
								</label>
							</div>
							<div class=" form-group has-feedback">
								<label>
							     	<?php echo $form->label($model,'Login facebook'); ?>
									<?php echo $form->checkBox($model,'login_facebook' , array('class' => 'minimal'));?>
									<?php echo $form->error($model,'login_facebook'); ?>
								</label>
							</div>
							<div class=" form-group has-feedback">
								
							    	<?php echo $form->label($model,'Modulo viral'); ?>
									<?php echo $form->checkBox($model,'modulo_viral', array('id'=>'viral' , 'class' => 'minimal')); ?>
									<?php echo $form->error($model,'modulo_viral'); ?>
								
					    	</div>
							<div class=" form-group has-feedback" id='facebook'>
								<label>
							    	<?php echo $form->label($model,'Facebook'); ?>
									<?php echo $form->checkBox($model,'facebook', array('class' => 'minimal')); ?>
									<?php echo $form->error($model,'facebook'); ?>
								</label>
					    	</div>
						<div class=" form-group has-feedback" id='twitter'>
							<label>
							    <?php echo $form->label($model,'Twitter'); ?>
						        <?php echo $form->checkBox($model,'twitter', array('class' => 'minimal')); ?>
							  	<?php echo $form->error($model,'twitter'); ?>
							</label>
						</div>
						<div class=" form-group has-feedback" id='instagram'>
							<label>
						    	<?php echo $form->label($model,'Instagram'); ?>
								<?php echo $form->checkBox($model,'instagram', array('class' => 'minimal')); ?>
						    	<?php echo $form->error($model,'instagram'); ?>
							</label>
						</div>
					</div>
					<div class="col-md-6">
					
					<p class="note"><b>Campos Registro</b></p>
					<p>Selecciona los campos que deseas que tus usuarios completen en el momento de realizar el registro en tu aplicación móvil.</p>
							<div class="form-group has-feedback">
							<label>
							    <?php echo $form->label($model,'nombre_activo'); ?>
							    <?php echo $form->checkBox($model,'nombre_activo', array('class' => 'minimal')); ?>
						        <?php echo $form->error($model,'nombre_activo'); ?>
							</label>
						</div>

					    <div class="form-group has-feedback">
							<label>
						    	<?php echo $form->label($model,'apellido'); ?>
							    <?php echo $form->checkBox($model,'apellido_activo', array('class' => 'minimal')); ?>
							    <?php echo $form->error($model,'apellido_activo'); ?>
							</label>
						</div>
						<div class="form-group has-feedback">
							<label>
						    	<?php echo $form->label($model,'Nombre usuario'); ?>
								<?php echo $form->checkBox($model,'nombre_usuario_activo', array('class' => 'minimal')); ?>
								<?php echo $form->error($model,'nombre_usuario_activo'); ?>
							</label>
						</div>

						<div class="form-group has-feedback">
							<label>
						    	<?php echo $form->label($model,'Celular'); ?>
								<?php echo $form->checkBox($model,'celular_activo', array('class' => 'minimal')); ?>
								<?php echo $form->error($model,'celular_activo'); ?>
							</label>
						</div>
						<div class="form-group has-feedback">
							<label>
								<?php echo $form->label($model,'Genero'); ?>	
								<?php echo $form->checkBox($model,'genero', array('class' => 'minimal')); ?>
								<?php echo $form->error($model,'genero'); ?>
							</label>
						</div>
						<div class="form-group has-feedback">
							<label>
								<?php echo $form->label($model,'Rango edad'); ?>
								<?php echo $form->checkBox($model,'rango_edad', array('class' => 'minimal')); ?>
								<?php echo $form->error($model,'rango_edad'); ?>
							</label>
						</div>


						<div class="form-group has-feedback	">
							<label>
								<?php echo $form->label($model,'Politicas de privacidad'); ?>
								<?php echo $form->checkBox($model,'politicas_privacidad_activo', array('class' => 'minimal')); ?>
								<?php echo $form->error($model,'politicas_privacidad_activo'); ?>
							</label>
						</div>
					</div>
		      </div> 
         	<div class="center_button" >
				<?php echo CHtml::submitButton('Guardar', array ('class' => 'btn btn-info pull-right')); ?>
			</div>
		</div><!-- form -->
	   </div>
	   </div>
	   <?php $this->endWidget(); ?>
	 </div>
	</div>

	<?php
		$this->widget('ImageManager', array(
			'aplicacion' => $modelAplicacion,
			'controllerRoute'=>'RecursosController'
			)); 
	?>


	</div>

