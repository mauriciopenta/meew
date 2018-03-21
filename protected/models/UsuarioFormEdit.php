<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class UsuarioFormEdit extends CFormModel 
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
    public $password;
    public $confirmPassword;
    public $msg_error="";
/*
Visa, Mastercard, Amex, Diners y Crédito Fácil Codensa

*/

  public function rules()
  {
      return [
          [['usuario', 'tipo_tarjeta', 'password','confirmPassword','persona_nombre','persona_apellidos', 'persona_doc', 'id_doc','ubicacion','region','telefono','numero_tarjeta','fecha_vencimiento_mes','fecha_vencimiento_anio','nombre_tarjeta','codigo_tarjeta', 'plan' ], 'required', 'message' => 'Campo requerido'],
          ['usuario', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
          ['usuario', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras y números'],
          ['persona_correo', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
          ['persona_correo', 'email', 'message' => 'Formato no válido'],
          ["persona_nombre, persona_apellidos","match", "pattern" => "/^[a-zA-Z ñÑáéíóúüç]*$/","message"=>"El nombre solo puede estar formado por letras"],
          ['persona_doc, numero_tarjeta, telefono', 'match', 'pattern' => "/^[0-9]+$/i", 'message' => 'Sólo se aceptan números'],
          [[ 'password', 'confirmPassword'], 'required', 'message' => 'Campo requerido'],
          ['password', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'Mínimo 8 y máximo 16 caracteres'],
          ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Las contraseña no coincide.'],
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
       $this->msg_error="";
       $pago=new Pago;
       $response= $pago->crear_tarjeta($usuario->id_cliente_payu, $this->nombre_tarjeta, $this->numero_tarjeta,
       $this->fecha_vencimiento_anio."/".$this->fecha_vencimiento_mes, $this->tipo_tarjeta, "","","","");
      if($response){
        $usuario->id_tarjeta=$response->token;
         $opciones = [
            'cost' => 10
        ];
        $password=password_hash($this->password, PASSWORD_BCRYPT, $opciones);
        $usuario->password=$password;
        $persona->persona_ubicacion=$this->ubicacion;
        $persona->persona_ciudad=$this->region;
        $persona->persona_telefono=$this->telefono;
        if($usuario->save() && $persona->save()){

            $plan_nuevo=Plan::model()->find("plan_code='".$this->plan."'");
         
            $referencia = rand(0,99999999999);
		    $response_pago= $pago->cobro_individual(
            $usuario->id_cliente_payu,
            $referencia,
            $persona->persona_nombre." ".$persona->persona_apellidos,
            $persona->persona_correo,
            "Pago de suscripción ".$plan_nuevo->plan_nombre ,
            $plan_nuevo->moneda, 
            $response->token, 
            $this->tipo_tarjeta, 
            $persona->persona_nombre." ".$persona->persona_apellidos,
            $this->nombre_tarjeta,
            $persona->persona_telefono, 
            $persona->persona_telefono,
            $persona->persona_doc,
            $persona->persona_doc,
            $plan_nuevo->valor);
            if($response_pago){
                $transaccion=new Transaccion;
                $transaccion->transactionIdPayu=$response_pago->transactionResponse->transactionId;
                $transaccion->concepto="Pago de suscripción ".$plan_nuevo->plan_nombre.", codigo: ".$plan_nuevo->plan_code;
                $transaccion->valor=$plan_nuevo->valor;
                $transaccion->responseCode=$response_pago->transactionResponse->responseCode;
                $transaccion->code=$response_pago->code;
                $transaccion->estado=$response_pago->transactionResponse->state;
                $transaccion->json= json_encode($response_pago);
                $transaccion->id_usuario=$usuario->id_usuario;
                $transaccion->id_pador_payu=$usuario->id_cliente_payu;
                $usuario->ultima_transaccion=$response_pago->transactionResponse->transactionId;
                $usuario->save();
                $transaccion->save();
                if($response_pago->transactionResponse->state=="PENDING" || $response_pago->transactionResponse->state=="APPROVED" || $response_pago->transactionResponse->responseCode=="DECLINED_TEST_MODE_NOT_ALLOWED") {
                    $dias_trial="0";
                    if($plan_nuevo->periodo_plan=='MONTH'){
                        $dias_trial="30";
                    }else if($plan_nuevo->periodo_plan=='YEAR'){
                        $dias_trial="365";
                    }
                    $response2= $pago->suscripcionCompleta($this->plan, $usuario->id_cliente_payu, $usuario->id_tarjeta , $dias_trial , "12");
                    if( $response2){
                            $usuario->usuario_activo=1;// cambiar para activar usuario =1
                            $usuario->id_suscripcion=$response2->id;
                            $usuario->codigo_plan=$this->plan;
                            $usuario->codigo_registro="";
                            $usuario->estado_pago = $response_pago->transactionResponse->state;
                            $usuario->fecha_suscripcion=date("Y-m-d H:i:s");
                            if($usuario->save()){
                                Yii::import('ext.yii-mail-master.YiiMailMessage');
                                $message = new YiiMailMessage;
                                $message->view = "bienvenida";
                                $message->setSubject("Bienvenido");
                                $message->setBody( 
                                array("usuario"=>$persona->persona_correo), 'text/html');   
                                $message->addTo($persona->persona_correo);
                                $message->from = Yii::app()->params['adminEmail'];
                                Yii::app()->mail->send($message);
                               return true;
                            }
                    }
                }else if(($response_pago->transactionResponse->state=="INVALID_CARD" || $response_pago->transactionResponse->state=="DECLINED")  ){
                    $this->msg_error= ($response_pago->transactionResponse->state=="INVALID_CARD") ? 'Tarjeta invalida. ':'Transacción declinada. Verifique la tarjeta.';
                
                    return false;
                

            }else if($response_pago->transactionResponse->responseCode=="DECLINED_TEST_MODE_NOT_ALLOWED" ) {
                    $this->msg_error= 'Transacción invalida payu en pruebas.';
                    
                    return false;
            }

            }else{
                return false;
            }

        }else{
            return false;
        }
     }
  }





}