<?php
/* @var $this PlanController */
/* @var $model Plan */

$this->breadcrumbs=array(
	'Plans'=>array('index'),
	$model->id_plan,
);

?>

<section class="content" >
 <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> Plan <?php echo $model->plan_nombre; ?></h3>
            </div>
            <div class="box-body">

			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
							
				'attributes'=>array(
					'plan_nombre',
					'valor_text',
					'valor',
					'descripcion',
				    'mensajes_push'
				),
			)); ?>
      </div>
     </div>
    </div>
   </section>