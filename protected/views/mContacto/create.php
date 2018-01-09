<?php
/* @var $this MContactoController */
/* @var $model MContacto */

$this->breadcrumbs=array(
	'Mcontactos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MContacto', 'url'=>array('index')),
	array('label'=>'Manage MContacto', 'url'=>array('admin')),
);
?>

<h1>Create MContacto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>