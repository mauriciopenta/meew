<?php

class UsuarioController extends Controller{
      /**
    * Acción que se ejecuta en segunda instancia para verificar si el usuario tiene sesión activa.
    * En caso contrario no podrá acceder a los módulos del aplicativo y generará error de acceso.
    */
    public function filterEnforcelogin($filterChain){
        if(Yii::app()->user->isGuest){
            if(isset($_POST) && !empty($_POST)){
                $response["status"]="nosession";
                echo CJSON::encode($response);
                exit();
            }
            else{
                Yii::app()->user->returnUrl = array("site/login");                                                          
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        $filterChain->run();
    }
    /**
     * @return array action filters
     */
    public function filters(){
        return array(
                'enforcelogin',                      
        );
    }
    public function actionUserManager(){
        $modeloUsuario=new Usuario();
        $modeloPersona=new Persona();
        $personas=$modeloPersona->model()->findAll();
        $dataTipoLogin= TipoLogin::model()->findAll();
        $this->render('userManager',array(
            "modeloUsuario"=>$modeloUsuario,
            "modeloPersona"=>$modeloPersona,
            "personas"=>$personas,
            "dataTipoLogin"=>$dataTipoLogin
        ));
    }
    public function actionCambiaEstado(){
        $estado=Yii::app()->request->getPost("estado");
        $idpersona=Yii::app()->request->getPost("idpersona");
        $usuario=  Usuario::model()->findByAttributes(array("id_persona"=>$idpersona));
        $idUsuario=$usuario->id_usuario;
        if($usuario->updateByPk($idUsuario,array('usuario_activo'=>$estado))){
            $response["status"]="exito";
            $response["msg"]="Se ha cambiado el estado de usuario";
        }
        else{
            $response["status"]="noexito";
            $response["msg"]="Sin cambios";
        }
        echo CJSON::encode($response);
    }
    
    public function actionConsultaPersona(){
        $conn= Yii::app()->db;
        $slq="select a.*,b.usuario_activo from persona as a left join usuario as b on b.id_persona=a.id_persona where b.id_persona<>:idpersona";
        $query=$conn->createCommand($slq);
        $idSelfUsuario=Yii::app()->user->getId();
        $query->bindParam(":idpersona",$idSelfUsuario );
        $read=$query->query();
        $res=$read->readAll();
        echo CJSON::encode($res); 

        
    }
    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
            // return the filter configuration for this controller, e.g.:
            return array(
                    'inlineFilterName',
                    array(
                            'class'=>'path.to.FilterClass',
                            'propertyName'=>'propertyValue',
                    ),
            );
    }

    public function actions()
    {
            // return external action classes, e.g.:
            return array(
                    'action1'=>'path.to.ActionClass',
                    'action2'=>array(
                            'class'=>'path.to.AnotherActionClass',
                            'propertyName'=>'propertyValue',
                    ),
            );
    }
    */
}