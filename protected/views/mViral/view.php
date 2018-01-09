<?php
/* @var $this MViralController */
/* @var $model MViral */

$this->breadcrumbs=array(
	'Mvirals'=>array('index'),
	$model->id_mviral,
);

$this->menu=array(
	array('label'=>'List MViral', 'url'=>array('index')),
	array('label'=>'Create MViral', 'url'=>array('create')),
	array('label'=>'Update MViral', 'url'=>array('update', 'id'=>$model->id_mviral)),
	array('label'=>'Delete MViral', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_mviral),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MViral', 'url'=>array('admin')),
);
?>

<h1>View MViral #<?php echo $model->id_mviral; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_mviral',
		'mviral_url_fb',
		'mviral_url_tw',
		'mviral_url_inst',
		'aplicacion_idaplicacion',
		'aplicacion_usuario_id_usuario',
		'correo_contacto',
	),
)); ?>
