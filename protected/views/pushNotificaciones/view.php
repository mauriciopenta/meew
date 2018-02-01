<?php
/* @var $this PushNotificacionesController */
/* @var $model PushNotificaciones */

$this->breadcrumbs=array(
	'Push Notificaciones'=>array('index'),
	$model->idpush_notificaciones,
);


?>


<section class="content" >
<div class="row">
    <div class="col-md-12">
	<div class="form" id="divPush">
	<div class="box box-primary">
            <div class="box-header with-border">
			<h3>PushNotificaciones # <?php echo $model->idpush_notificaciones; ?></h3>
            </div>
            <div class="box-body">
     

		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'idpush_notificaciones',
				'titulo',
				'cuerpo',
				'genero',
				'edad',
				'id_aplicacion',
				'id_modulo',
			),
		)); ?>
		   </div><!-- form -->
         </div>
       </div><!-- form -->
     </div>
   </div>
 </section>