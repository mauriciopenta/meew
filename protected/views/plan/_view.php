<?php
/* @var $this PlanController */
/* @var $data Plan */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_plan')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_plan), array('view', 'id'=>$data->id_plan)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plan_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->plan_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plan_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->plan_codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor_text')); ?>:</b>
	<?php echo CHtml::encode($data->valor_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor')); ?>:</b>
	<?php echo CHtml::encode($data->valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />


</div>