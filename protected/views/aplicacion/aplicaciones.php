<?php
/* @var $this AplicacionController */
/* @var $model Aplicacion */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/style_form.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/datatables/dataTables.bootstrap.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/datatables/jquery.dataTables.min.js",CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/datatables/dataTables.bootstrap.min.js",CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/Usuario/Usuario.js",CClientScript::POS_END);


$this->breadcrumbs=array(
	'Mcontactos'=>array('index'),
	'Manage',
);

$this->menu=array(
	
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#mcontacto-grid').yiiGridView('update', {
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
              <h3 class="box-title">Aplicaciones</h3>
            </div>
            <div class="box-body">
              <p>
               Opcionalmente, puede ingresar un operador de comparación (<, <=,>,> =, <> o =) al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.	
              </p>
				<div class="search-form" style="display:none">

                

				<?php 
				
				$this->renderPartial('_search_aplicaciones',array(
					'model'=>$model,
				)); ?>
				</div><!-- search-form -->
		
			
		
		
		
			<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'mcontacto-grid',
				'itemsCssClass' => 'table table-bordered table-striped dataTable',
				'dataProvider'=>$model->search_app(),
				'filter'=>$model,
				'columns'=>array(
					array(
						
						'header' => 'Id Aplicacion',
						'name' => 'idaplicacion'
					),
					array(
			
						'header' => 'Nombre',
						'name' => 'nombre'
					),
					array(
			
						'header' => 'Id plantilla',
						'name' => 'id_plantilla'
					),
					array(
			
						'header' => 'Nombre de Paquete',
						'name' => 'paquete'
					),
					
					
					array(
						'class'=>'CButtonColumn',
						'template'=>'{Recursos}{Editar}{config}',
						'buttons'=>array
						(
							'Recursos' => array
							(
								'label'=>'Descargar recursos',
								'imageUrl'=>Yii::app()->baseUrl.'/img/download.png',
								'url'=>'Yii::app()->controller->createUrl("aplicacion/download_resources",array("idaplicacion"=>$data["idaplicacion"]))'
							),
							'Editar' => array
							(
								'label'=>'Editar',
								'imageUrl'=>Yii::app()->baseUrl.'/img/edit.png',
								'url'=>'Yii::app()->controller->createUrl("aplicacion/updateApp",array("id"=>$data["idaplicacion"]))'
							),

							'config' => array
							(
								'label'=>'Configurar Notificaciones',
								'imageUrl'=>Yii::app()->baseUrl.'/img/notificacion2.png',
								'url'=>'Yii::app()->controller->createUrl("pushParametros/config",array("id"=>$data["idaplicacion"]))'
							)
						


						)
                       
					
					),
				),
			)); ?>


		
      </div>
     </div>
    </div>
 </section>