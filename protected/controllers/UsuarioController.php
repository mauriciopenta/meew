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
               // Yii::app()->user->returnUrl = array("site/login");                                                          
                //$this->redirect(Yii::app()->user->returnUrl);
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
        $this->render('plantillaManager',array(
            "modeloUsuario"=>$modeloUsuario,
            "modeloPersona"=>$modeloPersona,
            "personas"=>$personas,
            "dataTipoLogin"=>$dataTipoLogin
        ));
    }



   

	public function actionAplicacionConfig()
	{
		
	
		// uncomment the following code to enable ajax-based validation
       
            $model=new AplicacionForm;
            if(isset($_POST['ajax']) && $_POST['ajax']==='aplicacionConfig-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            if(isset($_POST['AplicacionForm'])){
                $model->attributes=$_POST['AplicacionForm'];
                // var_dump(json_encode($model ));die;
                if($model->validate() && $model->guardar() )
                {
                    Yii::app()->user->returnUrl = array("/usuario/aplicacionConfig");                                                          
                    $this->redirect(Yii::app()->user->returnUrl);  
                }
            }


      
            $aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
            if(is_object($aplicacionFromDb) && isset($aplicacionFromDb->nombre)){
               
              // var_dump($aplicacionFromDb->login_activo );die;
               
                $model->aplicacion_existe=true;
                $model->idaplicacion= $aplicacionFromDb->idaplicacion;
                $model->nombre= $aplicacionFromDb->nombre;
                $model->color= $aplicacionFromDb->color;
                $model->url_fondo= $aplicacionFromDb->url_fondo;
                $model->imageFile= $aplicacionFromDb->url_fondo;
                $model->login_activo= $aplicacionFromDb->login_activo;
                $model->login_facebook= $aplicacionFromDb->login_facebook;
                $model->facebook= $aplicacionFromDb->facebook;
                $model->twitter= $aplicacionFromDb->twitter;
                $model->instagram= $aplicacionFromDb->instagram;
                
                $model->estado_app= $aplicacionFromDb->estado_app;
                $model->usuario_id_usuario= $aplicacionFromDb->usuario_id_usuario;
                $model->id_plantilla= $aplicacionFromDb->id_plantilla;
                $model->campos_existe=true;
                $model->nombre_activo= $aplicacionFromDb->nombre_activo;
                $model->apellido_activo= $aplicacionFromDb->apellido_activo;
                $model->nombre_usuario_activo= $aplicacionFromDb->nombre_usuario_activo;
                $model->politicas_privacidad_activo= $aplicacionFromDb->politicas_privacidad_activo;
                $model->celular_activo= $aplicacionFromDb->celular_activo;

                


            }
        
           
        


            $this->render('aplicacionConfig',array('model'=>$model));
      
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