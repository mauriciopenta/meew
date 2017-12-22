<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
    const ERROR_INVALID_USER=3;
    public $_id;
    

//    private $keyString="_.$|°p8";
    public function authenticate(){
        $criteria = new CDbCriteria;
        $criteria->select = 'id_usuario, password,id_persona,id_rol';
        
        $userFromDb= Usuario::model()->findByAttributes(array('usuario'=>$this->username),$criteria);
      


        
        if(!is_object($userFromDb) && !isset($userFromDb->usuario)){
                $this->errorCode=self::ERROR_USERNAME_INVALID;
        }
        else{
            $verifyPass=$this->verifyPassword($userFromDb->password,$this->password);
            if(!$verifyPass){
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }
            else{
                $tipoRol= Rol::model()->findByPk($userFromDb->id_rol);
                if($tipoRol->acceso_web==1){
                    if($userFromDb->usuario_activo==2){
                        $this->errorCode=self::ERROR_USERNAME_INVALID;
                    }else{
                        $this->errorCode=self::ERROR_NONE;
                        $this->_id=$userFromDb->id_persona;
                        $modelPerson=  Persona::model()->findByPk($userFromDb->id_persona);
                        $modelRole=  Rol::model()->findByPk($userFromDb->id_rol);
                        Yii::app()->user->setState('nombrePerson',$modelPerson->persona_nombre." ".$modelPerson->persona_apellidos);
                        Yii::app()->user->setState('nombreUsuario',$this->username);
                        Yii::app()->user->setState('nombreRole',$modelRole->rol_codigo);
                        Yii::app()->user->setState('id_usuario',$userFromDb->id_usuario);
                    }
                    
                }
                else{
                    $this->errorCode=self::ERROR_USERNAME_INVALID;
                }
                
            }
        }
        
        return !$this->errorCode;
    }
    
    private function verifyPassword($passHash,$passwordForm){
       if (password_verify($passwordForm, $passHash)) {
       // if ($passwordForm==$passHash) {
          return true;
        } else {
            echo  false;
        }
    }
    public function getId() {
        return $this->_id;
    }

   


    


//    private function cryptPassword($password){
//        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
//        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_DEV_URANDOM );
//        mcrypt_generic_init($td, $this->keyString, $iv);
//        $encrypted_data_bin = mcrypt_generic($td, $password);
//        mcrypt_generic_deinit($td);
//        mcrypt_module_close($td);
//        $encrypted_data_hex = bin2hex($iv).bin2hex($encrypted_data_bin);
//        return $encrypted_data_hex;
//    }
//    private function decryptPassword($password){
//        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
//        $iv_size_hex = mcrypt_enc_get_iv_size($td)*2;
//        $iv = pack("H*", substr($password, 0, $iv_size_hex));
//        $encrypted_data_bin = pack("H*", substr($password, $iv_size_hex));
//        mcrypt_generic_init($td, $this->keyString, $iv);
//        $decrypted = mdecrypt_generic($td, $encrypted_data_bin);
//        mcrypt_generic_deinit($td);
//        mcrypt_module_close($td);
//        return $decrypted;
//    }
}