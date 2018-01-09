<?php
/* @var $this TemaSoporteController */
/* @var $model TemaSoporte */

$this->breadcrumbs=array(
	'Tema Soportes'=>array('index'),
	$model->idtema_soporte,
);


?>
<section class="content" >
 <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> TemaSoporte </h3>
            </div>
            <div class="box-body">

			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					'idtema_soporte',
					'titulo',
					'descripcion',
					'fecha',
					'id_aplicacion',
				),
			)); ?>
</div>
     </div>
    </div>
   </section>