<?php
/* @var $this ModuloAppController */
/* @var $model ModuloApp */

$this->breadcrumbs=array(
	'Modulo Apps'=>array('index'),
	$model->id_modulo_app=>array('view','id'=>$model->id_modulo_app),
	'Update',
);

$this->menu=array(
	array('label'=>'List ModuloApp', 'url'=>array('index')),
	array('label'=>'Create ModuloApp', 'url'=>array('create')),
	array('label'=>'View ModuloApp', 'url'=>array('view', 'id'=>$model->id_modulo_app)),
	array('label'=>'Manage ModuloApp', 'url'=>array('admin')),
);
?>
<section class="content" >
 <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
            <div class="box-body">
			<h1>Editar Modulo </h1>

                <?php $this->renderPartial('createModulo', array('model'=>$model)); ?>

      </div>
     </div>
    </div>
 </section>