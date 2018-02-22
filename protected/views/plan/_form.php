<?php
  Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/ckeditor/ckeditor.js",CClientScript::POS_END);
	
  Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js",CClientScript::POS_END);
  Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');
  Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/Plan/Plan.js",CClientScript::POS_END);


?>

<div class="form" id="divPlan">


			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'plan-form',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>false,
			)); ?>

                 <p class="note">Campos con <span class="required">*</span> requeridos.</p><br>

				<?php echo $form->errorSummary($model); ?>

				<div class="form-group">
					<?php echo $form->labelEx($model,'Nombre del Plan'); ?>
					<?php echo $form->textField($model,'plan_nombre',array('class' => 'form-control','size'=>50,'maxlength'=>50)); ?>
					<?php echo $form->error($model,'plan_nombre'); ?>
				</div>

		
				<div class="form-group">
					<?php echo $form->labelEx($model,'valor_text'); ?>
					<?php echo $form->textField($model,'valor_text',array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
					<?php echo $form->error($model,'valor_text'); ?>
				</div>

				<div class="form-group">
					<?php echo $form->labelEx($model,'valor'); ?>
					<?php echo $form->textField($model,'valor'); ?>
					<?php echo $form->error($model,'valor'); ?>
				</div>


              <div class="row">
			      <div class="col-md-6">
					<div class="form-group has-feedback">
						<?php echo $form->labelEx($model,'Periodo Plan'); ?><br>
							<?php 
								$sql1 = "select codigo, nombre from parametros b where  b.tipo='periodo_plan'";
							
								$consulta1 = Yii::app()->db->createCommand($sql1)->queryAll();
							
								$type_list=CHtml::listData($consulta1,'codigo','nombre');
					
								echo $form->dropDownList($model,'periodo_plan', $type_list, array('id'=>'tipo_modulo' , 'class' => 'form-control','empty'=>'Seleccione','disabled'=>!$model->isNewRecord));
							?>
						<?php echo $form->error($model,'periodo_plan'); ?>
				  	 </div>
				  </div>	
				 <div class="col-md-6">
					<div class="form-group has-feedback">
						<?php echo $form->labelEx($model,'Moneda'); ?><br>
							<?php 
								$sql1 = "select codigo, nombre from parametros b where  b.tipo='moneda'";
							
								$consulta1 = Yii::app()->db->createCommand($sql1)->queryAll();
							
								$type_list=CHtml::listData($consulta1,'codigo','nombre');
					
								echo $form->dropDownList($model,'moneda', $type_list, array('id'=>'moneda' , 'class' => 'form-control','empty'=>'Seleccione','disabled'=>!$model->isNewRecord));
							?>
						<?php echo $form->error($model,'moneda'); ?>
					</div>
				  </div>
				</div>	


				<div class="form-group">
					<?php echo $form->labelEx($model,'descripcion'); ?>
					<?php echo $form->textArea($model,'descripcion',array('id'=>'descripcion','class' => 'form-control','rows'=>6, 'cols'=>50)); ?>
					<?php echo $form->error($model,'descripcion'); ?>
				</div>
				<div class="form-group">
					<?php echo $form->labelEx($model,'Número de mensajes push'); ?>
					<?php echo $form->textField($model,'mensajes_push'); ?>
					<?php echo $form->error($model,'mensajes_push'); ?>
				</div>
					<div class="form-group has-feedback">
					<?php
					   $array=[];
					  
					   foreach($model->modulos as $modulo):
						   if($modulo['estado']==1){
					    	 $array[]=$modulo['codigo'];
						   } 
					   endforeach;	 
					  
					echo CHtml::checkBoxList(
						"Modulos",
						$array,
						CHtml::listData($model->modulos,'codigo','nombre'),
						array(
							
							"style" => "width: 10px; margin-left:5px; margin-right:5px; float:left;",
							'checkAll'=>'seleccionar todos')
					); ?>
					</div>
				
				<div class="form-group">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array ('class' => 'btn btn-info pull-right')); ?>
				</div>
                <?php $this->endWidget(); ?>
    
</div><!-- form -->