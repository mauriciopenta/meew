<!DOCTYPE html>
<html class="scroll_off" >
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
 
</head>



<body class="scroll_off">

    <?php
    $this->pageTitle=Yii::app()->name . ' - Login';
  
    ?>


  <div class="contenedor_header">
  
      <div class="frame_header">
      </div>
   
  </div>
  
  <div class="row" style="height:100%;">
    <div class="col-sm-3 contenedor_izquierda">
        <div class="frame_izquierda">
         
        </div>
    </div>

    
    <div class="col-sm-6 content_center">
             
              <div class="login-box">
         
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
                            
                             <div class="form-group has-feedback">
                                <?php echo CHtml::submitButton('Guardar', array ('class' => 'btn btn-info btn-block')); ?>
                            </div>
                  
                </div> 
                </div>
              </section>    
              <?php $this->endWidget(); ?>
            </div><!-- form -->
  </div>
</div>
    <div class="col-sm-3 contenedor_derecha">
        <div class="frame_derecha">

             <div class="login-logo">
                <a >	<?php echo CHtml::image(Yii::app()->request->baseUrl.'/img/meew.png',"" ,['class'=>'logo_inferior'] ); ?></a>
            </div>

        </div>
    </div>
  </div>
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
