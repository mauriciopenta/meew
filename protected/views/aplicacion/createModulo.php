<?php

	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/ckeditor/ckeditor.js",CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js",CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/Modulo/Modulo.js",CClientScript::POS_END);
	
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/IconPicker/css/framework7-icons.css');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/IconPicker/css/asIconPicker.css');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/jquery-asIconPicker.js",CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/jquery.toc.js",CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/prism.js",CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/jquery-asTooltip.min.js",CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/jquery-asScrollbar.js",CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/jquery.mousewheel.js",CClientScript::POS_END);

 ?>

<div class="form" id="divModulo">

<section class="content" id="divModulo">
<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'modulo-app-form',
"method" => "post",
					
'enableClientValidation'=>true,
'enableAjaxValidation'=>true,
'clientOptions'=>array(
		'validateOnSubmit'=>true)
)
); ?>
	<p class="note">Agregar Módulo</p>
	<?php echo $form->errorSummary($model); ?>
	<div class="form-group has-feedback">
	    <?php echo $form->labelEx($model,'tipo módulo'); ?><br>
            <?php 
				$sql1 = "select codigo, nombre from parametros b where  b.tipo='modulo' and b.max>(select COUNT(codigo) from modulo_app a where a.aplicacion_usuario_id_usuario=".Yii::app()->user->getState('id_usuario'). " and a.tipo_modulo=b.codigo )";
			
				$consulta1 = Yii::app()->db->createCommand($sql1)->queryAll();
			
				$type_list=CHtml::listData($consulta1,'codigo','nombre');
	
				echo $form->dropDownList($model,'tipo_modulo', $type_list, array('id'=>'tipo_modulo' , 'class' => 'form-control','empty'=>'Seleccione','disabled'=>!$model->isNewRecord));
			?>
		<?php echo $form->error($model,'tipo_modulo'); ?>
	</div>





	<div class="form-group has-feedback">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre_modulo',array('class' => 'form-control')); ?>
		<?php echo $form->error($model,'nombre_modulo'); ?>
	</div>

	
	<div class="form-group has-feedback">
	    <?php echo 'seleccione en que menú del aplicativo ira el módulo.'; ?><br>
		   <?php 
    	   $condicion="";
           $params=array();
		   $sql = "select a.orden as orden, a.tipo_menu as tipo_menu, a.id_modulo_app as id_modulo_app , a.nombre_modulo as Nombre, b.nombre as Tipo  from modulo_app a, parametros b where a.tipo_modulo=b.codigo AND b.tipo='modulo' AND a.tipo_menu=1 AND a.aplicacion_usuario_id_usuario=".Yii::app()->user->getState('id_usuario')." order by tipo_menu, a.orden asc";
		   $consulta1 = Yii::app()->db->createCommand($sql)->queryAll();
		   $totaltab = count($consulta1);
           $sql2 = "select a.orden as orden, a.tipo_menu as tipo_menu, a.id_modulo_app as id_modulo_app , a.nombre_modulo as Nombre, b.nombre as Tipo  from modulo_app a, parametros b where a.tipo_modulo=b.codigo AND b.tipo='modulo' AND a.tipo_menu=2 AND a.aplicacion_usuario_id_usuario=".Yii::app()->user->getState('id_usuario')." order by tipo_menu, a.orden asc";
		   $consulta2 = Yii::app()->db->createCommand($sql)->queryAll();
		   $totalmenu = count($consulta2);
		   $type_list=array();
           if($totalmenu<13 && $totaltab<3){
			$type_list= array('1'=>'tab', '2'=>'principal');
		   }else if($totalmenu<13 && $totaltab>=3){
			 $type_list= array( '2'=>'principal');
		   }else if($totalmenu>=12 && $totaltab<3){
			$type_list= array('1'=>'tab');
		   }
			echo $form->dropDownList($model,'tipo_menu', $type_list, array('id'=>'tipo_menu' , 'class' => 'form-control','empty'=>'Seleccione'));
		?>
		<?php echo $form->error($model,'tipo_menu'); ?>
	</div>
    <div class="form-group has-feedback">
     	<?php echo $form->labelEx($model,'icono'); ?>
        <?php echo $form->textField($model,'icon' ,array('id'=>"default_input", 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'icon'); ?>
	</div>
	<?php 
	
	    if( $model_aplicacion->id_plantilla==2){ ?>
			<div id="option_slider">
					<div class="form-group has-feedback">
						<?php echo $form->labelEx($model,'Texto boton de enlace (slider)'); ?>
						<?php echo $form->textField($model,'texto_button',array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'texto_button'); ?>
					</div>
					<div class="form-group has-feedback" id="descripcion">


				    	<?php echo $form->labelEx($model,'Descripcion del Modulo (slider)'); ?>
						<?php echo $form->textField($model,'texto_descripcion',array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'texto_descripcion'); ?>
					
					</div>
			</div>
		<?php } ?>
		<?php if(!$model->isNewRecord){ ?>

			<div class="form-group has-feedback" id="articulo">
				
			
				<?php echo $form->labelEx($model,'texto_html'); ?>
				<?php echo $form->textArea($model,'texto_html',array('id'=>'html_text','class' => 'form-control','rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'texto_html'); ?>
				</div>
			</div>
	    <?php } ?>
		<div class="form-group has-feedback" id="multimedia" >
		<?php echo $form->labelEx($model,'Galeria'); ?>
			<?php
			   if ($model->galleryBehavior->getGallery() === null) {
				echo '<p>Before add photos, you need to save at least once</p>';
		     	} else {
					$this->widget('GalleryManager', array(
						'gallery' => $model->galleryBehavior->getGallery(),
						'controllerRoute'=>'galleryApi'
						)); 
			   }
			?>
     	</div>
		<div class="form-group has-feedback" id="tienda" >
		<?php echo $form->labelEx($model,'Tienda'); ?>
			<?php
			   if ($model->tiendaBehavior->getGallery() === null) {
				echo '<p>Debes crear la Tienda primero</p>';
		     	} else {
					$this->widget('GalleryManager', array(
						'gallery' => $model->tiendaBehavior->getGallery(),
						'controllerRoute'=>'galleryApi'
						)); 
			   }
			?>
    	</div>
  
  
  
      <div class="form-group has-feedback">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array ('class' => 'btn btn-info pull-right')); ?>
	</div>
<?php $this->endWidget(); ?>
</section>
</div><!-- form -->






