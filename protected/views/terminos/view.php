<?php
/* @var $this TerminosController */
/* @var $model Terminos */

$this->breadcrumbs=array(
	'Terminoses'=>array('index'),
	$model->idterminos,
);

$this->menu=array(
	array('label'=>'List Terminos', 'url'=>array('index')),
	array('label'=>'Create Terminos', 'url'=>array('create')),
	array('label'=>'Update Terminos', 'url'=>array('update', 'id'=>$model->idterminos)),
	array('label'=>'Delete Terminos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idterminos),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Terminos', 'url'=>array('admin')),
);
?>

<h1>View Terminos #<?php echo $model->idterminos; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idterminos',
		'terminos',
		'id_aplicacion',
		'tipo',
	),
)); ?>
