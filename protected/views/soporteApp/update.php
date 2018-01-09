<?php
/* @var $this SoporteAppController */
/* @var $model SoporteApp */

$this->breadcrumbs=array(
	'Soporte Apps'=>array('index'),
	$model->idsoporte_app=>array('view','id'=>$model->idsoporte_app),
	'Update',
);

?>

<section class="content" >
<div class="row">
	 <div class="col-md-12">
	   <div class="box box-primary">
		   <div class="box-header with-border">
		     <h3>Responder Mensaje Soporte</h3>
         
		   </div>
		   <div class="box-body">
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		   </div>
     </div>
    </div>
 </section>