<?php
/* @var $this PushNotificacionesController */
/* @var $model PushNotificaciones */

$this->breadcrumbs=array(
	'Push Notificaciones'=>array('index'),
	'Create',
);


?>


<?php $this->renderPartial('_form', array('model'=>$model,"modeloUsuario"=>$modeloUsuario,
            "modeloPersona"=>$modeloPersona,
            "personas"=>$personas,
            "dataTipoLogin"=>$dataTipoLogin,"genero"=>$genero,
			"edades"=> $edades)); ?>
