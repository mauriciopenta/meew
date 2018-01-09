<?php
/* @var $this ModuloAppController */
/* @var $data ModuloApp */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_modulo_app')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_modulo_app), array('view', 'id'=>$data->id_modulo_app)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_modulo')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_modulo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('texto_html')); ?>:</b>
	<?php echo CHtml::encode($data->texto_html); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_modulo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_modulo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aplicacion_idaplicacion')); ?>:</b>
	<?php echo CHtml::encode($data->aplicacion_idaplicacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aplicacion_usuario_id_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->aplicacion_usuario_id_usuario); ?>
	<br />


</div>