<?php
/* @var $this AplicacionController */
/* @var $model Aplicacion */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/colorpicker/bootstrap-colorpicker.min.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/iCheck/all.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/colorpicker/bootstrap-colorpicker.min.js",CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/iCheck/icheck.min.js",CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/Aplicacion/Aplicacion.js",CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/IconPicker/css/framework7-icons.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/IconPicker/css/asIconPicker.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/jquery-asIconPicker.js",CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/jquery.toc.js",CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/prism.js",CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/jquery-asTooltip.min.js",CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/jquery-asScrollbar.js",CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/jquery.mousewheel.js",CClientScript::POS_END);


?>

<?php
/* @var $this UsuarioController */

$this->pageTitle=Yii::app()->name . ' - Configurar Aplicación';
$this->breadcrumbs=array(
	'Aplicacion'=>array('/aplicacionConfig'),
	'aplicacionConfig',
);
?>


<div class="form">
<section class="content" id="divAplicacion">
<div class="row">
        <!-- left column -->
        
        
<div class="col-md-12">
<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'aplicacionConfig-form',
			"method" => "post",
			'enableClientValidation'=>true,
			'enableAjaxValidation'=>false,
			'htmlOptions' => array(
				'enctype' => 'multipart/form-data'),
			'clientOptions'=>array(
					'validateOnSubmit'=>false)
		    
			)

			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// See class documentation of CActiveForm for details on this,
			// you need to use the performAjaxValidation()-method described there.
			
		); ?>
   <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Estilo Aplicacion</h3>
            </div>
            <div class="box-body">
            <div class="row">
            <div class="col-md-12">
			<label>Seleccione una plantilla</label><br>
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
					<label>Color fondo:</label>

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
								echo CHtml::image(Yii::app()->request->baseUrl."/protected".$model->imageFile,"image",array("width"=>100)); 
								}
						?>  
						
			  </div>
			 </div>


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
							
				        	<p class="note">Modulos</p>
 
							<div class="form-group has-feedback">
								<label>
									<?php echo $form->checkBox($model,'login_activo', array('class' => 'minimal') ); ?>
									<?php echo $form->label($model,'Login'); ?>
									<?php echo $form->error($model,'login_activo'); ?>
								</label>
							</div>
					
							<div class=" form-group has-feedback">
								<label>
									<?php echo $form->checkBox($model,'login_facebook' , array('class' => 'minimal'));?>
									<?php echo $form->label($model,'Login facebook'); ?>
									<?php echo $form->error($model,'login_facebook'); ?>
								</label>
							</div>
					
					
							<p class="note">Modulos Viral</p>
							<div class=" form-group has-feedback">
							<label>
								<?php echo $form->checkBox($model,'facebook', array('class' => 'minimal')); ?>
							    <?php echo $form->label($model,'facebook'); ?>
							    <?php echo $form->error($model,'facebook'); ?>
							</label>
						</div>

						<div class=" form-group has-feedback">
							<label>
								<?php echo $form->checkBox($model,'twitter', array('class' => 'minimal')); ?>
							<?php echo $form->label($model,'twitter'); ?>
							<?php echo $form->error($model,'twitter'); ?>
							</label>
						</div>
						<div class=" form-group has-feedback">
							<label>
								<?php echo $form->checkBox($model,'instagram', array('class' => 'minimal')); ?>
							<?php echo $form->label($model,'instagram'); ?>
							<?php echo $form->error($model,'instagram'); ?>
							</label>
						</div>
					</div>
					<div class="col-md-6">
					
					<p class="note">Campos Registro</p>
							<div class="form-group has-feedback">
							<label>
								<?php echo $form->checkBox($model,'nombre_activo', array('class' => 'minimal')); ?>
							<?php echo $form->label($model,'nombre_activo'); ?>
							<?php echo $form->error($model,'nombre_activo'); ?>
							</label>
						</div>

					    <div class="form-group has-feedback">
							<label>
								<?php echo $form->checkBox($model,'apellido_activo', array('class' => 'minimal')); ?>
							<?php echo $form->label($model,'apellido'); ?>
							<?php echo $form->error($model,'apellido_activo'); ?>
							</label>
						</div>
						<div class="form-group has-feedback">
							<label>
							<?php echo $form->checkBox($model,'nombre_usuario_activo', array('class' => 'minimal')); ?>
							<?php echo $form->label($model,'Nombre usuario'); ?>
							<?php echo $form->error($model,'nombre_usuario_activo'); ?>
							</label>
						</div>

						<div class="form-group has-feedback">
							<label>
								<?php echo $form->checkBox($model,'celular_activo', array('class' => 'minimal')); ?>
							<?php echo $form->label($model,'Celular'); ?>
							<?php echo $form->error($model,'celular_activo'); ?>
							</label>
						</div>
						<div class="form-group has-feedback	">
							<label>
							<?php echo $form->checkBox($model,'politicas_privacidad_activo', array('class' => 'minimal')); ?>
							<?php echo $form->label($model,'Politicas de privacidad'); ?>
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



