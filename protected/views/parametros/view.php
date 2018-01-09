
<?php
/* @var $this AplicacionController */
/* @var $model Aplicacion */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/style_form.css');





$this->breadcrumbs=array(
	'Parametroses'=>array('index'),
	$model->idparametros,
);

$this->menu=array(
	array('label'=>'List Parametros', 'url'=>array('index')),
	array('label'=>'Create Parametros', 'url'=>array('create')),
	array('label'=>'Update Parametros', 'url'=>array('update', 'id'=>$model->idparametros)),
	array('label'=>'Delete Parametros', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idparametros),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Parametros', 'url'=>array('admin')),
);
?>

<section class="content" >
 <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Parametros  id <?php echo $model->idparametros; ?></h3>
            </div>
            <div class="box-body">

			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					'idparametros',
					'nombre',
					'tipo',
					'codigo',
				),
			)); ?>
       </div>
     </div>
    </div>
   </section>