<?php
/* @var $this PushParametrosController */
/* @var $model PushParametros */

$this->breadcrumbs=array(
	'Push Parametroses'=>array('index'),
	$model->idparametros_push=>array('view','id'=>$model->idparametros_push),
	'Update',
);

?>


<section class="content" >
<div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Parámetros push aplicación : <?php echo $model->id_aplicacion; ?></h3>
            </div>
            <div class="box-body">
              <?php $this->renderPartial('_form', array('model'=>$model)); ?>
	       </div>
     </div>
    </div>
	</div>
 </section>