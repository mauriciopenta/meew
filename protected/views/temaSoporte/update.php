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
			 <h3>
				 <?php  
				 if($model->hijo=='0'){
            echo "Editar tema soporte";
				 }else{
				  	echo "Editar subtema soporte";
				 } 
				 
				 ?>
				 </h3>
         
		   </div>
		   <div class="box-body">
        
		     
				<?php 
			    	$this->renderPartial('_form', array('model'=>$model,'subtema'=>$subtema,'model_table'=>$model_table)); ?>

			  </div>
     </div>
    </div>
 </section>