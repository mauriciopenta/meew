<?php
/* @var $this SoporteAppController */
/* @var $model SoporteApp */

$this->breadcrumbs=array(
	'Soporte Apps'=>array('index'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#soporte-app-grid').yiiGridView('update', {
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
              <h3 class="box-title">Mensajes Soporte</h3>
            </div>
            <div class="box-body">
              <p>
               Opcionalmente, puede ingresar un operador de comparación (<, <=,>,> =, <> o =) al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.	
              </p>
					<div class="search-form" style="display:none">
					<?php $this->renderPartial('_search',array(
						'model'=>$model,
					)); ?>
					</div><!-- search-form -->

					<?php $this->widget('zii.widgets.grid.CGridView', array(
						'id'=>'soporte-app-grid',
						'dataProvider'=>$model->search_app(),
						'filter'=>$model,
						'columns'=>array(
							'idsoporte_app',
							'mensaje',
							'respuesta',
							'fecha_creacion',
							'fecha_modificacion',
							'id_tema',
							/*
							'id_aplicacion',
							*/
							array(
								'class'=>'CButtonColumn',
							),
						),
					)); ?>
			</div>
     </div>
    </div>
 </section>