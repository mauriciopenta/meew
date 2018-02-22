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
				'id'=>'mcontacto-grid',
				'itemsCssClass' => 'table table-bordered table-striped dataTable',
				'dataProvider'=>$model->search_id_app(),
				'filter'=>$model,
				'columns'=>array(
					'usuario',
					'id_mcontacto',
					'mcontacto_mensaje',
					'asunto',
					
					'aplicacion_usuario_id_usuario',
					'fecha',
					'respuesta',
					array(
						'class'=>'CButtonColumn',
						'updateButtonImageUrl'=>Yii::app()->baseUrl.'/img/edit.png',
		   
						'deleteButtonImageUrl'=>Yii::app()->baseUrl.'/img/delete.png',
						
						'viewButtonImageUrl'=>Yii::app()->baseUrl.'/img/view.png',
					
					),
				),
			)); ?>


		
      </div>
     </div>
    </div>
 </section>