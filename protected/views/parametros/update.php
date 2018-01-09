
<?php
/* @var $this AplicacionController */
/* @var $model Aplicacion */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/style_form.css');



$this->breadcrumbs=array(
	'Parametroses'=>array('index'),
	$model->idparametros=>array('view','id'=>$model->idparametros),
	'Update',
);

$this->menu=array(
	array('label'=>'List Parametros', 'url'=>array('index')),
	array('label'=>'Create Parametros', 'url'=>array('create')),
	array('label'=>'View Parametros', 'url'=>array('view', 'id'=>$model->idparametros)),
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

			<h1>Actualizar Parametro</h1>

			<?php $this->renderPartial('_form', array('model'=>$model)); ?>

	 </div>
	</div>
  </div>
</section>