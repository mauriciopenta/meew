<?php
/* @var $this TemaSoporteController */
/* @var $model TemaSoporte */

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/style_form.css');

$this->breadcrumbs=array(
	'Tema Soportes'=>array('index'),
	$model->idtema_soporte=>array('view','id'=>$model->idtema_soporte),
	'Update',
);


?>


<section class="content" >
<div class="row">
	 <div class="col-md-12">
	   <div class="box box-primary">
		   <div class="box-header with-border">
		     <h3>Actualizar Tema Soporte</h3>
         
		   </div>
		   <div class="box-body">

		     
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>

			  </div>
     </div>
    </div>
 </section>