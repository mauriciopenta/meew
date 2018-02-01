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
				'actions'=>array('index','view','home'),
				'users'=>array('@'),
			),
            array('allow', 
            'actions' => array('admin', 'delete','userManager','update','agregar'),
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
        $this->render('userManager',array(
            "modeloUsuario"=>$modeloUsuario,
            "modeloPersona"=>$modeloPersona,
            "personas"=>$personas,
            "dataTipoLogin"=>$dataTipoLogin
        ));
    }

	public function actionHome(){
        $modeloUsuario=new Usuario();
        $modeloPersona=new Persona();
        $personas=$modeloPersona->model()->findAll();
        $dataTipoLogin= TipoLogin::model()->findAll();
        $this->render('home',array(
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

    
	public function actionAgregar(){
		
			$model=new RegisterForm;
			//print_r($_POST);
			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
			{
					print_r( CActiveForm::validate($model));
//                        
				Yii::app()->end();
			}
			
			// collect user input data
			if(isset($_POST['RegisterForm'])){
					$model->attributes=$_POST['RegisterForm'];
					// validate user input and redirect to the previous page if valid
					if($model->validate() && $model->register()){
					  //  Yii::app()->user->returnUrl = array("site/index");                                                          
					   // $this->redirect(Yii::app()->user->returnUrl);
						$messageType = 'success';
						$message = "<div class='alert alert-info alert-dismissable'>Se envío un email, para confirmar tu correo.</div>";
						Yii::app()->user->setFlash($messageType, $message);
		
					}
			}
		
		//	require_once Yii::app()->getBasePath() . '/extensions/payu-php-sdk-4.5.6/lib/PayU.php';
		    $acceso_api=  Api::model()->findByAttributes(array("tipo"=>'payu'));
      		PayU::$language = SupportedLanguages::ES; //Seleccione el idioma.
			PayU::$isTest = true; //Dejarlo True cuando sean pruebas.
			PayU::$apiKey = $acceso_api->key; //Ingrese aquí su propio apiKey.
            PayU::$apiLogin = $acceso_api->login; //Ingrese aquí su propio apiLogin.
            PayU::$merchantId = $acceso_api->id_prod; //Ingrese aquí su Id de Comercio.
			LoggerUtil.setLogLevel(Level.ALL); //Incluirlo únicamente si desea ver toda la traza del log; si solo se desea ver la respuesta, se puede eliminar.

				// URL de Pagos
			Environment::setPaymentsCustomUrl("https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi");
				// URL de Consultas
			Environment::setReportsCustomUrl("https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi");
				// URL de Suscripciones para Pagos Recurrentes
			Environment::setSubscriptionsCustomUrl("https://sandbox.api.payulatam.com/payments-api/rest/v4.3/");

		

			// display the login form
//                Yii::app()->user->setFlash('success', "Data1 saved!");
			$this->render('agregar',array("model"=>$model));
	  
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
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Usuario;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Usuario']))
		{
			$model->attributes=$_POST['Usuario'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_usuario));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Usuario']))
		{
			$model->attributes=$_POST['Usuario'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_usuario));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Usuario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Usuario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuario']))
			$model->attributes=$_GET['Usuario'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Usuario the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Usuario::model()->findByPk($id);
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