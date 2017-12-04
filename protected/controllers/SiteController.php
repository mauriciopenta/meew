<?php
class SiteController extends Controller
{
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
        else{
            Yii::app()->user->returnUrl = array("site/index");          
            $this->redirect(Yii::app()->user->returnUrl);
        }
        $filterChain->run();
    }
    /**
     * @return array action filters
     */
    public function filters(){
        return array(
                'enforcelogin -login -index -logout -contact -registerPlatform -searchservices -registerPlatformMovile -loginPlatformMovile',                      
        );
    }
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex(){
            if(Yii::app()->user->isGuest){
                Yii::app()->user->returnUrl = array("site/login");                                                          
                $this->redirect(Yii::app()->user->returnUrl);
            }
            else{
                $user=Yii::app()->user->name;
//                $service=  Service::model()->searchServiceByUsername($user);
//                $modelEntity=  Entity::model();
//                $modelEntityPerson=  EntityPerson::model();
                $this->render('index');
            }
	}
        
        public function actionSearchservices(){
//            $headers=getallheaders();
//            print_r($headers["oauthtoken"]);
            $user=Yii::app()->user->name;
            $services=  Service::model()->searchServiceByUsername($user);
            if(!empty($services)){
                foreach($services as $pk=>$service){
                    $objectAnchoraged=  EntityDevice::model()->searchObjectAnchorage($service["id_service"]);
                    if(empty($objectAnchoraged)){
                        $services[$pk]["anchorage"]=2;
                    }
                    else{
                        $services[$pk]["anchorage"]=1;
                        foreach($objectAnchoraged as $pkobj=>$object){
                            $services[$pk]["objects"][$pkobj]=$object;
                            if(empty($object["data"])){
                                $services[$pk]["objects"][$pkobj]["data"]="null";
                            }
                        }
                    }
                }
            }
            echo CJSON::encode($services);
        }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
            
            if(Yii::app()->user->isGuest){
                $model=new LoginForm;
                //print_r($_POST);
                // if it is ajax validation request
                if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
                {
                        print_r( CActiveForm::validate($model));
//                        
                    Yii::app()->end();
                }
                
                // collect user input data
                if(isset($_POST['LoginForm'])){
                        $model->attributes=$_POST['LoginForm'];
                        // validate user input and redirect to the previous page if valid
                        if($model->validate() && $model->login()){
                            Yii::app()->user->returnUrl = array("site/index");                                                          
                            $this->redirect(Yii::app()->user->returnUrl);
                        }
                }
                // display the login form
//                Yii::app()->user->setFlash('success', "Data1 saved!");
                $this->render('login',array("model"=>$model));
            }
            else{
                 $this->redirect(Yii::app()->user->returnUrl);
            }
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout(){
            Yii::app()->user->logout();
            Yii::app()->user->returnUrl = array("site/login");                                                          
            $this->redirect(Yii::app()->user->returnUrl);
	}
        
        public function actionRegisterPlatformMovile(){
            $modeloUsuario=new Usuario();
            $modeloPersona=new Persona();
            $datos=Yii::app()->request->getPost("Usuario");
            $modeloUsuario->attributes=$datos;
            $modeloUsuario=
            $modeloPersona->attributes=$datos;
            $correo=$modeloPersona->findByAttributes(array("persona_correo"=>$modeloPersona->persona_correo));
            $usuario=$modeloUsuario->findByAttributes(array("usuario"=>$modeloUsuario->usuario));
            
            if(empty($correo) && empty($usuario)){
                $transaction=Yii::app()->db->beginTransaction();
                try{
                    $modeloPersona->save();
                    $modeloUsuario->id_persona=$modeloPersona->id_persona;
                    $modeloUsuario->password=$this->cryptPassword($modeloUsuario->password);
                    if($modeloUsuario->save()){
                        $transaction->commit();
                        $response["status"]="exito";
                        $response["msg"]="El usuario ha sido registrado";
                    }
                    else{
                        $transaction->rollback();
                        $response["status"]="noexito";
                        $response["msg"]=$modeloUsuario->errors;
                    }
                    
                }
                catch(ErrorException $e){
                    
                    throw new CHttpException($e->get,$e->getMessage());
                }
            }
            else{
                (!empty($correo))?$response["msg"]="El correo ya está registrado </br>":$response["msg"]="";
                (!empty($usuario))?$response["msg"].="El usuario ya está registrado":$response["msg"].="";
                $response["status"]="noexito";
            }
            echo CJSON::encode($response);
        }
        
        public function actionLoginPlatformMovile(){
            $modeloUsuario= Usuario::model();
//            $modeloPersona= Persona::model();
            $datos=Yii::app()->request->getPost("Usuario");
            $modeloUsuario->attributes=$datos;
            
            $model=new LoginForm;
            $model->username=$modeloUsuario->usuario;
            $model->password=$datos["password"];
            
            if($model->login()){
                $response["status"]="exito";
                $response["usuario"]["email"]=Persona::model()->persona_correo;
                $response["usuario"]["token"]="lkjd02kd0lksksdfAAsld9E";
                $response["msg"]="";
            }
            else{
                $response["status"]="nexito";
                $response["msg"]="Usuario o contraseña inválidos";
            }
            echo CJSON::encode($response);
        }
        public function actionRegisterPlatform(){
            if(empty($_POST)){
                $cdrs=$_GET["cdrs"];
                $modelCodeRegister=  CodeRegister::model()->findByAttributes(array('code_register'=>$cdrs));
                $personRegister=false;
                $modelUser=  User::model();
                if(!empty($modelCodeRegister)){
                    $personRegister=true;
                }
                $this->render('_registerplatform',array(
                    "cdrs"=>$cdrs,
                    'model'=>$modelUser,
                    'modelCodeRegister'=>$modelCodeRegister,
                    'personRegister'=>$personRegister
                ));
            }
            else{
                $personRegister=true;
                $modelUser=User::model();
                $modelUser->attributes=Yii::app()->request->getPost("User");
                $cdrs=$_GET["cdrs"];
                $modelCodeRegister=  CodeRegister::model()->findByAttributes(array('code_register'=>$cdrs));
                if(!empty($modelCodeRegister)){
                    $modelUserReg=  User::model()->findByPk($modelCodeRegister->id_user);
                }
                $modelUser->id_user=$modelUserReg->id_user;
                $modelUser->id_person=$modelUserReg->id_person;
                $modelUser->id_role=$modelUserReg->id_role;
                $modelUser->user_active=1;
                 // if it is ajax validation request
                if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
                {
                        echo CActiveForm::validate($modelUser);
                        Yii::app()->end();
                }
                
                if($modelUser->validate()){
                    $modelUser->password=$this->cryptPassword($modelUser->password);
                    if($modelUser->updateByPk($modelUser->id_user,array("password"=>$modelUser->password,"username"=>$modelUser->username,"user_active"=>$modelUser->user_active))){
                        $modelCodeRegister->deleteByPk($modelCodeRegister->id_coderegister);
                        Yii::app()->user->setFlash('success', "Su usuario ha sido activado");
                    }
                }
                
                $this->render('_registerplatform',array(
                    "cdrs"=>$cdrs,
                    'model'=>$modelUser,
                    'modelCodeRegister'=>$modelCodeRegister,
                    'personRegister'=>$personRegister
                ));
            }
        }
        private function cryptPassword($prePassword){
            $opciones = [
                'cost' => 10
            ];
            $password=password_hash($prePassword, PASSWORD_BCRYPT, $opciones);
            return $password;
        }
}