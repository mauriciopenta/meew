<?php
/* @var $this SoporteAppController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Soporte Apps',
);

$this->menu=array(
	array('label'=>'Create SoporteApp', 'url'=>array('create')),
	array('label'=>'Manage SoporteApp', 'url'=>array('admin')),
);
?>

<h1>Soporte Apps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
