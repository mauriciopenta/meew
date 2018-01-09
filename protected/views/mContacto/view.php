<?php
/* @var $this MContactoController */
/* @var $model MContacto */
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/style_form.css');

$this->breadcrumbs=array(
	'Mcontactos'=>array('index'),
	$model->id_mcontacto,
);

$this->menu=array(
/*	array('label'=>'List MContacto', 'url'=>array('index')),
	array('label'=>'Create MContacto', 'url'=>array('create')),
	array('label'=>'Update MContacto', 'url'=>array('update', 'id'=>$model->id_mcontacto)),
	array('label'=>'Delete MContacto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_mcontacto),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MContacto', 'url'=>array('admin')),*/
);
?>
<section class="content" >
 <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Mensaje  #<?php echo $model->id_mcontacto; ?></h3>
            </div>
            <div class="box-body">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_mcontacto',
		'mcontacto_mensaje',
		'asunto',
		'aplicacion_idaplicacion',
		'aplicacion_usuario_id_usuario',
		'fecha',
		'respuesta',
	),
)); ?>
</div>
     </div>
    </div>
   </section>