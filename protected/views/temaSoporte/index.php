<?php
/* @var $this TemaSoporteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tema Soportes',
);

$this->menu=array(
	array('label'=>'Create TemaSoporte', 'url'=>array('create')),
	array('label'=>'Manage TemaSoporte', 'url'=>array('admin')),
);
?>

<h1>Tema Soportes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
