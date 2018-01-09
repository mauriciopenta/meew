<?php
/* @var $this SoporteAppController */
/* @var $model SoporteApp */

$this->breadcrumbs=array(
	'Soporte Apps'=>array('index'),
	$model->idsoporte_app,
);

?>
<section class="content" >
 <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> SoporteApp </h3>
            </div>
            <div class="box-body">

			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					'idsoporte_app',
					'mensaje',
					'respuesta',
					'fecha_creacion',
					'fecha_modificacion',
					'id_tema',
					'id_aplicacion',
				),
			)); ?>
      </div>
     </div>
    </div>
   </section>