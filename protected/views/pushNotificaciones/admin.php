<?php
/* @var $this PushNotificacionesController */
/* @var $model PushNotificaciones */

$this->breadcrumbs=array(
	'Push Notificaciones'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#push-notificaciones-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>






<section class="content" >
<div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Historial Notifiaciones</h3>
            </div>
            <div class="box-body">
              <p>
				Opcionalmente, puede ingresar un operador de comparación (<, <=,>,> =, <> o =) al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.	</p>

				<div class="search-form" style="display:none">
				<?php $this->renderPartial('_search',array(
					'model'=>$model,
				)); ?>
				</div><!-- search-form -->

					<?php $this->widget('zii.widgets.grid.CGridView', array(
						'id'=>'push-notificaciones-grid',
						'itemsCssClass' => 'table table-bordered table-striped dataTable',
						'dataProvider'=>$model->search(),
						'filter'=>$model,
						'columns'=>array(
							'idpush_notificaciones',
							'titulo',
							'cuerpo',
							'genero',
							'edad',
							'id_aplicacion',
							array(
								'class'=>'CButtonColumn',
								'template'=>'{ver}',
								'buttons'=>array
								(
									'ver' => array
									(
										'label'=>'Descargar recursos',
										'imageUrl'=>Yii::app()->baseUrl.'/img/view.png',
										'url'=>'Yii::app()->controller->createUrl("pushNotificaciones/view",array("id"=>$data["idpush_notificaciones"]))'
									)
								)
							),
						),
					)); ?>
					<a href="<?php echo Yii::app()->request->baseUrl?>/index.php/pushNotificaciones/create">
					<button class="btn btn-info pull-right"   >Crear </button>
					</a>
      </div>
     </div>
    </div>





   </section>