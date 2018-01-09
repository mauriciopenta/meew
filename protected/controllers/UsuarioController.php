<?php




class UsuarioController extends Controller{
      /**
    * Acción que se ejecuta en segunda instancia para verificar si el usuario tiene sesión activa.
    * En caso contrario no podrá acceder a los módulos del aplicativo y generará error de acceso.
    */

    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to access 'index' and 'view' actions.
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
            array('allow', 
            'actions' => array('admin', 'delete'),
            'users' => array('admin')
            ),
            


			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}



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

    public function actionSort()
    {

       
        if (isset($_POST['items']) && is_array($_POST['items'])) {

            var_dump($_POST);die;
            $i = 0;
            foreach ($_POST['items'] as $item) {
               // $project = Project::model()->findByPk($item);
               // $project->sortOrder = $i;
               // $project->save();
               
               $i++;
            }
        }
    }

    

      public function loadModel($id)
      {
          $model=MViral::model()->findByPk($id);
          if($model===null)
              throw new CHttpException(404,'The requested page does not exist.');
          return $model;
      }

      public function actionParametrosConfig()
      {
          $model=new Parametros;
      
          // uncomment the following code to enable ajax-based validation
          /*
          if(isset($_POST['ajax']) && $_POST['ajax']==='parametros-parametrosConfig-form')
          {
              echo CActiveForm::validate($model);
              Yii::app()->end();
          }
          */
      
          if(isset($_POST['Parametros']))
          {
              $model->attributes=$_POST['Parametros'];
              if($model->validate())
              {
                  // form inputs are valid, do something here
                  return;
              }
          }
          $this->render('parametrosConfig',array('model'=>$model));
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
 
	public function actionView($id)
	{

        $this->render('view',array(
			'model'=>$this->loadModelModulo($id),
        ));
        


    }


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ModuloApp the loaded model
	 * @throws CHttpException
	 */
	public function loadModelModulo($id)
	{
		$model=ModuloApp::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ModuloApp $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='modulo-app-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}



}