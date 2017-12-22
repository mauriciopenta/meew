<!DOCTYPE html>
<html>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
    <?php
    $this->pageTitle=Yii::app()->name . ' - Login';
    $this->breadcrumbs=array(
            'Login',
    );
?>
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html">Meew</a>
  </div>
  <!-- /.login-logo -->
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Registro de usuario</p>
   
        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'register-form',
                'enableClientValidation'=>true,
                'enableAjaxValidation'=>true,
                'clientOptions'=>array(
                        'validateOnSubmit'=>false)
              )); ?>
      
        <div class="form-group has-feedback">
            <?php echo $form->labelEx($model,'usuario'); ?>
            <?php echo $form->textField($model,'username', array ('class' => 'form-control','placeholder'=>'Digite el nombre de usuario')); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>
        <div class="form-group has-feedback">
            <?php echo $form->labelEx($model,'contraseña'); ?>
            <?php echo $form->passwordField($model,'password', array ('class' => 'form-control','placeholder'=>'Digite su contraseña')); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>
        <div class="form-group has-feedback">
            <?php echo $form->labelEx($model,'Confime contraseña'); ?>
            <?php echo $form->passwordField($model,'confirmPassword', array ('class' => 'form-control','placeholder'=>'Confirme su contraseña')); ?>
            <?php echo $form->error($model,'confirmPassword'); ?>
        </div>

        <div class="form-group has-feedback">
            <?php echo $form->labelEx($model,'nombres'); ?>
            <?php echo $form->textField($model,'nombres', array ('class' => 'form-control','placeholder'=>'nombres')); ?>
            <?php echo $form->error($model,'nombres'); ?>
        </div> 
        <div class="form-group has-feedback">
            <?php echo $form->labelEx($model,'apellidos'); ?>
            <?php echo $form->textField($model,'apellidos', array ('class' => 'form-control','placeholder'=>'Apellidos')); ?>
            <?php echo $form->error($model,'apellidos'); ?>
        </div> 
        <div class="form-group has-feedback">
            <?php echo $form->labelEx($model,'email'); ?>
            <?php echo $form->textField($model,'email', array ('class' => 'form-control','placeholder'=>'Correo')); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>  

        <div class="form-group has-feedback">
            <?php echo $form->labelEx($model,'tipo_documento'); ?><br>
            <?php 
            $type_list=CHtml::listData(TipoDoc::model()->findAll(),'id_doc','doc_nombre');
            echo $form->dropDownList($model,'tipo_documento', $type_list, array('class' => 'form-control','empty'=>'Seleccione') ) ?>
            <?php echo $form->error($model,'tipo_documento'); ?>
        </div> 
        <div class="form-group has-feedback">
            <?php echo $form->labelEx($model,'documento'); ?>
            <?php echo $form->textField($model,'documento', array ('class' => 'form-control','placeholder'=>'Número de documento')); ?>
            <?php echo $form->error($model,'documento'); ?>
        </div> 
          <div class="row">
            <!-- /.col -->
            <div class="col-xs-4">
              <?php echo CHtml::submitButton('Register', array ('class' => 'btn btn-primary btn-block btn-flat')); ?>
            </div>
          
          <!-- /.col -->
        </div>    
  <?php $this->endWidget(); ?>
</div><!-- form -->
</div>
  <!-- /.login-box-body -->

<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
?>

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>

