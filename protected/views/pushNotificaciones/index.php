<?php
/* @var $this PushNotificacionesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Push Notificaciones',
);

$this->menu=array(
	array('label'=>'Create PushNotificaciones', 'url'=>array('create')),
	array('label'=>'Manage PushNotificaciones', 'url'=>array('admin')),
);
?>

<h1>Push Notificaciones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
