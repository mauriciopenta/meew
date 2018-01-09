
<?php
/* @var $this AplicacionController */
/* @var $model Aplicacion */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/style_form.css');

?>





<section class="content" id="divUsuario">
<div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <div class="box-body">

				<div class="view">

					<b><?php echo CHtml::encode($data->getAttributeLabel('idparametros')); ?>:</b>
					<?php echo CHtml::link(CHtml::encode($data->idparametros), array('view', 'id'=>$data->idparametros)); ?>
					<br />

					<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
					<?php echo CHtml::encode($data->nombre); ?>
					<br />

					<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
					<?php echo CHtml::encode($data->tipo); ?>
					<br />

					<b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?>:</b>
					<?php echo CHtml::encode($data->codigo); ?>
					<br />


				</div>
