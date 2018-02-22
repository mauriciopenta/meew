
<div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Información de Contacto </h3>
            </div>
            <div class="box-header">
              <h5> Configura las variables del módulo de contacto.</h5>
			  <p>  Configura las variables del módulo de contacto, ya que a través de él, tus usuarios se comunicarán directamente con tu negocio.  Cuando este módulo está completamente lleno, los usuarios se sentirán más seguros en caso que ocurra un evento inesperado con tus productos y/o servicios .</p>
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

	<?php echo $form->errorSummary($modelViral);
	?>
		<div class="form" id="Viral"  action="#Viral" >
		<div class="row">
			<div class="col-md-6">
				<div class="form-group has-feedback	">
					<?php echo $form->labelEx($modelViral,'correo'); ?>
					<?php echo $form->textField($modelViral,'correo_contacto',array('class' => 'form-control','rows'=>6, 'cols'=>50)); ?>
					<?php echo $form->error($modelViral,'correo_contacto'); ?>
				</div>


				<div class="form-group ">
				<div class="row">
					<div class="col-sm-6">
					    <?php echo $form->labelEx($modelViral,'Pais'); ?>
						<?php 
						$consultapais=Paises::model()->findAll(array('order'=>'pais'));
						$type_listpais=CHtml::listData($consultapais,'codigo','pais');
						echo $form->dropDownList($modelViral,'codigo_telefonico', $type_listpais, array('id'=>'pais', 'class' =>'form-control','style'=>'height:30px;','empty'=>'Seleccione') ); 
						?>
					</div>	
				  <div class="col-sm-2">  
				     <?php echo $form->labelEx($modelViral,'Codigo'); ?>
					 <?php  echo "<input 'class'='form-control' style='width:50px !important; margin-right:10px; height:30px !important;' type='text' id='telf' disabled='disabled' value='+".$modelViral->codigo_telefonico."' />"; ?>
			      </div> 
				  <div class="col-sm-4">
				   <div class="form-group has-feedback	">
					<?php echo $form->labelEx($modelViral,'Teléfono'); ?>
					<?php echo $form->textField($modelViral,'telefono',array('class' => 'form-control', 'style'=>'height:30px !important;' )); ?>
					<?php echo $form->error($modelViral,'telefono'); ?>
				   </div> 
				</div> 
                </div> 
				</div> 
              
				
				<div class="form-group has-feedback	">
						<?php echo $form->labelEx($modelViral,'url facebook'); ?>
						<?php echo $form->textField($modelViral,'mviral_url_fb',array('class' => 'form-control','rows'=>6, 'cols'=>50)); ?>
						<?php echo $form->error($modelViral,'mviral_url_fb'); ?>
			</div>
			</div>
			<div class="col-md-6" >
				<div class="form-group has-feedback	">
					<?php echo $form->labelEx($modelViral,'url twitter'); ?>
					<?php echo $form->textField($modelViral,'mviral_url_tw',array('class' => 'form-control','rows'=>6, 'cols'=>50)); ?>
					<?php echo $form->error($modelViral,'mviral_url_tw'); ?>
				</div>
				<div class="form-group has-feedback	">
					<?php echo $form->labelEx($modelViral,'url instagram'); ?>
					<?php echo $form->textField($modelViral,'mviral_url_inst',array('class' => 'form-control','rows'=>6, 'cols'=>50)); ?>
					<?php echo $form->error($modelViral,'mviral_url_inst'); ?>
				</div>
			</div>
	    </div>
	<div class="row">
      <div class="col-md-12">

	  <form id="google" name="google" action="#">

		<div class="form-group has-feedback	">
			<?php echo $form->labelEx($modelViral,'direccion'); ?>
			<?php echo $form->textField($modelViral,'direccion',array('class' => 'form-control','id'=>"direccion")); ?>
			<?php echo $form->error($modelViral,'direccion'); ?>
		</div>
		<div class="form-group has-feedback	">
			<button id="pasar" class="btn btn-info pull-right">Pasar al mapa</button>
		</div>	
		<br>
	
		<div class="color_text_marcador">
             Mueva el marcador <i class="ion-location" style="color:#ea4335;"></i> para fijar la posición con mayor precisión
		</div>
		<div id="map_canvas" style="width:100%;height:300px;margin-top:20px; margin-bottom:20px;"></div>
			
			<!--campos ocultos donde guardamos los datos-->
			<div class="form-group has-feedback	">
				<?php echo $form->labelEx($modelViral,'latitud'); ?>
				<?php echo $form->textField($modelViral,'latitud',array('class' => 'form-control','type'=>"hidden",  'id'=>"lat")); ?>
				<?php echo $form->error($modelViral,'latitud'); ?>
			</div>

			<div class="form-group has-feedback	">
				<?php echo $form->labelEx($modelViral,'longitud'); ?>
				<?php echo $form->textField($modelViral,'longitud',array('class' => 'form-control','type'=>"hidden", 'id'=>'long')); ?>
				<?php echo $form->error($modelViral,'longitud'); ?>
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