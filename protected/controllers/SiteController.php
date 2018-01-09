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
          //  Yii::app()->user->returnUrl = array("site/index");          
           // $this->redirect(Yii::app()->user->returnUrl);
        }
        $filterChain->run();
    }
    /**
     * @return array action filters
     */
    public function filters(){
        return array(
                'enforcelogin -login -register -index -logout -contact -registerPlatform -searchservices -registerPlatformMovile -loginPlatformMovile -plantillaManager -aplicacionConfig -Config',                      
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
   

        private function randKey($str='', $long=0)
        {
            $key = null;
            $str = str_split($str);
            $start = 0;
            $limit = count($str)-1;
            for($x=0; $x<$long; $x++)
            {
                $key .= $str[rand($start, $limit)];
            }
            return $key;
        }
        
        public function actionConfirm()
        {
            $table = new Users;
            if (Yii::$app->request->get())
            {
        
                //Obtenemos el valor de los parámetros get
                $id = Html::encode($_GET["id"]);
                $authKey = $_GET["authKey"];
            
                if ((int) $id)
                {
                    //Realizamos la consulta para obtener el registro
                    $model = $table
                    ->find()
                    ->where("id=:id", [":id" => $id])
                    ->andWhere("authKey=:authKey", [":authKey" => $authKey]);
        
                    //Si el registro existe
                    if ($model->count() == 1)
                    {
                        $activar = Users::findOne($id);
                        $activar->activate = 1;
                        if ($activar->update())
                        {
                            echo "Enhorabuena registro llevado a cabo correctamente, redireccionando ...";
                            echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
                        }
                        else
                        {
                            echo "Ha ocurrido un error al realizar el registro, redireccionando ...";
                            echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
                        }
                    }
                    else //Si no existe redireccionamos a login
                    {
                        return $this->redirect(["site/login"]);
                    }
                }
                else //Si id no es un número entero redireccionamos a login
                {
                    return $this->redirect(["site/login"]);
                }
            }
        }
        
        public function actionRegister(){
            if(Yii::app()->user->isGuest){
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
                // display the login form
//                Yii::app()->user->setFlash('success', "Data1 saved!");
                $this->render('register',array("model"=>$model));
            }
            else{
                 $this->redirect(Yii::app()->user->returnUrl);
            }    
        }

        public function actionRegister2()
        {
        //Creamos la instancia con el model de validación
        $model = new FormRegister;
        
        //Mostrará un mensaje en la vista cuando el usuario se haya registrado
        $msg = null;
        
        //Validación mediante ajax
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
                {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
        
        //Validación cuando el formulario es enviado vía post
        //Esto sucede cuando la validación ajax se ha llevado a cabo correctamente
        //También previene por si el usuario tiene desactivado javascript y la
        //validación mediante ajax no puede ser llevada a cabo
        if ($model->load(Yii::$app->request->post()))
        {
        if($model->validate())
        {
            //Preparamos la consulta para guardar el usuario
            $table = new Usuario;
            $table->username = $model->username;
            $table->email = $model->email;
            //Encriptamos el password
            $table->password = crypt($model->password, Yii::$app->params["salt"]);
            //Creamos una cookie para autenticar al usuario cuando decida recordar la sesión, esta misma
            //clave será utilizada para activar el usuario
            $table->authKey = $this->randKey("abcdef0123456789", 200);
            //Creamos un token de acceso único para el usuario
            $table->accessToken = $this->randKey("abcdef0123456789", 200);
            
            //Si el registro es guardado correctamente
            if ($table->insert())
            {
            //Nueva consulta para obtener el id del usuario
            //Para confirmar al usuario se requiere su id y su authKey
            $user = $table->find()->where(["email" => $model->email])->one();
            $id = urlencode($user->id);
            $authKey = urlencode($user->authKey);
            
            $subject = "Confirmar registro";
            $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
            $body .= "<a href='http://yii.local/index.php?r=site/confirm&id=".$id."&authKey=".$authKey."'>Confirmar</a>";
            
            //Enviamos el correo
            Yii::$app->mailer->compose()
            ->setTo($user->email)
            ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
            ->setSubject($subject)
            ->setHtmlBody($body)
            ->send();
            
            $model->username = null;
            $model->email = null;
            $model->password = null;
            $model->password_repeat = null;
            
            $msg = "Enhorabuena, ahora sólo falta que confirmes tu registro en tu cuenta de correo";
            }
            else
            {
            $msg = "Ha ocurrido un error al llevar a cabo tu registro";
            }
            
        }
        else
        {
            $model->getErrors();
        }
        }
        return $this->render("register", ["model" => $model, "msg" => $msg]);
        }





        private function cryptPassword($prePassword){
            $opciones = [
                'cost' => 10
            ];
            $password=password_hash($prePassword, PASSWORD_BCRYPT, $opciones);
            return $password;
        }



 




}