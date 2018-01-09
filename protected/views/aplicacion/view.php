<?php
/* @var $this ModuloAppController */
/* @var $model ModuloApp */

$this->breadcrumbs=array(
	'Modulo Apps'=>array('index'),
	$model->id_modulo_app,
);


?>

<section class="content" >
 <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
            <div class="box-body">
			<h1>Editar Módulo </h1>

            <?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					'id_modulo_app',
					'nombre_modulo',
					'texto_html',
					'tipo_modulo',
					'aplicacion_idaplicacion',
					'aplicacion_usuario_id_usuario',
				),
			)); ?>
      </div>
     </div>
    </div>
 </section>

