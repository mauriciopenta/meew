<?php
/* @var $this AplicacionController */
/* @var $model Aplicacion */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/style_form.css');


$this->breadcrumbs=array(
	'Mcontactos'=>array('index'),
	$model->id_mcontacto=>array('view','id'=>$model->id_mcontacto),
	'Update',
);

$this->menu=array(
/*	array('label'=>'List MContacto', 'url'=>array('index')),
	array('label'=>'Create MContacto', 'url'=>array('create')),
	array('label'=>'View MContacto', 'url'=>array('view', 'id'=>$model->id_mcontacto)),
	array('label'=>'Manage MContacto', 'url'=>array('admin')),*/
);
?>

<section class="content" >
 <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
            <div class="box-body">

			<h1>Responder Mensaje</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
