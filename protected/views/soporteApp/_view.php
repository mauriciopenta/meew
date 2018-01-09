<?php
/* @var $this SoporteAppController */
/* @var $data SoporteApp */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idsoporte_app')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idsoporte_app), array('view', 'id'=>$data->idsoporte_app)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mensaje')); ?>:</b>
	<?php echo CHtml::encode($data->mensaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('respuesta')); ?>:</b>
	<?php echo CHtml::encode($data->respuesta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_modificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tema')); ?>:</b>
	<?php echo CHtml::encode($data->id_tema); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_aplicacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_aplicacion); ?>
	<br />


</div>