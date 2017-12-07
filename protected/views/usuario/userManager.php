<?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/datatables/dataTables.bootstrap.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/datatables/jquery.dataTables.min.js",CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/plugins/datatables/dataTables.bootstrap.min.js",CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/Usuario/Usuario.js",CClientScript::POS_END);
?>
    <?php
/* @var $this UsuarioController */

$this->breadcrumbs=array(
	'Usuario'=>array('/usuario'),
	'UserManager',
);
?>


<section class="content" id="divUsuario">
    <div class="row">
        <!-- left column -->
        
        
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Clientes registrados</h3>
                </div>
                <div class="box-body">
                    <table id="dataTableUsuarios" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No. Documento</th>
                                <th>Persona Nombres</th>
                                <th>Persona Apellidos</th>
                                <th>Persona correo</th>
                                <th>Estado usuario</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!empty($personas)){
                                    foreach($personas as $persona):
                                        if($persona["id_persona"]!=Yii::app()->user->getId()):
                                            $usuario=  Usuario::model()->findByAttributes(array("id_persona"=>$persona["id_persona"]));
                                            if($usuario->usuario_activo==1){
                                                $estado=2;
                                                $estadoCode="Deshabilitar";
                                                $estadoActual="Habilitado";
                                            }
                                            else{
                                                $estado=1;
                                                $estadoCode="Habilitar";
                                                $estadoActual="Inhabilitado";
                                            }
                                        
                                        ?>
                                        
                                            <tr>
                                                <td><?php if(!empty($persona["persona_doc"])){echo $persona["persona_doc"];}else{echo "NULL";} ?></td>
                                                <td><?php echo $persona["persona_nombre"];?></td>
                                                <td><?php echo $persona["persona_apellidos"];?></td>
                                                <td><?php echo $persona["persona_correo"]?></td>
                                                <td><?php echo $estadoActual?></td>
                                                <td><a href='javascript:Usuario.cambiaEstadoLogin("<?php echo $estado?>","<?php echo $persona["id_persona"]?>");'><?php echo $estadoCode;?></a></td>
                                            </tr>
                                        
                                    <?php  endif;endforeach;
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No. Documento</th>
                                <th>Persona Nombres</th>
                                <th>Persona Apellidos</th>
                                <th>Persona correo</th>
                                <th>Estado usuario</th>
                                <th>Acción</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
