<?php
/* @var $this ModuloAppController */
/* @var $model ModuloApp */

$this->breadcrumbs=array(
	'Modulo Apps'=>array('index'),
	$model->id_modulo_app=>array('view','id'=>$model->id_modulo_app),
	'Update',
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

                <?php 
                
                $this->renderPartial('createModulo', array('model'=>$model,'model_aplicacion'=>$model_aplicacion,$model,"modulos"=>$modulos ));
                
                
									
                
                ?>




      </div>
     </div>
    </div>
 </section>