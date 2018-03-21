<?php
/* @var $this TerminosController */
/* @var $data Terminos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idterminos')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idterminos), array('view', 'id'=>$data->idterminos)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('terminos')); ?>:</b>
	<?php echo CHtml::encode($data->terminos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_aplicacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_aplicacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />


</div>