<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class UsuarioFormUpdate extends CFormModel 
{


    public $id_usuario;
    public $id_persona;
    public $persona_nombre;
    public $persona_apellidos;
    public $usuario;
    public $persona_correo;
    public $persona_doc;
    public $id_doc;
    public $ubicacion;
    public $region;
    public $telefono="";
    public $edad="";
    public $genero="";
    public $tipo_tarjeta;
    public $numero_tarjeta;
    public $fecha_vencimiento_mes="";

    public $fecha_vencimiento_anio="";
    public $nombre_tarjeta="";
    public $codigo_tarjeta="";

    public $nombre_completo="";
   
    public $plan;
/*
Visa, Mastercard, Amex, Diners y Crédito Fácil Codensa

*/

  public function rules()
  {
      return [
    
          [['usuario', 'tipo_tarjeta','persona_nombre','persona_apellidos', 'persona_doc', 'id_doc','ubicacion','region','telefono','numero_tarjeta','fecha_vencimiento_mes','fecha_vencimiento_anio','nombre_tarjeta','codigo_tarjeta', 'plan' ], 'required', 'message' => 'Campo requerido'],
          ['usuario', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
          ['usuario', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras y números'],
          ['persona_correo', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
             ['persona_correo', 'email', 'message' => 'Formato no válido'],
          ["persona_nombre, persona_apellidos","match", "pattern" => "/^[a-zA-Z ñÑáéíóúüç]*$/","message"=>"El nombre solo puede estar formado por letras"],
          ['persona_doc, numero_tarjeta, telefono', 'match', 'pattern' => "/^[0-9]+$/i", 'message' => 'Sólo se aceptan números'],
        
          [['usuario', 'tipo_tarjeta', 'password','confirmPassword','persona_nombre','persona_apellidos', 'persona_doc', 'id_doc','ubicacion','region','telefono','numero_tarjeta','fecha_vencimiento_mes','fecha_vencimiento_anio','nombre_tarjeta','codigo_tarjeta', 'plan' ], 'safe', 'on'=>'search']

          
        ];
  }

  
  public function attributeLabels()
  {
      return array(
          'persona_nombre' => 'Nombres',
          'persona_apellidos' => 'Apellidos',
          'usuario' => 'Nombre de Usuario',
          'ubicacion' => 'Ubicacion',
          'persona_doc' => 'Número de documento',
          'persona_correo'=>'Correo',
          'id_doc' => 'Tipo de Documento'
      );
  }


  function save($usuario, $persona){
    $pago=new Pago;
    $response1=$pago->consultar_tarjeta($usuario->id_tarjeta);
    if($response1){
       
       if($this->numero_tarjeta!=$response1->number){
       
            $response= $pago->editar_tarjeta($usuario->id_tarjeta,$usuario->id_cliente_payu, $this->nombre_tarjeta, $this->numero_tarjeta,
            $this->fecha_vencimiento_anio."/".$this->fecha_vencimiento_mes, $this->tipo_tarjeta,"","","","");
        
               if($response){
                    $usuario->id_tarjeta=$response->token;
                    $persona->persona_ubicacion=$this->ubicacion;
                    $persona->persona_ciudad=$this->region;
                    $persona->persona_telefono=$this->telefono;
                    if($usuario->save() && $persona->save()){
                        return true;
                    }else{
                        return false;
                    }

                }else{
                    return false;
                }
        }else{
            $persona->persona_ubicacion=$this->ubicacion;
            $persona->persona_ciudad=$this->region;
            $persona->persona_telefono=$this->telefono;

                if($usuario->save() && $persona->save()){
                            return true;
                      
                }else{
                    return false;
                }
        }
    }
    
     


  }









}