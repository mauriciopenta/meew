<?php
/* @var $this MViralController */
/* @var $model MViral */

$this->breadcrumbs=array(
	'Mvirals'=>array('index'),
	$model->id_mviral=>array('view','id'=>$model->id_mviral),
	'Update',
);

$this->menu=array(
	array('label'=>'List MViral', 'url'=>array('index')),
	array('label'=>'Create MViral', 'url'=>array('create')),
	array('label'=>'View MViral', 'url'=>array('view', 'id'=>$model->id_mviral)),
	array('label'=>'Manage MViral', 'url'=>array('admin')),
);
?>

<h1>Update MViral <?php echo $model->id_mviral; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>