<?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/datatables/dataTables.bootstrap.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/datatables/jquery.dataTables.min.js",CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/datatables/dataTables.bootstrap.min.js",CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/Usuario/Usuario.js",CClientScript::POS_END);
    


?>

<section class="content" id="divUsuario">
 
                    <table id="dataTableUsuarios" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Persona Nombres</th>
                                <th>Persona correo</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!empty($personas)){
                                    foreach($personas as $persona):
                                        if($persona["id_persona"]!=Yii::app()->user->getId()):
                                            $usuario=  Usuario::model()->findByAttributes(array("id_persona"=>$persona["id_persona"]));
                                        ?>
                                            <tr>
                                                <td><?php echo $usuario["usuario"]?></td>
                                                <td><?php echo $persona["persona_nombre"];?></td>
                                                <td><?php echo $persona["persona_correo"]?></td>
                                               
                                            </tr>
                                    <?php  endif;endforeach;
                                }
                            ?>
                        </tbody>
                       
                    </table>

              
      
</section>
