<?php
/* @var $this MContactoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mcontactos',
);

$this->menu=array(
	array('label'=>'Create MContacto', 'url'=>array('create')),
	array('label'=>'Manage MContacto', 'url'=>array('admin')),
);
?>

<h1>Mcontactos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
