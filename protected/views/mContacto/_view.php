<?php
/* @var $this MContactoController */
/* @var $data MContacto */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_mcontacto')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_mcontacto), array('view', 'id'=>$data->id_mcontacto)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mcontacto_mensaje')); ?>:</b>
	<?php echo CHtml::encode($data->mcontacto_mensaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('asunto')); ?>:</b>
	<?php echo CHtml::encode($data->asunto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aplicacion_idaplicacion')); ?>:</b>
	<?php echo CHtml::encode($data->aplicacion_idaplicacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aplicacion_usuario_id_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->aplicacion_usuario_id_usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('respuesta')); ?>:</b>
	<?php echo CHtml::encode($data->respuesta); ?>
	<br />


</div>