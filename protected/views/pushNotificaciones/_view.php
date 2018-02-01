<?php
/* @var $this PushNotificacionesController */
/* @var $data PushNotificaciones */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idpush_notificaciones')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idpush_notificaciones), array('view', 'id'=>$data->idpush_notificaciones)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulo')); ?>:</b>
	<?php echo CHtml::encode($data->titulo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cuerpo')); ?>:</b>
	<?php echo CHtml::encode($data->cuerpo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('genero')); ?>:</b>
	<?php echo CHtml::encode($data->genero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('edad')); ?>:</b>
	<?php echo CHtml::encode($data->edad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_aplicacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_aplicacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_modulo')); ?>:</b>
	<?php echo CHtml::encode($data->id_modulo); ?>
	<br />


</div>