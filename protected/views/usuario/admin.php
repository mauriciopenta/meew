<?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/datatables/dataTables.bootstrap.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/datatables/jquery.dataTables.min.js",CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/datatables/dataTables.bootstrap.min.js",CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/Usuario/Admin.js",CClientScript::POS_END);
    



$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Usuario', 'url'=>array('index')),
	array('label'=>'Create Usuario', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#usuario-grid').yiiGridView('update', {
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
              <h3 class="box-title">Usuarios</h3>
            </div>
            <div class="box-body">
              <p>
               Opcionalmente, puede ingresar un operador de comparación (<, <=,>,> =, <> o =) al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.	
              </p>

				<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
				<div class="search-form" style="display:none">
				<?php $this->renderPartial('_search',array(
					'model'=>$model,
				)); ?>
				</div><!-- search-form -->


					<?php $this->widget('zii.widgets.grid.CGridView', array(
						'id'=>'usuario-grid',
						'itemsCssClass' => 'table table-bordered table-striped dataTable',
						'dataProvider'=>$model->search(),

						'filter'=>$model,
						'columns'=>array(
							'id_usuario',
							'id_tipologin',
							'id_persona',
							'id_rol',
							'id_empresa',
							'usuario',
							/*
							'password',
							'usuario_activo',
							*/
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
    </div>
</section>