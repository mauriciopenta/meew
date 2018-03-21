<?php
/* @var $this TerminosController */
/* @var $model Terminos */


?>


<section class="content" >
<div class="row">
    <div class="col-md-12">
	<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Términos Y condiciones</h3>
            </div>
            <div class="box-body">

		         	<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div><!-- form -->
    </div>
</div>
</section>
