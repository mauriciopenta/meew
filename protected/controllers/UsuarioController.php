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
			array('allow', // allow authenticated users to access all actions
				'users'=>array('*'),
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
    public function actionSave()
    {
        if(isset($_POST['data']))
        {
           $data=json_decode($_POST['data']);
        
            foreach ($data as $item) {
                $modulo = ModuloApp::model()->findByPk($item->id);
                $modulo->orden = $item->orden;
                $modulo->save();
            }

        }
    }
	public function actionAplicacionConfig()
	{
            $model=new AplicacionForm;
            $modelViral=new MViral;
            $moduloApp= new ModuloApp;
            if(isset($_POST['ajax']) && $_POST['ajax']==='aplicacionConfig-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            else if(isset($_POST['ajax']) && $_POST['ajax']==='modulo-app-form')
            {
                echo CActiveForm::validate($moduloApp);
                Yii::app()->end();
            } 


            if(isset($_POST['AplicacionForm'])){
                $model->attributes=$_POST['AplicacionForm'];
                //var_dump(json_encode($model ));die;
                if($model->validate() && $model->guardar() )
                {
                    Yii::app()->user->returnUrl = array("/usuario/aplicacionConfig#estilo");                                                          
                    $this->redirect(Yii::app()->user->returnUrl);  
                }
            }else if(isset($_POST['MViral']))
            {
                    $modelViral->attributes=$_POST['MViral'];
                 //   var_dump(json_encode($_POST));die;
                   // $modelViral->aplicacion_idaplicacion= $model->idaplicacion;
                    $modelViral->aplicacion_usuario_id_usuario=Yii::app()->user->getState('id_usuario');
                    $aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
                    if(is_object($aplicacionFromDb) && isset($aplicacionFromDb->nombre))
                     {    
                         $modelViral->aplicacion_idaplicacion=$aplicacionFromDb->idaplicacion;
                         $mviralFromDb= MViral::model()->findByAttributes(array('aplicacion_idaplicacion'=>$aplicacionFromDb->idaplicacion));
                            //var_dump(json_encode($mviralFromDb->attributes));die;
                            if(is_object($mviralFromDb) && isset($mviralFromDb->id_mviral)){
                                $modelViral->id_mviral=$mviralFromDb->id_mviral;
                                $modelViral->attributes=$_POST['MViral'];
                                $modelViral->setIsNewRecord(false);
                            }
                    }   
                  //  var_dump(json_encode($modelViral->attributes));die;
                   if(!isset($modelViral->id_mviral)){
                     if($modelViral->save()){
                        Yii::app()->user->returnUrl = array("/usuario/aplicacionConfig#Viral");                                                          
                        $this->redirect(Yii::app()->user->returnUrl);  
                     }
                   }else{
                    if($modelViral->update()){
                        Yii::app()->user->returnUrl = array("/usuario/aplicacionConfig#Viral");                                                          
                        $this->redirect(Yii::app()->user->returnUrl);  
                     } 
                   }
            }else if(isset($_POST['ModuloApp']))
            {
                //var_dump(json_encode($_POST));die;
                $moduloApp->attributes=$_POST['ModuloApp'];
                $moduloApp->texto_html=$_POST['ModuloApp']['texto_html'];
                 $aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
                
                
                if(is_object($aplicacionFromDb) && isset($aplicacionFromDb->nombre))
                {    
                   $moduloApp->aplicacion_idaplicacion=$aplicacionFromDb->idaplicacion;
                   $moduloApp->aplicacion_usuario_id_usuario=Yii::app()->user->getState('id_usuario');
                }
                if(!isset($moduloApp->id_modulo_app)){
                    if($moduloApp->save()){
                    //  var_dump($moduloApp->id_modulo_app);die;
                        if( $moduloApp->tipo_modulo==1 || $moduloApp->tipo_modulo==2 ){
                            $gallery=Gallery::model()->findByPk($moduloApp->id_contenido);
                            $gallery->name = true;
                            if( $moduloApp->tipo_modulo ==1){
                                $gallery->description = false;
                            }else if( $moduloApp->tipo_modulo ==2){
                                $gallery->description = true;
                            }
                            $gallery->save();
                      }
                      
                      if($moduloApp->tipo_modulo!=4 && $moduloApp->tipo_modulo!=5){
                        Yii::app()->user->returnUrl = array("/usuario/update?id=".$moduloApp->id_modulo_app);                                                          
                        $this->redirect(Yii::app()->user->returnUrl); 
                      }else{
                        Yii::app()->user->returnUrl = array("/usuario/aplicacionConfig#modulos");                                                          
                        $this->redirect(Yii::app()->user->returnUrl); 
                    
                      }


                    }
                }else{
                   if($moduloApp->update()){
                       Yii::app()->user->returnUrl = array("/usuario/update?id=".$moduloApp->id_modulo_app);                                                          
                    
                      $this->redirect(Yii::app()->user->returnUrl);   
                    } 
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
                $model->color_icon= $aplicacionFromDb->color_icon;
                
                $mviralFromDb= MViral::model()->findByAttributes(array('aplicacion_idaplicacion'=>$aplicacionFromDb->idaplicacion));
                //var_dump(json_encode($mviralFromDb->attributes));die;
                $moduloApp->aplicacion_idaplicacion=$aplicacionFromDb->idaplicacion;
                $moduloApp->aplicacion_usuario_id_usuario=Yii::app()->user->getState('id_usuario');
              


                if(is_object($mviralFromDb) && isset($mviralFromDb->id_mviral)){
                    $modelViral=$this->loadModel($mviralFromDb->id_mviral);
                    //var_dump(json_encode($modelViral->attributes));die;
                }else{
                           
                  //  var_dump("ingresa2222");
                    $modelViral->aplicacion_idaplicacion=$aplicacionFromDb->idaplicacion;
                    $modelViral->aplicacion_usuario_id_usuario=Yii::app()->user->getState('id_usuario');
                  
                }
            }
            $moduloSearch= new ModuloApp;
            $this->render('aplicacionConfig',array('model'=>$model,'modelViral'=>$modelViral,'moduloApp'=>$moduloApp ,'moduloSearch'=>$moduloSearch));
      }


      public function actionUpload() {

        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $folder = Yii::app()->basePath.'/uploads/'; // folder for uploaded files
        $allowedExtensions = array("jpg", "jpeg", "png"); //array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 10 * 1024 * 1024; // maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);


        $rnd = rand(0,9999); 
        $fileSize = filesize($folder . "{$rnd}-{$result['filename']}"); //GETTING FILE SIZE
        $fileName = $result['filename']; //GETTING FILE NAME

        echo $return; // it's array 
    }




      public function actionCreateModulo()
      {
          $moduloApp= new ModuloApp;
  
          // Uncomment the following line if AJAX validation is needed
          // $this->performAjaxValidation($model);
  
          if(isset($_POST['ModuloApp']))
          {
              var_dump(json_encode($_POST));die;
              $moduloApp->attributes=$_POST['ModuloApp'];

              var_dump($moduloApp->attributes);die;

              $aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
              
              
               if(is_object($aplicacionFromDb) && isset($aplicacionFromDb->nombre))
                {    
             
                 $moduloApp->aplicacion_idaplicacion=$aplicacionFromDb->idaplicacion;
                 $moduloApp->aplicacion_usuario_id_usuario=Yii::app()->user->getState('id_usuario');
                }

               

              if(!isset($moduloApp->id_modulo_app)){
                  if($moduloApp->insert()){

                 
                     Yii::app()->user->returnUrl = array("/usuario/aplicacionConfig#modulos");                                                          
                     $this->redirect(Yii::app()->user->returnUrl);  

                  }
                }else{
                 if($moduloApp->update()){
                     Yii::app()->user->returnUrl = array("/usuario/aplicacionConfig#modulos");                                                          
                     $this->redirect(Yii::app()->user->returnUrl);  
                  } 
                }
          }
  
          $this->render('create',array(
              'model'=>$model,
          ));
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
/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
    public function actionUpdate($id)
	{

        //var_dump("save   moduleeee");die;
       
		$model=$this->loadModelModulo($id);

        // Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
    
        if(isset($_POST['ajax']) && $_POST['ajax']==='modulo-app-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }


		if(isset($_POST['ModuloApp']))
		{
            $model->attributes=$_POST['ModuloApp'];
            $model->texto_html=$_POST['ModuloApp']['texto_html'];
            $model->texto_html=$_POST['ModuloApp']['icon'];
            if($model->save()){
               Yii::app()->user->returnUrl = array("/usuario/aplicacionConfig#modulos");                                                          
               $this->redirect(Yii::app()->user->returnUrl); 
            }          
            
		}else{
           
            $this->render('update',array(
                'model'=>$model,
            ));
        }
	}

	public function actionView($id)
	{
      // var_dump(json_encode($this->loadModelModulo($id)->attributes));die;
        
        $this->render('view',array(
			'model'=>$this->loadModelModulo($id),
        ));
        


    }
    
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModelModulo($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax'])){
            Yii::app()->user->returnUrl = array("/usuario/aplicacionConfig#modulos");                                                          
            $this->redirect(Yii::app()->user->returnUrl);  
        }
	        		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ModuloApp');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
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