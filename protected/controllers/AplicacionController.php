<?php

class AplicacionController extends Controller
{


/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
        /**
         * @return array action filters
         */
        public function filters()
        {
            return array(
                'accessControl'
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
                   
                    'users'=>array('@'),
                ),
                array('allow', 
                'actions' => array('admin', 'delete','aplicaciones','download_resources'),
                'users' => array('admin')
                ),
                array('deny',  // deny all users
                    'users'=>array('*'),
                ),
            );
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
	public function actionConfig()
	{
            $model=new AplicacionForm;
            $modelAplicacion=new Aplicacion;
            $modelViral=new MViral;
            $moduloApp= new ModuloApp;
            $render=true;
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
                
                if($model->validate() && $model->guardar())
                {
                    Yii::app()->user->returnUrl = array("/aplicacion/config#estilo");                                                          
                    $this->redirect(Yii::app()->user->returnUrl);  
                }else{

                    $render=false;
                 //var_dump("swiqhwbdiqbduyhbqwhybq");die;
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
                            if(is_object($mviralFromDb) && isset($mviralFromDb->id_mviral)){
                                $modelViral->id_mviral=$mviralFromDb->id_mviral;
                                $modelViral->attributes=$_POST['MViral'];
                                $modelViral->setIsNewRecord(false);
                            }
                    }   
                  //  var_dump(json_encode($modelViral->attributes));die;
                   if(!isset($modelViral->id_mviral)){
                     if($modelViral->save()){
                        Yii::app()->user->returnUrl = array("/aplicacion/config#Viral");                                                          
                        $this->redirect(Yii::app()->user->returnUrl);  
                     }
                   }else{
                    if($modelViral->update()){
                        Yii::app()->user->returnUrl = array("/aplicacion/config#Viral");                                                          
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
                       
                                if( $moduloApp->tipo_modulo ==1){
                                    $gallery->name = true;
                                    $gallery->description = true;
                                    $gallery->precio = false;
                                    $gallery->precio_text = false;
                                    $gallery->unidades = false;
                                    $gallery->url_video = true;
                                }else if( $moduloApp->tipo_modulo ==2){
                                    $gallery->description = true;
                                    $gallery->precio = true;
                                    $gallery->precio_text = true;
                                    $gallery->unidades = true;
                                    $gallery->url_video = true;
                                }
                                $gallery->save();
                           
 

                      }
                      
                      if($moduloApp->tipo_modulo!=4 && $moduloApp->tipo_modulo!=5){
                        Yii::app()->user->returnUrl = array("/aplicacion/update?id=".$moduloApp->id_modulo_app);                                                          
                        $this->redirect(Yii::app()->user->returnUrl); 
                      }else{
                        Yii::app()->user->returnUrl = array("/aplicacion/config#modulos");                                                          
                        $this->redirect(Yii::app()->user->returnUrl); 
                    
                      }


                    }
                }else{
                   if($moduloApp->update()){
                       Yii::app()->user->returnUrl = array("/aplicacion/update?id=".$moduloApp->id_modulo_app);                                                          
                    
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
                $model->imageFile=Yii::app()->request->baseUrl . $aplicacionFromDb->url_fondo;
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
                $model->modulo_viral= $aplicacionFromDb->modulo_viral;
                $model->color_icon= $aplicacionFromDb->color_icon;
                $model->genero= $aplicacionFromDb->genero;
                $model->rango_edad= $aplicacionFromDb->rango_edad;
                
                $model->imagen_splash= $aplicacionFromDb->imagen_splash;
                $model->imagen_icon= $aplicacionFromDb->imagen_icon;
                $model->icon_interno= $aplicacionFromDb->icon_interno;
     
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
           
            $this->render('config',array('model'=>$model,'modelViral'=>$modelViral,'moduloApp'=>$moduloApp ,'moduloSearch'=>$moduloSearch, 'modelAplicacion'=>$aplicacionFromDb));
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

    public function actionUpload_resource($idaplicacion = null, $type = null)
    {
        
     
        $model=Aplicacion::model()->find('idaplicacion='.$idaplicacion);

		if($model===null){
			throw new CHttpException(404,'The requested page does not exist.');
        }else{

            $imageFile = CUploadedFile::getInstanceByName('file');
           
                          
                 //   $tmp = $uploadedFile->tempName;
                //  var_dump(dirname(Yii::app()->request->scriptFile));die;
                    if($type=='splash'){
                        try {
                            $fileName = "splash-" . $idaplicacion . ".".$imageFile->getExtensionName(); 
                      
                        } catch (Exception $e) {
                            $fileName = "splash-" . $idaplicacion .$uploadedFile->tempName; 
                        }
                       
                       
                        $imageFile->saveAs(dirname(Yii::app()->request->scriptFile).'/uploads/'.$fileName);
                        $model->imagen_splash= '/uploads/'.$fileName; 
                    }else if($type=='icon'){
                        $fileName = "icon-".$idaplicacion.".".$imageFile->getExtensionName(); 
                        $imageFile->saveAs(dirname(Yii::app()->request->scriptFile).'/uploads/'.$fileName);
                        $model->imagen_icon= '/uploads/'.$fileName; 
                    }else if($type=='icon_header'){
                        $fileName = "iconfeader-".$idaplicacion.".".$imageFile->getExtensionName(); 
                        $imageFile->saveAs(dirname(Yii::app()->request->scriptFile).'/uploads/'.$fileName);
                     
                        $model->icon_interno= '/uploads/'.$fileName; 
                    }
                    $model->save();
                    
                    header("Content-Type: text/html");
                    echo CJSON::encode(
                        array(
                            'idaplicacion' =>$idaplicacion,
                            'imagen_splash' => Yii::app()->request->baseUrl.$model->imagen_splash,
                            'imagen_icon' =>Yii::app()->request->baseUrl. $model->imagen_icon,
                            'imagen_icon_int' =>Yii::app()->request->baseUrl. $model->icon_interno,
                            'type'=> $type
                        ));
           
        }    
    }
   public function createZip($files = array(), $destination = '', $overwrite = false) {


        if(file_exists($destination) && !$overwrite) { return false; }
     
     
        $validFiles = [];
        if(is_array($files)) {
           foreach($files as $file) {
              if(file_exists($file)) {
                 $validFiles[] = $file;
              }
           }
        }
     
     
        if(count($validFiles)) {
           $zip = new ZipArchive();
           if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
              return false;
           }
     
     
           foreach($validFiles as $file) {
              $zip->addFile($file,$file);
           }
     
     
           $zip->close();
           return file_exists($destination);
        }else{
           return false;
        }
     }

    public function actionDownload_resources($idaplicacion = null)
    {

        $model=Aplicacion::model()->find('idaplicacion='.$idaplicacion);
        if($model===null){
			throw new CHttpException(404,'The requested page does not exist.');
        }else{
        
            $files =array();
            if($model->imagen_splash!=''){
              $files[0]=dirname (Yii::app()->request->scriptFile).$model->imagen_splash;
            }

            if($model->imagen_icon!=''){
                $files[1]=dirname (Yii::app()->request->scriptFile).$model->imagen_icon;
            }
            if($model->icon_interno!=''){
                $file[2]=dirname (Yii::app()->request->scriptFile).$model->icon_interno;
            }
            $rnd = rand(0,9999);
           
            $destination=dirname (Yii::app()->request->scriptFile)."/uploads/".$idaplicacion.$rnd.".zip";
            $validFiles = [];
            if(is_array($files)) {
               foreach($files as $file) {
                  if(file_exists($file)) {
                     $validFiles[] = $file;
                  }
               }
            }
         
         $result=false;
            if(count($validFiles)) {
               $zip = new ZipArchive();
               $ret =$zip->open($destination,ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
               $dir = '/recursos';
      

              if($ret){
                    foreach($validFiles as $file) {
                        $lastIndex = strripos($file, "/");
                        $name=substr($file,$lastIndex+1);
                        $zip->addFile($file,$dir."/".$name);
                    }
                
                
                    $zip->close();
                    $result= file_exists($destination);
              }
            }else{
                $result=false;
            }


            header("Content-Disposition: attachment; filename=\"" .$idaplicacion.$rnd.".zip"."\"");
            header("Content-Length: ".filesize($destination));
            readfile($destination);
          
          
           

        }

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

                 
                     Yii::app()->user->returnUrl = array("/aplicacion/config#modulos");                                                          
                     $this->redirect(Yii::app()->user->returnUrl);  

                  }
                }else{
                 if($moduloApp->update()){
                     Yii::app()->user->returnUrl = array("/aplicacion/config#modulos");                                                          
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



	public function actionAplicaciones()
	{
        
        $model=new Aplicacion('search_app');
        $model->unsetAttributes();  // clear any default values
       // var_dump(json_encode( $model));die;

        if(isset($_GET['Aplicacion'])){
            $model->idaplicacion=$_GET['Aplicacion']['idaplicacion'];
            $model->nombre=$_GET['Aplicacion']['nombre'];
            $model->id_plantilla=$_GET['Aplicacion']['id_plantilla'];
            $model->paquete=$_GET['Aplicacion']['paquete'];
		
        }
          

		$this->render('aplicaciones',array(
			'model'=>$model,
        ));
        



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
               Yii::app()->user->returnUrl = array("/aplicacion/config#modulos");                                                          
               $this->redirect(Yii::app()->user->returnUrl); 
            }          
            
		}else{
            $aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
           
            $this->render('update',array(
                'model'=>$model,
                'model_aplicacion'=>$aplicacionFromDb
            ));
        }
	}

	public function actionView($id)
	{
        
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
            Yii::app()->user->returnUrl = array("/aplicacion/config#modulos");                                                          
            $this->redirect(Yii::app()->user->returnUrl);  
        }
	        		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Aplicacion');
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