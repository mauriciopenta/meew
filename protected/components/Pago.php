<?php
    class Pago
    {


     public $urlPayments="https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi";
     public $urlReports="https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi";
     public $urlSubscriptions="https://sandbox.api.payulatam.com/payments-api/rest/v4.3/";
     public $acceso_api;

     function init(){
        $pay = dirname (Yii::app()->request->scriptFile) . '/protected/extensions/lib/PayU.php';
        require_once($pay);
        $this->acceso_api=  Api::model()->findByAttributes(array("tipo"=>'payu'));
        PayU::$language = SupportedLanguages::ES; //Seleccione el idioma.
        PayU::$isTest = true; //Dejarlo True cuando sean pruebas.
        PayU::$apiKey =  $this->acceso_api->key; //Ingrese aquí su propio apiKey.
        PayU::$apiLogin =  $this->acceso_api->login; //Ingrese aquí su propio apiLogin.
        PayU::$merchantId =  $this->acceso_api->id_prod; //Ingrese aquí su Id de Comercio.

        Environment::setPaymentsCustomUrl($this->urlPayments);
        Environment::setReportsCustomUrl($this->urlReports); 
        Environment::setSubscriptionsCustomUrl($this->urlSubscriptions);
       
     }
     
     function crear_plan($nombre, $plan_code, $periodo_plan, $moneda, $valor ){

            $this->init(); 
            $parameters = array(
				// Ingresa aquí la descripción del plan
				PayUParameters::PLAN_DESCRIPTION => $nombre,
				// Ingresa aquí el código de identificación para el plan
				PayUParameters::PLAN_CODE => $plan_code,
				// Ingresa aquí el intervalo del plan
				//DAY||WEEK||MONTH||YEAR
				PayUParameters::PLAN_INTERVAL => $periodo_plan,
				// Ingresa aquí la cantidad de intervalos
				PayUParameters::PLAN_INTERVAL_COUNT => "12",
				// Ingresa aquí la moneda para el plan
				PayUParameters::PLAN_CURRENCY => $moneda,

				// Ingresa aquí el valor del plan
				PayUParameters::PLAN_VALUE => $valor,
				//(OPCIONAL) Ingresa aquí el valor del impuesto
			    //PayUParameters::PLAN_TAX => "1600",
				//(OPCIONAL) Ingresa aquí la base de devolución sobre el impuesto
			    //PayUParameters::PLAN_TAX_RETURN_BASE => "8400",
				// Ingresa aquí la cuenta Id del plan
				PayUParameters::ACCOUNT_ID => $this->acceso_api->cuenta,
				// Ingresa aquí el intervalo de reintentos
				PayUParameters::PLAN_ATTEMPTS_DELAY => "1",
				// Ingresa aquí la cantidad de cobros que componen el plan
				PayUParameters::PLAN_MAX_PAYMENTS => "12",
				// Ingresa aquí la cantidad total de reintentos para cada pago rechazado de la suscripción
				PayUParameters::PLAN_MAX_PAYMENT_ATTEMPTS => "3",
				// Ingresa aquí la cantidad máxima de pagos pendientes que puede tener una suscripción antes de ser cancelada.
				PayUParameters::PLAN_MAX_PENDING_PAYMENTS => "1",
				// Ingresa aquí la cantidad de días de prueba de la suscripción.
				PayUParameters::TRIAL_DAYS => "0"
            );
                //retorna id_plan=$response->id;
        
			$response = PayUSubscriptionPlans::create($parameters);
		    return $response;
        }




        function editar_plan($nombre, $plan_code, $moneda, $valor ){
            $this->init(); 
            
            $parameters = array(
				PayUParameters::PLAN_DESCRIPTION => $nombre,
				// Ingresa aquí el código de identificación para el plan
				PayUParameters::PLAN_CODE => $plan_code,
				// Ingresa aquí la moneda para el plan
				PayUParameters::PLAN_CURRENCY => $moneda,
				// Ingresa aquí el valor del plan
				PayUParameters::PLAN_VALUE => $valor,
			//	//(OPCIONAL) Ingresa aquí el valor del impuesto
			//	PayUParameters::PLAN_TAX => "0",
				//(OPCIONAL) Ingresa aquí la base de devolución sobre el impuesto
			//	PayUParameters::PLAN_TAX_RETURN_BASE => "0",
				// Ingresa aquí el intervalo de reintentos
				PayUParameters::PLAN_ATTEMPTS_DELAY => "1",
				// Ingresa aquí la cantidad total de reintentos para cada pago rechazado de la suscripción
				PayUParameters::PLAN_MAX_PAYMENT_ATTEMPTS => "3",
				// Ingresa aquí la cantidad máxima de pagos pendientes que puede tener una suscripción antes de ser cancelada.
				PayUParameters::PLAN_MAX_PENDING_PAYMENTS => "1",
			);
			  
			$response = PayUSubscriptionPlans::update($parameters);
            return $response;

        }
        
        
        function eliminar_plan($plan_code){
            $this->init(); 
              $parameters = array(
                // Ingresa aquí el código de identificación para el plan
                PayUParameters::PLAN_CODE => $plan_code,
            );
             $response = PayUSubscriptionPlans::delete($parameters);
             return $response;
        }

        function crear_cliente($nombre, $correo){
            $this->init(); 
            $parameters = array(
                // Ingresa aquí el nombre del cliente
                PayUParameters::CUSTOMER_NAME => $nombre,
                // Ingresa aquí el correo del cliente
                PayUParameters::CUSTOMER_EMAIL => $correo
            );

            //retorna CUSTOMER_ID=$response->id;
            $response = PayUCustomers::create($parameters);
            return $response;
        }
      
        function editar_cliente($id_cliente, $nombre, $correo){
            $this->init(); 
            $parameters = array(
                // Ingresa aquí el identificador del cliente,
                PayUParameters::CUSTOMER_ID => $id_cliente,
                // Ingresa aquí el nombre del cliente
                PayUParameters::CUSTOMER_NAME => $nombre,
                // Ingresa aquí el correo del cliente
                PayUParameters::CUSTOMER_EMAIL => $correo
            );

            $response = PayUCustomers::update($parameters);
            return $response;
        }
      

        function consultar_cliente($id_cliente){
            $this->init(); 
      

        $parameters = array(
            // Ingresa aquí el nombre del cliente
            PayUParameters::CUSTOMER_ID => $id_cliente,
        );
        $response = PayUCustomers::find($parameters);
        $creditCard=null;
        if($response) {
            $response->fullName;
            $response->email;
            $creditCards=$response->creditCards;
        
            foreach ($creditCards as $creditCard) {
                $creditCard->token;
                $creditCard->number;
                $creditCard->type;
                $creditCard->name;
                $address=$creditCard->address;
                $address->line1;
                $address->line2;
                $address->line3;
                $address->city;
                $address->state;
                $address->country;
                $address->postalCode;
                $address->phone;
            }
        }
            return  $creditCard;
        }

        function eliminar_cliente($id_cliente){
            $this->init(); 

            $parameters = array(
                // Ingresa aquí el identificador del cliente,
                PayUParameters::CUSTOMER_ID => $id_cliente
            );
            
            $response = PayUCustomers::delete($parameters);
            
            return  $response;
        }
      
        function crear_tarjeta($id_cliente, $nombre , $numero_tarjeta, $fecha_expedicion, $tipo_tarjeta, $num_documento,
        $num_doc_pago, $direccion, $tel   ){



            $this->init(); 
            $parameters = array(
                // Ingresa aquí el identificador del cliente,
                PayUParameters::CUSTOMER_ID => $id_cliente,
                // Ingresa aquí el nombre del cliente
                PayUParameters::PAYER_NAME => $nombre,
                // Ingresa aquí el número de la tarjeta de crédito
                PayUParameters::CREDIT_CARD_NUMBER => $numero_tarjeta,
                // Ingresa aquí la fecha de expiración de la tarjeta de crédito en formato AAAA/MM
                PayUParameters::CREDIT_CARD_EXPIRATION_DATE => $fecha_expedicion,
                // Ingresa aquí el nombre de la franquicia de la tarjeta de crédito
                PayUParameters::PAYMENT_METHOD => $tipo_tarjeta,
                    // Ingresa aquí el documento de identificación asociado a la tarjeta
                PayUParameters::CREDIT_CARD_DOCUMENT => $num_documento,
                // (OPCIONAL) Ingresa aquí el documento de identificación del pagador
               // PayUParameters::PAYER_DNI => $num_doc_pago,
                // (OPCIONAL) Ingresa aquí la primera línea de la dirección del pagador
              //  PayUParameters::PAYER_STREET => $direccion,
             //   PayUParameters::PAYER_PHONE => $tel
                // (OPCIONAL) Ingresa aquí la segunda línea de la dirección del pagador
             /*   PayUParameters::PAYER_STREET_2 => "17 25",
                // (OPCIONAL) Ingresa aquí la tercera línea de la dirección del pagador
                PayUParameters::PAYER_STREET_3 => "Office 301",
                // (OPCIONAL) Ingresa aquí la ciudad de la dirección del pagador
                PayUParameters::PAYER_CITY => "Bogotá",
                // (OPCIONAL) Ingresa aquí el estado o departamento de la dirección del pagador
                PayUParameters::PAYER_STATE => "Bogotá D.C.",
                // (OPCIONAL) Ingresa aquí el código del país de la dirección del pagador
                PayUParameters::PAYER_COUNTRY => "CO",
                // (OPCIONAL) Ingresa aquí el código postal de la dirección del pagador
                PayUParameters::PAYER_POSTAL_CODE => "00000",
                // (OPCIONAL) Ingresa aquí el número telefónico del pagador
                PayUParameters::PAYER_PHONE => "300300300"*/
            );
               //retorna TOKEN_ID = $response->token;
            $response = PayUCreditCards::create($parameters);
            return  $response;
            
        }
      
      
      
        function editar_tarjeta($token,  $id_cliente, $nombre , $numero_tarjeta, $fecha_expedicion,$tipo_tarjeta,$num_documento,
        $num_doc_pago, $direccion, $tel ){
            $this->init(); 
            $parameters = array(
                // Ingresa aquí el identificador del token de la tarjeta.
                PayUParameters::TOKEN_ID => $token,
                // Ingresa aquí el nombre del cliente
                PayUParameters::PAYER_NAME => $nombre,
                // Ingresa aquí la fecha de expiración de la tarjeta de crédito en formato AAAA/MM
                PayUParameters::CREDIT_CARD_EXPIRATION_DATE => $fecha_expedicion,
                    // Ingresa aquí el documento de identificación asociado a la tarjeta
                PayUParameters::CREDIT_CARD_DOCUMENT => $numero_tarjeta,
                // (OPCIONAL) Ingresa aquí el documento de identificación del pagador
                 // (OPCIONAL) Ingresa aquí el documento de identificación del pagador
                 PayUParameters::PAYER_DNI => $num_doc_pago,
                 // (OPCIONAL) Ingresa aquí la primera línea de la dirección del pagador
                 PayUParameters::PAYER_STREET => $direccion,
                // (OPCIONAL) Ingresa aquí el número telefónico del pagador
                 PayUParameters::PAYER_PHONE => $tel
             /*   // (OPCIONAL) Ingresa aquí la segunda línea de la dirección del pagador
                PayUParameters::PAYER_STREET_2 => "17 25",
                // (OPCIONAL) Ingresa aquí la tercera línea de la dirección del pagador
                PayUParameters::PAYER_STREET_3 => "Office 301",
                // (OPCIONAL) Ingresa aquí la ciudad de la dirección del pagador
                PayUParameters::PAYER_CITY => "Bogotá",
                // (OPCIONAL) Ingresa aquí el estado o departamento de la dirección del pagador
                PayUParameters::PAYER_STATE => "Bogotá D.C.",
                // (OPCIONAL) Ingresa aquí el código del país de la dirección del pagador
                PayUParameters::PAYER_COUNTRY => "CO",
                // (OPCIONAL) Ingresa aquí el código postal de la dirección del pagador
                PayUParameters::PAYER_POSTAL_CODE => "00000",
                // (OPCIONAL) Ingresa aquí el número telefónico del pagador
                PayUParameters::PAYER_PHONE => "300300300"*/
            );
          
            $response= PayUCreditCards::update($parameters);
            return $response;
        }
      

        function consultar_tarjeta($token){
            $this->init(); 
            $parameters = array(
                // Ingresa aquí el identificador del token de la tarjeta.
                PayUParameters::TOKEN_ID => $token
            );
            
            $response = PayUCreditCards::find($parameters);
            return $response;
        }

     
        function eliminar_tarjeta($token, $id_usuario){
            $this->init(); 
            $parameters = array(
                // Ingresa aquí el identificador del token de la tarjeta.
                PayUParameters::TOKEN_ID => $token,
                // Ingresa aquí el identificador del cliente,
                PayUParameters::CUSTOMER_ID => $id_usuario
            );
            
            $response = PayUCreditCards::delete($parameters);
            return $response;
        }


//crea todos los elementos existentes
    function suscripcionCompleta($plan_code, $id_usuario, $token,$dias_de_prueba ,$cuotas){

        $parameters = array(
            // Ingresa aquí el código del plan a suscribirse.
            PayUParameters::PLAN_CODE => $plan_code,
            // Ingresa aquí el identificador del pagador.
            PayUParameters::CUSTOMER_ID => $id_usuario,
            // Ingresa aquí el identificador del token de la tarjeta.
            PayUParameters::TOKEN_ID => $token,
            // Ingresa aquí la cantidad de días de prueba de la suscripción.
            PayUParameters::TRIAL_DAYS => $dias_de_prueba,
            // Ingresa aquí el número de cuotas a pagar.
            PayUParameters::INSTALLMENTS_NUMBER => $cuotas,

        );
         //retorna SUBSCRIPTION_ID = $response->id;
        $response = PayUSubscriptions::createSubscription($parameters);
        return $response;
    }



    function eliminar_suscripcion($id_suscripcion){
        $parameters = array(
            // Ingresa aquí el ID de la suscripción.
            PayUParameters::SUBSCRIPTION_ID => $id_suscripcion,
        );
        
        $response = PayUSubscriptions::cancel($parameters);
       
        return $response;
    } 
 



    }


  