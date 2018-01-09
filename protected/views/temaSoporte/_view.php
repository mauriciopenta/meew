<?php
/* @var $this TemaSoporteController */
/* @var $data TemaSoporte */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idtema_soporte')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idtema_soporte), array('view', 'id'=>$data->idtema_soporte)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulo')); ?>:</b>
	<?php echo CHtml::encode($data->titulo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_aplicacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_aplicacion); ?>
	<br />


</div>