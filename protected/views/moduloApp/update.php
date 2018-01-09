<?php
/* @var $this ModuloAppController */
/* @var $model ModuloApp */

$this->breadcrumbs=array(
	'Modulo Apps'=>array('index'),
	$model->id_modulo_app=>array('view','id'=>$model->id_modulo_app),
	'Update',
);

$this->menu=array(
	array('label'=>'List ModuloApp', 'url'=>array('index')),
	array('label'=>'Create ModuloApp', 'url'=>array('create')),
	array('label'=>'View ModuloApp', 'url'=>array('view', 'id'=>$model->id_modulo_app)),
	array('label'=>'Manage ModuloApp', 'url'=>array('admin')),
);
?>

<h1>Update ModuloApp <?php echo $model->id_modulo_app; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>