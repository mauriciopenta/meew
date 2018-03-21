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
                  <br><p>Usuarios</p><br><br>
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
                <br><p>Planes</p><br><br>
            </div>
            <div class="icon">
                <i class="ion ion-cube"></i>
            </div>
             <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/plan/admin" class="small-box-footer"> Gestionar Planes <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
           <div class="small-box bg-green">
              <div class="inner">
                <br><p>Configuración</p><br><br>
              </div>
              <div class="icon">
                <i class="fa fa-adjust"></i>
              </div>
              <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/parametros/admin" class="small-box-footer">Gestionar Parámetros <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple-active">
              <div class="inner">
                <h4><?php echo $estadistica['aplicaciones'];?></h4>
                <p class="box_home_text">Aplicaciones <br>Registradas</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-apps"></i>
              </div>
              <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/aplicacion/aplicaciones" class="small-box-footer"> Aplicaciones  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>



        <?php  foreach($estadistica['plantillas'] as $plantilla): ?>
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-purple-active">
              <div class="inner">
                <h4><?php echo $plantilla['num'];?></h4>
                <p class="box_home_text"><?php echo $plantilla['nombre']==NULL ? 0: $plantilla['nombre'] ;?></p>
              </div>
              <div class="icon">
                <i class="ion ion-android-apps"></i>
              </div>
              <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/aplicacion/aplicaciones" class="small-box-footer"> Aplicaciones  <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php  endforeach; ?>




        <?php  foreach($estadistica['planes'] as $plan ): ?>



        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue-active">

              <div class="inner">
                <h4><?php echo $plan['num'];?></h4>

                <p class="box_home_text">Usuario <?php echo $plan['nombre'];?></p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
              <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/usuario/userManager" class="small-box-footer"> Usuarios  <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

        <?php  endforeach; ?>
    </div>
   
    


  </div>
  <?php elseif(Yii::app()->user->getState('nombreRole')=="CLIENTE"):?>
     
   

  <div class="row">


        <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-purple-active">
                    <div class="inner">
                      <h4><?php echo $estadistica['usuarios']==NULL ? 0: $estadistica['usuarios']; ?></h4>
                       <p class="box_home_text">Usuarios Registrados</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person"></i>
                    </div>
                    <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/usuario/usuarios" class="small-box-footer"> Ir  <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
        </div>


        <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-blue">
                    <div class="inner">

                    <h4><?php echo $estadistica['usuarios_hombres']==NULL ? 0: $estadistica['usuarios_hombres']; ?></h4>
                    
                      <p class="box_home_text">Usuarios Hombres</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-man"></i>
                    </div>
                    <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/usuario/usuarios?genero=2" class="small-box-footer"> Ir  <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
        </div>



        <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua-active">
                    <div class="inner">
                      <h4><?php echo $estadistica['usuarios_mujeres']==NULL ? 0: $estadistica['usuarios_mujeres']; ?></h4>
                      <p class="box_home_text">Usuarios Mujeres</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-woman"></i>
                    </div>
                    <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/usuario/usuarios?genero=1" class="small-box-footer"> Ir  <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
        </div>

        <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-red-active">
                    <div class="inner">
                       <h4><?php echo $estadistica['usuarios_otro']==NULL ? 0: $estadistica['usuarios_otro']; ?></h4>
                      <p class="box_home_text">Usuarios Otro Genero</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person"></i>
                    </div>
                    <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/usuario/usuarios?genero=3" class="small-box-footer"> Ir  <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
        </div>

        <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-red-active">
                    <div class="inner">
                      <h4><?php echo $estadistica['usuarios_1824']==NULL ? 0: $estadistica['usuarios_1824']; ?></h4>
                      <p class="box_home_text">Usuarios entre 18-24 años</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person"></i>
                    </div>
                    <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/usuario/usuarios?edad=" class="small-box-footer"> Ir  <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
        </div>

   


        <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green-active">
                    <div class="inner">
                       <h4><?php echo $estadistica['usuarios_2534']==NULL ? 0: $estadistica['usuarios_2534']; ?></h4>
                      <p class="box_home_text">Usuarios entre 25-35 años</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person"></i>
                    </div>
                    <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/usuario/usuarios?edad=2" class="small-box-footer"> Ir  <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
        </div>

        <div class="col-lg-3 col-xs-6">
        <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                 <h4><?php echo $estadistica['usuarios_3544']==NULL ? 0: $estadistica['usuarios_3544']; ?></h4>
                     
                <p class="box_home_text">Usuarios entre 35-44 años</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/usuario/usuarios?edad=3" class="small-box-footer"> Ir  <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
        <!-- small box -->
            <div class="small-box bg-orange-active">
              <div class="inner">
                 <h4><?php echo $estadistica['usuarios_4554']==NULL ? 0: $estadistica['usuarios_4554']; ?></h4>
                
                
                <p class="box_home_text">Usuarios entre 45-54 años</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/usuario/usuarios?edad=4" class="small-box-footer"> Ir  <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

    
        <div class="col-lg-3 col-xs-6">
        <!-- small box -->
            <div class="small-box bg-orange">
              <div class="inner">
              <h4><?php echo $estadistica['usuarios_mas']==NULL ? 0: $estadistica['usuarios_mas']; ?></h4>
                
                <p class="box_home_text">Usuarios de más de 55 años</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/usuario/usuarios?edad=5" class="small-box-footer"> Ir  <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
        <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">
              <h4><?php echo $estadistica['notificaciones']==NULL ? 0: $estadistica['notificaciones']; ?></h4>
                <p class="box_home_text">Mensajes Push Enviados</p>
              </div>
              <div class="icon">
                <i class="ion ion-email"></i>
              </div>
              <a href="<?php echo Yii::app()->request->baseUrl?>/index.php//pushNotificaciones/admin" class="small-box-footer"> Ir  <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>


    

    <?php endif;?> 

</div>
</div>
</div>
</section>