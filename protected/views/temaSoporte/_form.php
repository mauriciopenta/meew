<?php
/* @var $this TemaSoporteController */
/* @var $model TemaSoporte */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/style_form.css');

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/TemaSoporte/TemaSoporte.js",CClientScript::POS_END);

?>


<div class="form" id="divTemaSoporte">
<section class="content" >
<p class="note">Campos con <span class="required">*</span> requeridos.</p>



	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'tema-soporte-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>true,
	)); ?>
			<div class="row">
				<div class="col-md-6">

							<?php echo $form->errorSummary($model); ?>

							<div class="form-group has-feedback">
								<?php echo $form->labelEx($model,'titulo'); ?>
								<?php echo $form->textArea($model,'titulo',array('class' => 'form-control', 'rows'=>1, 'cols'=>50)); ?>
								<?php echo $form->error($model,'titulo'); ?>
							</div>

							<div class="form-group has-feedback">
								<?php echo $form->labelEx($model,'descripcion'); ?>
								<?php echo $form->textArea($model,'descripcion',array('class' => 'form-control', 'rows'=>3, 'cols'=>50)); ?>
								<?php echo $form->error($model,'descripcion'); ?>
							</div>
							</div>
				</div>


				<div class="form-group has-feedback">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array ('class' => 'btn btn-info pull-right')); ?>
		     	</div>

		<?php $this->endWidget(); ?>



	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'tema-soporte-form2',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>true,
	)); ?>
		
		<?php 
		
		   if(!$model->isNewRecord && $model->hijo=='0'){?>



				<h3>Subtemas</h3>
				<div id="subtemas">
					<?php 
					
					if($subtema >0){
						$this->widget('zii.widgets.grid.CGridView', array(
							'id'=>'tema-soporte-grid',
							'itemsCssClass' => 'table table-bordered table-striped dataTable',
							'dataProvider'=> $model_table->search_subtema($model->idtema_soporte),
							'filter'=>$model_table,
							'columns'=>array(
								'idtema_soporte',
								'titulo',
								'descripcion',
								'fecha',
								array(
									'class'=>'CButtonColumn',
									'updateButtonImageUrl'=>Yii::app()->baseUrl.'/img/edit.png',
									'deleteButtonImageUrl'=>Yii::app()->baseUrl.'/img/delete.png',
									'viewButtonImageUrl'=>Yii::app()->baseUrl.'/img/view.png',

									'viewButtonUrl'=>'Yii::app()->controller->createUrl("temaSoporte/view",array("id"=>$data["idtema_soporte"]))',
									'updateButtonUrl'=>'Yii::app()->controller->createUrl("temaSoporte/update",array("id"=>$data["idtema_soporte"]))',
									'deleteButtonUrl'=>'Yii::app()->controller->createUrl("temaSoporte/delete",array("id"=>$data["idtema_soporte"]))',
									'deleteConfirmation'=>"js:'Esta seguro de eliminar el subtema?' ",
								


								),
							),
						)); 
					} 
					
					
					?>

						
				</div>		
				
			<div id="agregar_tema">
			


				<div class="form-group has-feedback">
					<?php echo $form->labelEx($model,'Titulo'); ?>
					<?php echo $form->textArea($model,'titulo_agregar',array('class' => 'form-control', 'rows'=>1, 'cols'=>50)); ?>
					<?php echo $form->error($model,'titulo_agregar'); ?>
				</div>

				<div class="form-group has-feedback">
					<?php echo $form->labelEx($model,'Descripcion'); ?>
					<?php echo $form->textArea($model,'descripcion_agregar',array('class' => 'form-control', 'rows'=>3, 'cols'=>50)); ?>
					<?php echo $form->error($model,'descripcion_agregar'); ?>
				</div>

				<div class="form-group has-feedback">
					<?php echo CHtml::submitButton('Agregar',array ('class' => 'btn btn-info pull-right')); ?>
				</div>
			
			 </div>
			<div class="center_button" id="subtema" >
				<div class="btn btn-info pull-right" id="agregar_btn" >Agregar Subtema</div>
			</div>
			<br><br>

					<?php }?>
				
			<br><br>
		

		<?php $this->endWidget(); ?>
				





	</section>	
	</div><!-- form -->