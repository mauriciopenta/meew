<?php
/* @var $this PlanController */
/* @var $model Plan */

$this->breadcrumbs=array(
	'Plans'=>array('index'),
	'Create',
);


?>

<section class="content" >
<div class="row">
	 <div class="col-md-12">
	   <div class="box box-primary">
		   <div class="box-header with-border">
			 <h3 class="box-title">Crear plan</h3>
		   </div>
		   <div class="box-body">
		
           <?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
   </div>
 </div>
</section>