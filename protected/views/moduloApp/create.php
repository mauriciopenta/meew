<?php
/* @var $this ModuloAppController */
/* @var $model ModuloApp */

$this->breadcrumbs=array(
	'Modulo Apps'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ModuloApp', 'url'=>array('index')),
	array('label'=>'Manage ModuloApp', 'url'=>array('admin')),
);
?>

<h1>Create ModuloApp</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>