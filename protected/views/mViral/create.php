<?php
/* @var $this MViralController */
/* @var $model MViral */

$this->breadcrumbs=array(
	'Mvirals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MViral', 'url'=>array('index')),
	array('label'=>'Manage MViral', 'url'=>array('admin')),
);
?>

<h1>Create MViral</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>