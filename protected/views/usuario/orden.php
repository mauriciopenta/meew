<section class="content" >
           
                    <div class="box-header">
                    <h3 class="box-title">Ordenar módulos</h3>
                    </div>
                     
                    <div class="box-body">
                    <div class="row">
                    <label style="margin-left:15px;">Mueva los módulos con el mouse a la posición que deseé</label><br>
                   
                    <div class="col-md-12" style="text-align:center;">
                            <div class=" with-border">
                                <h5 class="box-title"> MENÚ PRINCIPAL</h5>
                            </div>
                            <?php echo " <div  class='row' style='text-align:center; width: 350px; margin:0 auto; background: ".$model['color']."'>"; ?>
                           
                            <ul id="sortable" >
                                    <?php 
                                        $sql = "select orden, icon,id_modulo_app ,nombre_modulo from modulo_app  where tipo_menu=2  AND aplicacion_usuario_id_usuario=".Yii::app()->user->getState('id_usuario')." order by  orden asc";
                                        $consulta = Yii::app()->db->createCommand($sql)->queryAll();
                                            foreach($consulta as $modulo):
                                                echo "<li class='ui-state-default' style='color:".$model['color_icon']. "!important;  ' id='".$modulo['id_modulo_app']."'> <i class='f7-icons size-40'>".$modulo['icon']."</i><br><span class='icon_name'>".$modulo['nombre_modulo']."</span>"."</li>"; 
                                            endforeach;?>
                                </ul>
                            </div>
                            </div>
                            </div>     
                            <div class="row">
                             <div class="col-md-12" style="text-align:center;" >
                            <div class=" with-border">
                                    <h5 class="box-title">MENÚ TABS</h5>
                            </div>
                            <?php echo " <div  class='row' style='text-align:center; width: 350px; margin:0 auto; background: ".$model['color']."'>"; ?>
                             
                            <ul id="sortable2" >
                                    <?php 
                                        $sql2 = "select orden, icon ,id_modulo_app ,nombre_modulo from modulo_app  where tipo_menu=1  AND aplicacion_usuario_id_usuario=".Yii::app()->user->getState('id_usuario')." order by  orden asc";
                                        $consulta2 = Yii::app()->db->createCommand($sql2)->queryAll();
                                            foreach($consulta2 as $modulo2):
                                                echo "<li class='ui-state-default' style='color:".$model['color_icon']. "!important;' id='".$modulo2['id_modulo_app']."'><i  class='f7-icons size-40'>".$modulo2['icon']."</i><br><span class='icon_name'>".$modulo2['nombre_modulo']."</span>"."</li>"; 
                                            endforeach;?>
                                </ul>
                            </div>
                    </div>
                    </div>
                    <br>
                    <div class="form-group has-feedback	" >
                        <a href="<?php echo Yii::app()->request->baseUrl?>/index.php/usuario/aplicacionConfig#ordenModulo">
                          <?php echo CHtml::submitButton('Guardar', array ('id'=>'save-reorder','class' => 'btn btn-info pull-right')); ?>
                       </a>
			
                   
                    </div>
                </div>		
</section>