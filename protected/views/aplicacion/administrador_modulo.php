<?php
/* @var $this ModuloAppController */
/* @var $model ModuloApp */

$this->breadcrumbs=array(
	'Modulo Apps'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ModuloApp', 'url'=>array('index')),
	array('label'=>'Create ModuloApp', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#modulo-app-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<div class="search-form" style="display:none">
<?php $this->renderPartial('_search_modulo',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'modulo-app-grid',
	'itemsCssClass' => 'table table-bordered table-striped dataTable',
				
	'dataProvider'=>$model->search_app(),
	'filter' => null, 
	'columns'=>array(
		
        array(
			'header' => 'Orden',
            'name' => 'orden'
		),
		array(
			'header' => 'tipo_menu',
            'name' => 'tipo_menu'
        ),
	    array(
            'header' => 'Nombre',
            'name' => 'Nombre'
        ),
        array(
            'header' => 'Tipo',
            'name' => 'Tipo'
		),
		
		array(
            'name'=>'icon',
			'type' => 'raw',
			'value'=>function($data){
			return '<i  class="f7-icons size-20" style=" color: #000000 !important; " >'.$data["icon"].'</i>';
			}),


		array(
			'class'=>'CButtonColumn',
			'viewButtonUrl'=>'Yii::app()->controller->createUrl("aplicacion/view",array("id"=>$data["id_modulo_app"]))',
			'updateButtonUrl'=>'Yii::app()->controller->createUrl("aplicacion/update",array("id"=>$data["id_modulo_app"]))',
			'deleteButtonUrl'=>'Yii::app()->controller->createUrl("aplicacion/delete",array("id"=>$data["id_modulo_app"]))',
			'deleteConfirmation'=>"js:'Esta seguro de eliminar el modulo?' ",
			'updateButtonImageUrl'=>Yii::app()->baseUrl.'/img/edit.png',
		   
			'deleteButtonImageUrl'=>Yii::app()->baseUrl.'/img/delete.png',
			
			'viewButtonImageUrl'=>Yii::app()->baseUrl.'/img/view.png',
			
			)
	    ))); 
		
		?>
