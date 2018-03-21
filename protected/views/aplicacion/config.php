<?php
/* @var $this AplicacionController */
/* @var $model Aplicacion */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/colorpicker/bootstrap-colorpicker.min.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/iCheck/all.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/colorpicker/bootstrap-colorpicker.min.js",CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/iCheck/icheck.min.js",CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/IconPicker/css/framework7-icons.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/IconPicker/css/asIconPicker.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/jquery-asIconPicker.js",CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/jquery.toc.js",CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/prism.js",CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/jquery-asTooltip.min.js",CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/jquery-asScrollbar.js",CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/IconPicker/jquery.mousewheel.js",CClientScript::POS_END);


?>

<script  src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCmaKXUxZlLs8JTKXAZEkdI6_QZzIVVPnc"></script>
  
<?php

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/Aplicacion/Aplicacion.js",CClientScript::POS_END);

/* @var $this UsuarioController */

$this->pageTitle=Yii::app()->name . ' - Configurar Aplicación';
$this->breadcrumbs=array(
	'Aplicacion'=>array('/aplicacionConfig'),
	'aplicacionConfig',
);
?>


<div class="form">
<section class="content" id="divAplicacion">
   <?php $this->renderPartial('plantilla_config', array('model'=>$model,'modelAplicacion'=>$modelAplicacion)); ?>
	<?php 
	   $aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
        
	   if(is_object($aplicacionFromDb) && isset($aplicacionFromDb->nombre)){
   
	
			$this->renderPartial('info_contacto', array('modelViral'=>$modelViral)); ?>
			
			
				<div class="box box-info" id="modulos" action="#modulos">
							<div class="box-header">
							<h3 class="box-title">Modulos</h3>
							</div>
							<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<?php $this->renderPartial('administrador_modulo', array('model'=>$moduloSearch)); ?>
									<?php
											$this->renderPartial('createModulo', array('model'=>$moduloApp,'model_aplicacion'=>$model,"modulos"=>$modulos)); 
										
									?>
								</div>
						</div>
					</div>
				</div>

		<div class="box box-info">
		<div class="form" id="ordenModulo" action="#ordenModulo">
			<?php $this->renderPartial('orden', array('model'=>$model)); ?>
					
		</div>
	   <?php }?>
	</div>
</div>
</section>



