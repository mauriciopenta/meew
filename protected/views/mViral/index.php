<?php
/* @var $this MViralController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mvirals',
);

$this->menu=array(
	array('label'=>'Create MViral', 'url'=>array('create')),
	array('label'=>'Manage MViral', 'url'=>array('admin')),
);
?>

<h1>Mvirals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
