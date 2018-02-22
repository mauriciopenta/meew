<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RecoverForm extends CFormModel
{
	public $correo;


	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			['correo', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            ['correo', 'email', 'message' => 'Formato no válido'],
            ['correo', 'email_existe']
        
		
		);
	}

        
    public function email_existe($attribute, $params)
    {
		
		
        $criteria = new CDbCriteria;
        $personaFromDb= Persona::model()->findByAttributes(array('persona_correo'=>$this->correo));
	    if($personaFromDb==null){
			$this->addError("correo", "El correo no esta registrado");
			
            return true;
        }
        return false;
    }



	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function recover()
	{
	  
		$subject = "Reajustar contraseña";
        Yii::import('ext.yii-mail-master.YiiMailMessage');
		$message = new YiiMailMessage;
		$message->view = "mailer";
		$message->setSubject($subject);
	
		$personaFromDb= Persona::model()->findByAttributes(array('persona_correo'=>$this->correo));
		$date1 = new DateTime($personaFromDb->fecha_reset);
		$date2 = date_create('now');
		
	
		$diff = $date1->diff($date2);
		// will output 2 days
	
		if(($personaFromDb->codigo_reset=='') || $diff->h>3 || $diff->m>0 || $diff->d>0 || $diff->y >0){
           
           $personaFromDb->codigo_reset = $this->generarCodigo(25);
		}
		
		$personaFromDb->fecha_reset = date_create('now')->format('Y-m-d H:i:s');

		if($personaFromDb->save()){
			$message->setBody( 
			array("correo"=>$this->correo, "url"=> Yii::app()->params["domain"]."/site/reset?codigo=".$personaFromDb->codigo_reset	 ), 'text/html');   
			$message->addTo($this->correo);

			$message->from = Yii::app()->params['adminEmail'];
			Yii::app()->mail->send($message);
            return true;
		}
		return false;

	}



    function generarCodigo($longitud, $tipo=0)
    {
        //creamos la variable codigo
        $codigo = "";
        //caracteres a ser utilizados
        $caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        //el maximo de caracteres a usar
        $max=strlen($caracteres)-1;
        //creamos un for para generar el codigo aleatorio utilizando parametros min y max
        for($i=0;$i < $longitud;$i++)
        {
            $codigo.=$caracteres[rand(0,$max)];
        }
        //regresamos codigo como valor
        return $codigo;
    }
}
