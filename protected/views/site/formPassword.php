<!DOCTYPE html>
<html class="login_header" >
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/iCheck/square/blue.css">

  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>



<body >
    <?php
    $this->pageTitle=Yii::app()->name . ' - Login';
    $this->breadcrumbs=array(
            'Login',
    );
    ?>

<div class="login-box">
  <div class="login-logo">
      <a href="../../index2.html">	<?php echo CHtml::image(Yii::app()->request->baseUrl.'/img/meew-letra.png',"" ,['class'=>'logo_meew'] ); ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
  <div class="box-header with-border">
			 
			 <h3>Reajustar contraseña</h3>
			 </div>
		<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>false)
	)); ?>
			
		<section class="content" >       
	
			
			<div class="form" >
			   <div class="row" style="padding:15px;">
						<div class="col-md-12">
								
									
											<div class="form-group ">
												<?php echo $form->labelEx($model,'PasswordNew'); ?>
											
												<?php echo $form->passwordField($model,'PasswordNew', array ('class' => 'form-control','placeholder'=>'Digite su nueva contraseña')); ?>
											
												<?php echo $form->error($model,'PasswordNew'); ?>
											</div>
											<div class="form-group ">
												<?php echo $form->labelEx($model,'confirmPassword'); ?>
											
												<?php echo $form->passwordField($model,'confirmPassword', array ('class' => 'form-control','placeholder'=>'Confirme su nueva contraseña')); ?>
											
												<?php echo $form->error($model,'confirmPassword'); ?>
											</div>
								
								<div class="form-group ">
										<?php echo CHtml::submitButton('Guardar', array ('class' => 'btn btn-info pull-right')); ?>
								</div>
			
		</div> 
	  </div>
	</section>    
  <?php $this->endWidget(); ?>
</div><!-- form -->

    <!--div class="social-auth-links text-center">
      <p>- O -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div-->
    <!-- /.social-auth-links -->

    
   
    <!--?php echo CHtml::link('Registrar Usuario',array('site/register')); ?-->
  </div>
  <!-- /.login-box-body -->

<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
?>

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/bootstrap.min.js"></script>


</body>
</html>



