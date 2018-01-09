<?php
/* @var $this TemaSoporteController */
/* @var $model TemaSoporte */

$this->breadcrumbs=array(
	'Tema Soportes'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tema-soporte-grid').yiiGridView('update', {
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
              <h3 class="box-title">Mensajes</h3>
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
					'id'=>'tema-soporte-grid',
					'dataProvider'=>$model->search_app(),
					'filter'=>$model,
					'columns'=>array(
						'idtema_soporte',
						'titulo',
						'descripcion',
						'fecha',
						array(
							'class'=>'CButtonColumn',
						),
					),
				)); ?>

				<div class="center_button" >
					<a href="<?php echo Yii::app()->request->baseUrl?>/index.php/temaSoporte/create"><?php echo CHtml::submitButton('Crear', array ('class' => 'btn btn-info pull-right')); ?></a>
				</div>
				</div>
     </div>
    </div>
 </section>