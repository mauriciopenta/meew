<?php
/* @var $this SoporteAppController */
/* @var $model SoporteApp */

$this->breadcrumbs=array(
	'Soporte Apps'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SoporteApp', 'url'=>array('index')),
	array('label'=>'Manage SoporteApp', 'url'=>array('admin')),
);
?>

<h1>Create SoporteApp</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>