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

  

  public function validate_plan($attribute, $params)
  {

      $model=$this->loadModel(Yii::app()->user->getState('id_usuario'));
      if($model->codigo_plan!=$this->plan ){
        $plan_antiguo=Plan::model()->find("plan_code='".$model->codigo_plan."'");
        $plan_nuevo=Plan::model()->find("plan_code='".$this->plan."'");
        $pago=new Pago;
        $info_pago=$pago->consulta_id($model->id_cliente_payu);
        $currentPeriodStart =$info_pago->subscriptions[0]->currentPeriodStart;
        $currentPeriodEnd =$info_pago->subscriptions[0]->currentPeriodEnd;
        $dias	= (strtotime($currentPeriodEnd)-strtotime($currentPeriodStart))/86400;
        $dias 	= abs($dias); 
        $dias = floor($dias);		
      
            if($plan_antiguo->periodo_plan=="MONTH" && $plan_nuevo->periodo_plan=="MONTH"){
                   if($dias>15 && $plan_nuevo->valor>$plan_antiguo->valor){
                      $valor= $plan_nuevo->valor - (($plan_antiguo->valor)/30)*$dias;
                      
                      $this->addError("plan", "El cambio de plan tiene un costo de ".$valor.".");
   

                   }else{
                      /// si el cambio se realiza a menos de 15 dias se dan los dias de trial y se cambia el plan dejando el cobro para despues
                      $this->addError("plan", "El cambio de plan se cobrara despues de la fecha  ".$currentPeriodEnd);
   
                    }
            }else if($plan_antiguo->periodo_plan=="YEAR" && $plan_nuevo->periodo_plan=="YEAR"){
               
                if($plan_nuevo->valor>$plan_antiguo->valor){
                   $valor= $plan_nuevo->valor - ($plan_antiguo->valor/365)*$dias;
                   $this->addError("plan", "El cambio de plan tiene un costo de ".$valor.".");
                }else{
                    $this->addError("plan", "Este cambio no se puede realizar hasta terminar el periodo.");
                }
            
            }else if($plan_antiguo->periodo_plan=="MONTH" && $plan_nuevo->periodo_plan=="YEAR"){
                $valor= $plan_nuevo->valor;
                $this->addError("plan", "El cambio de plan tiene un costo de ".$valor.".");
   
            }

        return false;
      }

      return false;
  }

  public function loadModel($id)
  {
      $model=Usuario::model()->findByPk($id);
      if($model===null)
          throw new CHttpException(404,'The requested page does not exist.');
      return $model;
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
                        if($plan_antiguo->periodo_plan=="YEAR" && $plan_nuevo->periodo_plan=="MONTH"){
                          return true;  
                        }else{
                          return $this->cambiar_plan($usuario, $persona);
                        }
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
                    return $this->cambiar_plan($usuario, $persona);
                }else{
                    return false;
                }
        }
    }else{
    return false;
   } 


  }






  function cambiar_plan($usuario, $persona){

    $model=$this->loadModel(Yii::app()->user->getState('id_usuario'));
            if($model->codigo_plan!=$this->plan ){
                $plan_antiguo=Plan::model()->find("plan_code='".$model->codigo_plan."'");
                $plan_nuevo=Plan::model()->find("plan_code='".$this->plan."'");
                $valor= 0;
                $pago=new Pago;
                $info_pago=$pago->consulta_id($model->id_cliente_payu);
                $currentPeriodStart =$info_pago->subscriptions[0]->currentPeriodStart;
                $currentPeriodEnd =$info_pago->subscriptions[0]->currentPeriodEnd;
                $dias	= (strtotime($currentPeriodEnd)-strtotime($currentPeriodStart))/86400;
                $dias 	= abs($dias); 
                $dias = floor($dias);		
              
                    if($plan_antiguo->periodo_plan=="MONTH" && $plan_nuevo->periodo_plan=="MONTH"){
                           if($dias>15 && $plan_nuevo->valor>$plan_antiguo->valor){
                              $valor= $plan_nuevo->valor - (($plan_antiguo->valor)/30)*$dias;
                              return $this->pago_plan($usuario,$persona,$dias,$valor);
                           }else{
                              /// si el cambio se realiza a menos de 15 dias se dan los dias de trial y se cambia le plan dejando el cobro para despues
                              $response2= $pago->suscripcionCompleta($this->plan, $usuario->id_cliente_payu, $usuario->id_tarjeta , $dias , "12");
                              if( $response2){
                                    $usuario->id_suscripcion=$response2->id;
                                    $usuario->codigo_plan=$this->plan;
                                    $usuario->fecha_suscripcion=date("Y-m-d H:i:s");
                                    if($usuario->save()){
                                        return true;
                                    }
                              }
                            }
                    }else if($plan_antiguo->periodo_plan=="YEAR" && $plan_nuevo->periodo_plan=="YEAR"){
                       
                        if($plan_nuevo->valor>$plan_antiguo->valor){
                           $valor= $plan_nuevo->valor - ($plan_antiguo->valor/365)*$dias;
                           return $this->pago_plan($usuario,$persona,$dias,$valor);
                        }else{
                           return true;
                        }
                    
                    }else if($plan_antiguo->periodo_plan=="MONTH" && $plan_nuevo->periodo_plan=="YEAR"){
                        $valor= $plan_nuevo->valor;
                        return $this->pago_plan($usuario,$persona,$dias,$valor);

                    }
        }
  }

  function pago_plan($usuario, $persona, $dias_trial, $valor){

    $valor=abs($valor); 
    $valor = floor($valor);
    
    $pago=new Pago;
    $plan_nuevo=Plan::model()->find("plan_code='".$this->plan."'");
    $referencia = rand(0,99999999999);
    $response_pago= $pago->cobro_individual(
        $usuario->id_cliente_payu,
        $referencia,
        $persona->persona_nombre." ".$persona->persona_apellidos,
        $persona->persona_correo,
        "Pago cambio de suscripción ".$plan_nuevo->plan_nombre ,
        $plan_nuevo->moneda, 
        $usuario->id_tarjeta, 
        $this->tipo_tarjeta, 
        $persona->persona_nombre." ".$persona->persona_apellidos,
        $this->nombre_tarjeta,
        $persona->persona_telefono, 
        $persona->persona_telefono,
        $persona->persona_doc,
        $persona->persona_doc,
        $valor);
            if($response_pago){
                $transaccion=new Transaccion;
                $transaccion->transactionIdPayu=$response_pago->transactionResponse->transactionId;
                $transaccion->concepto="Pago camobio de suscripción  ".$plan_nuevo->plan_nombre.", codigo: ".$plan_nuevo->plan_code;
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
                
                    $response2= $pago->suscripcionCompleta($this->plan, $usuario->id_cliente_payu, $usuario->id_tarjeta , $dias_trial , "12");
                    if( $response2){
                            $usuario->usuario_activo=1;// cambiar para activar usuario =1
                            $usuario->id_suscripcion=$response2->id;
                            $usuario->codigo_plan=$this->plan;
                            $usuario->codigo_registro="";
                            $usuario->estado_pago = $response_pago->transactionResponse->state;
                            $usuario->fecha_suscripcion=date("Y-m-d H:i:s");
                            if($usuario->save()){
                              
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

  }




}