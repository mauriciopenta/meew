<?php
/* @var $this PlanController */
/* @var $model Plan */

$this->breadcrumbs=array(
	'Plans'=>array('index'),
	$model->id_plan=>array('view','id'=>$model->id_plan),
	'Update',
);

?>
<section class="content" >
<div class="row">
	 <div class="col-md-12">
	   <div class="box box-primary">
		   <div class="box-header with-border">
			 <h3 class="box-title">Plan <?php echo $model->plan_nombre; ?></h3>
		   </div>
		   <div class="box-body">

		  
           <?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
   </div>
 </div>
</section>