<div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Variables de Configuracion</h3>
            </div>
            <div class="box-header">
              <h5 >Se pueden configurar las variables del módulo viral en caso de que este activo y el email de contacto, para el módulo de contacto.</h5>
            </div>

			<div class="box-body">
               

				

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mviral-form',
	"method" => "post",
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
	'clientOptions'=>array(
			'validateOnSubmit'=>false)
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	
));

?>

    <p class="note">Modulo Viral</p>

	<?php echo $form->errorSummary($modelViral);
	?>
<div class="form" id="Viral"  action="#Viral" >
  <div class="row">
  <?php 	if($model['facebook'] ||  $model['twitter']){ ?>
	<div class="col-md-6" >
	<?php 	if($model['facebook']){ ?>
		<div class="form-group has-feedback	">
			<?php echo $form->labelEx($modelViral,'url facebook'); ?>
			<?php echo $form->textField($modelViral,'mviral_url_fb',array('class' => 'form-control','rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($modelViral,'mviral_url_fb'); ?>
		</div>
	<?php } ?>
	<?php 	if($model['twitter']){ ?>
	<div class="form-group has-feedback	">
		<?php echo $form->labelEx($modelViral,'url twitter'); ?>
		<?php echo $form->textField($modelViral,'mviral_url_tw',array('class' => 'form-control','rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($modelViral,'mviral_url_tw'); ?>
	</div>
	<?php } ?>
	</div>
	<?php } ?>
	<div class="col-md-6">
    	<?php 	if($model['instagram']){ ?>
			<div class="form-group has-feedback	">
				<?php echo $form->labelEx($modelViral,'url instagram'); ?>
				<?php echo $form->textField($modelViral,'mviral_url_inst',array('class' => 'form-control','rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($modelViral,'mviral_url_inst'); ?>
			</div>
		<?php } ?>

			<div class="form-group has-feedback	">
				<?php echo $form->labelEx($modelViral,'correo contacto'); ?>
				<?php echo $form->textField($modelViral,'correo_contacto',array('class' => 'form-control','rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($modelViral,'correo_contacto'); ?>
			</div>

	</div>
	</div>
	<div class="form-group has-feedback	">
	    <?php echo CHtml::submitButton(!isset($modelViral->id_mviral) ? 'Crear' : 'Guardar', array ('class' => 'btn btn-info pull-right')); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->         
 </div>
</div>
		    <div class="box box-info" id="modulos" action="#modulos">
						<div class="box-header">
						<h3 class="box-title">Modulos</h3>
						</div>
						<div class="box-body">
						<div class="row">
						<div class="col-md-12" >
					    	<?php $this->renderPartial('administrador_modulo', array('model'=>$moduloSearch)); ?>
						    <?php $this->renderPartial('createModulo', array('model'=>$moduloApp)); ?>
                       </div>
					</div>
				</div>
			</div>

			<div class="box box-info">
			<div class="form" id="ordenModulo" action="#ordenModulo">
		     	<?php $this->renderPartial('orden', array('model'=>$model)); ?>
                      
			</div>
		</div>
</div>
</section>



