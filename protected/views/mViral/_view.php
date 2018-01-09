<?php
/* @var $this MViralController */
/* @var $data MViral */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_mviral')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_mviral), array('view', 'id'=>$data->id_mviral)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mviral_url_fb')); ?>:</b>
	<?php echo CHtml::encode($data->mviral_url_fb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mviral_url_tw')); ?>:</b>
	<?php echo CHtml::encode($data->mviral_url_tw); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mviral_url_inst')); ?>:</b>
	<?php echo CHtml::encode($data->mviral_url_inst); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aplicacion_idaplicacion')); ?>:</b>
	<?php echo CHtml::encode($data->aplicacion_idaplicacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aplicacion_usuario_id_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->aplicacion_usuario_id_usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo_contacto')); ?>:</b>
	<?php echo CHtml::encode($data->correo_contacto); ?>
	<br />


</div>