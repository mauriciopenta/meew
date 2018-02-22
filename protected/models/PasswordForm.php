<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class PasswordForm extends CFormModel 
{
    public $password;
    public $PasswordNew;
    public $confirmPassword;
  public function rules()
  {
      return [
    
          [[ 'password', 'confirmPassword', 'PasswordNew'], 'required', 'message' => 'Campo requerido'],
          ['PasswordNew', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'Mínimo 8 y máximo 16 caracteres'],
          ['confirmPassword', 'compare', 'compareAttribute' => 'PasswordNew', 'message' => 'Las contraseña no coincide.'],
      ];
  }

  
  public function attributeLabels()
  {
      return array(
          'password' => 'Contraseña Antigua',
          'PasswordNew' => 'Nueva contraseña',
          'confirmPassword' => 'Confirme la nueva contraseña'
      );
  }





}