<?php 

?>


<section class="content" >
<div class="row" >
      <div class="col-md-12">

<?php if(Yii::app()->user->getState('nombreRole')=="ADMINISTRADOR"):?>
<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">

  <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>44</h3>

          <p>Usuarios</p>
        </div>
        <div class="icon">
        <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/usuario/userManager" > <i class="ion ion-person-add"></i></a>
         
        </div>
        <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/usuario/userManager" class="small-box-footer">Gestionar usuarios <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>



    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>----</h3>

          <p>Planes</p>
        </div>
        <div class="icon">
          <i class="ion ion-cube"></i>
        </div>
        <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/plan/admin" class="small-box-footer"> Gestionar Planes<i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><sup style="font-size: 20px">---</sup></h3>

          <p>Configuración</p>
        </div>
        <div class="icon">
          <i class="fa fa-adjust"></i>
        </div>
        <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/parametros/admin" class="small-box-footer">Gestionar Parámetros <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    </div>
    <!-- ./col -->
    <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-purple-active"><i class="ion ion-android-apps"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Aplicaciones <br>Registradas</span>
          <span class="info-box-number">90<small>%</small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-purple"><i class="ion ion-android-apps"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Aplicaciones <br>plantilla formal</span>
          <span class="info-box-number">41,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- ./col -->

    <!-- /.col -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-purple-active"><i class="ion ion-android-apps"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Aplicaciones <br>plantilla slider</span>
          <span class="info-box-number">41,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- ./col -->
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-blue-active"><i class="ion ion-person-stalker"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Usuarios <br>Pioneros</span>
          <span class="info-box-number">41,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- ./col -->
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow-active"><i class="ion ion-person-stalker"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Usuarios Estrategas <br>push 10</span>
          <span class="info-box-number">41,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- ./col -->
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-orange"><i class="ion ion-person-stalker"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Usuarios Estrategas <br>push 20</span>
          <span class="info-box-number">41,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- ./col -->
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-orange-active"><i class="ion ion-person-stalker"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Usuarios Estrategas <br>push 30</span>
          <span class="info-box-number">41,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- ./col -->
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green-active"><i class="ion ion-person-stalker"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Usuarios Estratega <br>Comercial</span>
          <span class="info-box-number">41,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- ./col -->
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="ion ion-person-stalker"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Usuarios Expert@ <br> Mark 100</span>
          <span class="info-box-number">41,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- ./col -->
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="ion ion-person-stalker"></i></span>

        <div class="info-box-content">
        <span class="info-box-text">Usuarios Expert@ <br> Mark 200</span>
          <span class="info-box-number">41,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- ./col -->
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red-active"><i class="ion ion-person-stalker"></i></span>

        <div class="info-box-content">
        <span class="info-box-text">Usuarios Expert@ <br> Mark 300</span>
          <span class="info-box-number">41,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- ./col -->


  </div>
  <?php elseif(Yii::app()->user->getState('nombreRole')=="CLIENTE"):?>
     
   

  <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-blue-active"><i class="ion ion-person"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Usuarios Registrados</span>
            <span class="info-box-number">90<small>%</small></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-blue"><i class="ion ion-person"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Usuarios Hombres</span>
            <span class="info-box-number">41,410</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

           <!-- /.col -->
           <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua-active"><i class="ion ion-person"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Usuarios Mujeres</span>
            <span class="info-box-number">41,410</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="ion ion-person"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Usuarios Hombres</span>
            <span class="info-box-number">41,410</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->


      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red-active"><i class="ion ion-person"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Usuarios Otro Genero</span>
            <span class="info-box-number">41,410</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="ion ion-person"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Usuarios entre 18-24 años</span>
            <span class="info-box-number">41,410</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

        <!-- /.col -->

            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green-active"><i class="ion ion-person"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Usuarios entre 25-35 años</span>
            <span class="info-box-number">41,410</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->


  <!-- /.col -->

            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="ion ion-person"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Usuarios entre 35-44 años</span>
            <span class="info-box-number">41,410</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
       <!-- /.col -->

            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-orange-active"><i class="ion ion-person"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Usuarios entre 45-54 años</span>
            <span class="info-box-number">41,410</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->


  <!-- /.col -->

            <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-orange"><i class="ion ion-person"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Usuarios de más de 55 años</span>
            <span class="info-box-number">41,410</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

  <!-- /.col -->

            <!-- /.col -->
       <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-purple"><i class="ion ion-person"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Mensajes Push Enviados</span>
            <span class="info-box-number">41,410</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

    </div>
    <!-- /.row -->

    <?php endif;?> 

</div>
</div>
</div>
</section>