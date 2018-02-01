<?php
/* @var $this MViralController */
/* @var $model MViral */

$this->breadcrumbs=array(
	'Mvirals'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MViral', 'url'=>array('index')),
	array('label'=>'Create MViral', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#mviral-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Mvirals</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mviral-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass' => 'table table-bordered table-striped dataTable',
					
	'filter'=>$model,
	'columns'=>array(
		'id_mviral',
		'mviral_url_fb',
		'mviral_url_tw',
		'mviral_url_inst',
		'aplicacion_idaplicacion',
		'aplicacion_usuario_id_usuario',
		/*
		'correo_contacto',
		*/
		array(
			'class'=>'CButtonColumn',
			'updateButtonImageUrl'=>Yii::app()->baseUrl.'/img/edit.png',
		   
			'deleteButtonImageUrl'=>Yii::app()->baseUrl.'/img/delete.png',
			
			'viewButtonImageUrl'=>Yii::app()->baseUrl.'/img/view.png',
		
		),
	),
)); ?>
