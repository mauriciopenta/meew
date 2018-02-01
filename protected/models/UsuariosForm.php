<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class UsuarioForm extends CFormModel 
{
    public $id_usuario;
    public $id_tipologin;
    public $usuario="";
    public $usuario_activo;
    public $id_persona;
    public $id_doc;
    public $username;//
    public $email;//
    public $password;//
    public $confirmPassword;//
    public $nombres;//
    public $apellidos;//
    public $tipo_documento;//
    public $documento;//
    public $personRegister=false;//
    private $_identity;//


    public $ubicacion="";
    public $region="";
    public $telefono="";
    public $edad="";
    public $genero="";
    public $contrasena="";
    public $contrasena2="";


    public $metodo_pago="";
    public $numero_tarjeta="";
    public $fecha_vencimiento="";
    public $nombre_tarjeta="";
    public $codigo_tarjeta="";

    public $tipo_documento_pago="";
    public $numero_documento="";
    public $nombre_completo="";
   
    public $plan="";
    
           


   
    

    
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'confirmPassword', 'nombres','apellidos', 'documento', 'tipo_documento','id_persona, usuario_activo', 'required' ], 'required', 'message' => 'Campo requerido'],
            ['username', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
            ['username', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras y números'],
            ['username', 'username_existe'],
           // [['username'], 'exist','targetClass'=>'app/models/Usuario','message'=>'El usuario seleccionado existe'],
            ['id_tipologin, id_persona, id_rol, id_empresa, usuario_activo', 'numerical', 'integerOnly'=>true],
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



}


            

