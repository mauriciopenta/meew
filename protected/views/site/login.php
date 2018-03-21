<!DOCTYPE html>
<html class="scroll_off" >
<head>
  <meta charset="utf-8">
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



<body class="scroll_off">

    <?php
    $this->pageTitle=Yii::app()->name . ' - Login';
    $this->breadcrumbs=array(
            'Login',
    );
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
           
          <div class="login-box" >

            <!-- /.login-logo -->
            <div class="login-box-body" >
              <p class="login-box-msg">Iniciar sesión</p>
              <?php $form=$this->beginWidget('CActiveForm', array(
                      'id'=>'login-form',
                      'enableClientValidation'=>true,
                      'enableAjaxValidation'=>true,
                      'clientOptions'=>array(
                              'validateOnSubmit'=>true,
                      ),
              )); ?>
            
              <div class="form-group has-feedback">
                  <?php echo $form->labelEx($model,'Usuario'); ?>
                  <?php echo $form->textField($model,'username', array ('class' => 'form-control','placeholder'=>'Digite nombre de usuario')); ?>
                  <?php echo $form->error($model,'username'); ?>
              </div>

              <div class="form-group has-feedback">
                  <?php echo $form->labelEx($model,'Contraseña'); ?>
                  <?php echo $form->passwordField($model,'password', array ('class' => 'form-control','placeholder'=>'Digite la contraseña')); ?>
                  <?php echo $form->error($model,'password'); ?>
              </div>
                <div class="row">
                  <div class="col-xs-8">
                    <div class="form-group">
                        
                    </div>

                    <div class="form-group has-feedback">
                      
                          <div>
                          
                            <?php echo $form->checkBox($model,'rememberMe', array('style' => 'float:left;')); ?>
                            <?php echo $form->label($model,'rememberMe', array('style' => 'float:left;')); ?>
                        
                          </div>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-xs-4">   
                    <br>
                    <?php echo CHtml::submitButton('Login', array ('class' => 'btn btn-info btn-block')); ?>
                  </div>
                  
                  <!-- /.col -->
                </div>    

                <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/site/recover" style="color:#1c6a8a;">Olvido su contraseña?</a><br>
            
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
