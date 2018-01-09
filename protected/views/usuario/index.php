<?php
/* @var $this ModuloAppController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Modulo Apps',
);

$this->menu=array(
	array('label'=>'Create ModuloApp', 'url'=>array('create')),
	array('label'=>'Manage ModuloApp', 'url'=>array('admin')),
);
?>

<h1>Modulo Apps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
