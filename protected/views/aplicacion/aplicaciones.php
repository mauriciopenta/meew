<?php
/* @var $this AplicacionController */
/* @var $model Aplicacion */
/* @var $form CActiveForm */

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
<div class="row" id="divAdmin">
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Aplicaciones</h3>
            </div>
            <div class="box-body">
            
				<div class="search-form" style="display:none">
				<?php 
				$this->renderPartial('_search_aplicaciones',array(
					'model'=>$model,
				)); ?>
				</div><!-- search-form -->
			<?php 
					$sql="select nombre from parametros p where p.tipo='estado_aplicacion'";
					$consulta = Yii::app()->db->createCommand($sql)->queryAll();
					$type_list=CHtml::listData($consulta,'codigo','nombre');
					$this->widget('zii.widgets.grid.CGridView', array(
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
					
								'header' => 'Plantilla',
								'name' => 'id_plantilla'
							),
							array(
					
								'header' => 'Nombre de Paquete',
								'name' => 'paquete'
							),
							array(
								'type'=>'raw',
								'header' => 'Estado',
								'name'=>'estado_search',
								'value'=> 'CHtml::dropDownList(
									"estado_search",
									 $data[\'estado_search\'],
									CHtml::listData(
											Parametros::model()->findAll("tipo=\'estado_aplicacion\'"),
											"codigo",
											"nombre"
											),
											array(
												"class" => "form-control",
												"id"=> "estado".$data[\'idaplicacion\'], 
												"ajax" => array(
													"type" => "GET",
													"dataType"=>"json",
													"url" => Yii::app()->createUrl(\'aplicacion/status\'),
											        "data"=> array(\'id\'=>$data[\'idaplicacion\'], \'estado\'=>\'js:this.value\')
												),
												
											
													"estado"=>$data->estado,
													"class"=>"drop",
													"options"=>array($data->estado =>array("selected"=>"selected")),
											)
									)'
							),  
							array(
								'class'=>'CButtonColumn',
								'template'=>'{Recursos}{config}',
								'buttons'=>array
								(
									'Recursos' => array
									(
										'label'=>'Descargar recursos',
										'imageUrl'=>Yii::app()->baseUrl.'/img/download.png',
										'url'=>'Yii::app()->controller->createUrl("aplicacion/download_resources",array("idaplicacion"=>$data["idaplicacion"]))'
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
					)); 
				?>

       </div>
		
      </div>
     </div>
    </div>
 </section>