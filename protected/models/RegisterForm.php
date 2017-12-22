<?php


class RegisterForm extends CFormModel
{
    public $username;
    public $email;
    public $password;
    public $confirmPassword;
    public $nombres;
    public $apellidos;
    public $tipo_documento;
    public $documento;
    public $personRegister=false;
    private $_identity;
    

    
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'confirmPassword', 'nombres','apellidos', 'documento', 'tipo_documento' ], 'required', 'message' => 'Campo requerido'],
            ['username', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
            ['username', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras y números'],
            ['username', 'username_existe'],
           // [['username'], 'exist','targetClass'=>'app/models/Usuario','message'=>'El usuario seleccionado existe'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato no válido'],
            ['email', 'email_existe'],
            ["nombres, apellidos","match", "pattern" => "/^[a-zA-Z ñÑáéíóúüç]*$/","message"=>"El nombre solo puede estar formado por letras"],
            ['documento', 'match', 'pattern' => "/^[0-9]+$/i", 'message' => 'Sólo se aceptan números'],
            ['documento', 'documento_existe'],
            ['password', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'Mínimo 6 y máximo 16 caracteres'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Los passwords no coinciden'],
        ];
    }
    
    public function email_existe($attribute, $params)
    {
        
        if($user = Persona::model()->exists('persona_correo=:persona_correo',array('persona_correo'=>$this->email)))
             $this->addError("email", "El email seleccionado existe");

        $criteria = new CDbCriteria;
        $personaFromDb= Persona::model()->findByAttributes(array('persona_correo'=>$this->email));
        if(is_object($personaFromDb) && isset($personaFromDb->persona_correo)){
            $this->addError("email", "El email seleccionado existe");
            return true;
        }
        return false;
    }


    public function documento_existe($attribute, $params)
    {
       

        if($user = Persona::model()->exists('persona_doc=:persona_doc',array('persona_doc'=>$this->documento)))
           $this->addError($attribute, "El email seleccionado existe");


        $criteria = new CDbCriteria;
        $personaFromDb= Persona::model()->findByAttributes(array('persona_doc'=>$this->documento));
        if(is_object($personaFromDb) && isset($personaFromDb->persona_correo)){
            $this->addError($attribute, "El email seleccionado existe");
            return true;
        }
       
        return false; 
    }

 
    public function username_existe($attribute, $params)
    {

        if($user = Usuario::model()->exists('usuario=:usuario',array('usuario'=>$this->username)))
           $this->addError($attribute, "El usuario seleccionado existe");


       
    }

	public function register()
	{
        if($this->_identity===null)
		{
		    $table_persona = new Persona;
            $table_persona->id_doc=$this->tipo_documento;
            $table_persona->persona_correo=$this->email;
            $table_persona->persona_nombre=$this->nombres;
            $table_persona->persona_apellidos=$this->apellidos;
            $table_persona->persona_doc=$this->documento;
            if ($table_persona->insert())
            {
               
               $id_persona = $table_persona->id_persona;

               $table = new Usuario;
               $table->usuario = $this->username;
               $table->id_persona = $id_persona;
               $table->id_rol = 2;
               $table->password = $this->password;
               $table->usuario_activo = 2;
               $table->id_tipologin = 2;
               $table->id_empresa = null;
                //Encriptamos el password
                $opciones = [
                    'cost' => 10
                ];
                $password=password_hash($this->password, PASSWORD_BCRYPT, $opciones);
               $table->password = $password;
               
               //Creamos una cookie para autenticar al usuario cuando decida recordar la sesión, esta misma
               //clave será utilizada para activar el usuario
             // $table->authKey = $this->randKey("abcdef0123456789", 200);
              //Creamos un token de acceso único para el usuario
             // $table->accessToken = $this->randKey("abcdef0123456789", 200);
              if ($table->insert())
              {
              //Si el registro es guardado correctamente
              //Nueva consulta para obtener el id del usuario
              //Para confirmar al usuario se requiere su id y su authKey
             
              $id = urlencode($table->id_usuario);
              //$authKey = urlencode($user->authKey);
              $subject = "Confirmar registro";
              $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
              $body .= "<a href='http://yii.local/index.php/site/confirm&id=".$id."'>Confirmar</a>";
           

            /*  $message = new YiiMailMessage;;
              //this points to the file test.php inside the view path
              $message->subject =  $subject;
              $message->setBody($body);
              $message->addTo($this->email);
              $message->from = Yii::app()->params['adminEmail'];
              Yii::app()->mail->send($message);
            
             */
/*

              //Enviamos el correo
                Yii::$app->mailer->compose()
                ->setTo($this->email)
                ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
                ->setSubject($subject)
                ->setHtmlBody($body)
                ->send();*/
                $messageType = 'success';
                $message = "<div class='alert alert-info alert-dismissable'>Se envío un email, para confirmar tu correo.</div>";
                Yii::app()->user->setFlash($messageType, $message);

                $msg = "Ahora sólo falta que confirmes tu registro en tu cuenta de correo";
                
                return true;
                
              }else{
                return false;
              }
           

            }else{
                return false;
              }

            }
            if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
            {
                $duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
                Yii::app()->user->login($this->_identity,$duration);
                return true;
            }
            else
                return false;
	}

 

}