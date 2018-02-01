<?php
/* @var $this PersonaController */
/* @var $data Persona */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_persona')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_persona), array('view', 'id'=>$data->id_persona)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_doc')); ?>:</b>
	<?php echo CHtml::encode($data->id_doc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('persona_doc')); ?>:</b>
	<?php echo CHtml::encode($data->persona_doc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('persona_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->persona_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('persona_apellidos')); ?>:</b>
	<?php echo CHtml::encode($data->persona_apellidos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('persona_correo')); ?>:</b>
	<?php echo CHtml::encode($data->persona_correo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_genero')); ?>:</b>
	<?php echo CHtml::encode($data->id_genero); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_rango_edad')); ?>:</b>
	<?php echo CHtml::encode($data->id_rango_edad); ?>
	<br />

	*/ ?>

</div>