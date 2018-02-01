<?php
/* @var $this PushNotificacionesController */
/* @var $model PushNotificaciones */

$this->breadcrumbs=array(
	'Push Notificaciones'=>array('index'),
	$model->idpush_notificaciones=>array('view','id'=>$model->idpush_notificaciones),
	'Update',
);

$this->menu=array(
	array('label'=>'List PushNotificaciones', 'url'=>array('index')),
	array('label'=>'Create PushNotificaciones', 'url'=>array('create')),
	array('label'=>'View PushNotificaciones', 'url'=>array('view', 'id'=>$model->idpush_notificaciones)),
	array('label'=>'Manage PushNotificaciones', 'url'=>array('admin')),
);
?>

<h1>Update PushNotificaciones <?php echo $model->idpush_notificaciones; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>