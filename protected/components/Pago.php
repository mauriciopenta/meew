<?php
    class Pago
    {


        public $urlPayments="";
        public $urlReports="";
        public $urlSubscriptions="";
        public $urlsTest =false;
        public $isTest =false;
        public $acceso_api;
        //urls prueba sandbox
/*
     public $urlPayments="https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi";
     public $urlReports="https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi";
     public $urlSubscriptions="https://sandbox.api.payulatam.com/payments-api/rest/v4.3/";
 */
   


     function init(){


         if($this->urlsTest){
            $this->urlPayments="https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi";
            $this->urlReports="https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi";
            $this->urlSubscriptions="https://sandbox.api.payulatam.com/payments-api/rest/v4.3/";
         }else{
            $this->urlPayments="https://api.payulatam.com/payments-api/4.0/service.cgi";
            $this->urlReports="https://api.payulatam.com/reports-api/4.0/service.cgi";
            $this->urlSubscriptions="https://api.payulatam.com/payments-api/rest/v4.3/";
         }
        $pay = dirname (Yii::app()->request->scriptFile) . '/protected/extensions/lib/PayU.php';
        require_once($pay);
        
        if($this->isTest){
            $this->acceso_api=  Api::model()->findByAttributes(array("tipo"=>'payu_prueba'));

          

        }else{
            $this->acceso_api=  Api::model()->findByAttributes(array("tipo"=>'payu'));
        }


        PayU::$language = SupportedLanguages::ES; //Seleccione el idioma.
        PayU::$isTest = $this->isTest; //Dejarlo True cuando sean pruebas.
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
				PayUParameters::PLAN_INTERVAL_COUNT => "1",
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

           // var_dump($parameters);die;
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
            $suscripcion=$response->subscriptions;
        
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
            return  json_encode( $suscripcion);
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
    function suscripcionCompleta($plan_code, $id_usuario, $token, $dias_de_prueba ,$cuotas){
        $this->init(); 

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
            PayUParameters::INSTALLMENTS_NUMBER => $cuotas


        );
         //retorna SUBSCRIPTION_ID = $response->id;
        $response = PayUSubscriptions::createSubscription($parameters);
        return $response;
    }



    function eliminar_suscripcion($id_suscripcion){
        $this->init(); 

        $parameters = array(
            // Ingresa aquí el ID de la suscripción.
            PayUParameters::SUBSCRIPTION_ID => $id_suscripcion,
        );
        
        $response = PayUSubscriptions::cancel($parameters);
       
        return $response;
    } 
 


    function crear_cargo_adicional($descripcion, $valor, $moneda, $suscripcion, $impuesto, $base_devolucion ){
        $this->init(); 

        $parameters = array(
            //Descripción del item
            PayUParameters::DESCRIPTION => $descripcion,
            //Valor del item
            PayUParameters::ITEM_VALUE => $valor,
            //Moneda
            PayUParameters::CURRENCY => $moneda,
            //Identificador de la subscripción
            PayUParameters::SUBSCRIPTION_ID => $suscripcion,
            //Impuestos - opcional
            PayUParameters::ITEM_TAX => $impuesto,
            //Base de devolución - opcional
            PayUParameters::ITEM_TAX_RETURN_BASE => $base_devolucion,
        );
        //id
        $response = PayURecurringBillItem::create($parameters);

        
        return $response;
    } 



    function actualizar_cargo_adicional($id_pago, $descripcion, $valor, $moneda, $impuesto, $base_devolucion ){
        $this->init(); 

        $parameters = array(
            PayUParameters::RECURRING_BILL_ITEM_ID => $id_pago,
            //Descripción del item
            PayUParameters::DESCRIPTION => $descripcion,
            //Valor del item
            PayUParameters::ITEM_VALUE => $valor,
            //Moneda
            PayUParameters::CURRENCY => $moneda,
            //Impuestos - opcional
            PayUParameters::ITEM_TAX => $impuesto,
            //Base de devolución - opcional
            PayUParameters::ITEM_TAX_RETURN_BASE => $base_devolucion,
        );
        //id
        $response = PayURecurringBillItem::create($parameters);

        
        return $response;
    } 


    function consultar_cargo_adicional($id_pago){
        $this->init(); 

        $parameters = array(
            //Identificador del cargo extra
            PayUParameters::RECURRING_BILL_ITEM_ID => $id_pago,
        );
        $response = PayURecurringBillItem::find($parameters);
        return $response;
    }

    function eliminar_cargo_adicional($id_pago){
        $this->init(); 

        $parameters = array(
            //Identificador del cargo extra
            PayUParameters::RECURRING_BILL_ITEM_ID => $id_pago,
        );
        
        $response = PayURecurringBillItem::delete($parameters);
        return $response;
    }


    function consulta_id($id_pagador){
        $this->init(); 

        $parameters = array(
            // Ingresa aquí el nombre del cliente
            PayUParameters::CUSTOMER_ID => $id_pagador,
        );
        $response = PayUCustomers::find($parameters);

      
         return $response;

    }

    function cobro_individual($id_account,
    $reference,
    $nombre,
    $correo,
    $descripcion,
    $moneda, 
    $token, 
    $metodo, 
    $nombre_comprador, 
    $nombre_pagador,
    $telefono_comprador, 
    $telefono_pagador,
    $documento_comprador,
    $documento_pagador,
    $value){

        $this->init(); 
        $ip=$this->get_client_ip_server();
        session_start();    
      
        $parameters = array(
            //Ingrese aquí el identificador de la cuenta.
            PayUParameters::ACCOUNT_ID => $this->acceso_api->cuenta,
            //Ingrese aquí el código de referencia.
            PayUParameters::REFERENCE_CODE => $reference,
            //Ingrese aquí la descripción.
            PayUParameters::DESCRIPTION => $descripcion,
            
            // -- Valores --
            //Ingrese aquí el valor.        
            PayUParameters::VALUE => $value,
            //Ingrese aquí la moneda.
            PayUParameters::CURRENCY => $moneda,
            

            // -- Comprador 
            //Ingrese aquí el nombre del comprador.
            PayUParameters::BUYER_NAME => $nombre_comprador,
            //Ingrese aquí el email del comprador.
            PayUParameters::BUYER_EMAIL => $correo,
            //Ingrese aquí el teléfono de contacto del comprador.
            PayUParameters::BUYER_CONTACT_PHONE => $telefono_comprador,
            //Ingrese aquí el documento de contacto del comprador.
            PayUParameters::BUYER_DNI => $documento_comprador,
            //Ingrese aquí la dirección del comprador.
            PayUParameters::BUYER_STREET => "calle 100",
            PayUParameters::BUYER_STREET_2 => "5555487",
            PayUParameters::BUYER_CITY => "Medellin",
            PayUParameters::BUYER_STATE => "Antioquia",
            PayUParameters::BUYER_COUNTRY => "CO",
            PayUParameters::BUYER_POSTAL_CODE => "000000",
            PayUParameters::BUYER_PHONE => $telefono_comprador,
            
            // -- pagador --
            //Ingrese aquí el nombre del pagador.
            PayUParameters::PAYER_NAME => $nombre_pagador,
            //Ingrese aquí el email del pagador.
            PayUParameters::PAYER_EMAIL => $correo,
            //Ingrese aquí el teléfono de contacto del pagador.
            PayUParameters::PAYER_CONTACT_PHONE => $telefono_pagador,
            //Ingrese aquí el documento de contacto del pagador.
            PayUParameters::PAYER_DNI => $documento_pagador,
            //Ingrese aquí la dirección del pagador.
          
            
            PayUParameters::PAYER_PHONE => $telefono_pagador,
            
            PayUParameters::PAYER_ID => $id_account,
            //DATOS DEL TOKEN
            PayUParameters::TOKEN_ID => $token,
            
            //Ingrese aquí el nombre de la tarjeta de crédito
            //VISA||MASTERCARD||AMEX||DINERS
            PayUParameters::PAYMENT_METHOD => $metodo,
            
            //Ingrese aquí el número de cuotas.
            PayUParameters::INSTALLMENTS_NUMBER => "12",
            //Ingrese aquí el nombre del pais.
            PayUParameters::COUNTRY => PayUCountries::CO,
            
            //Session id del device.
            PayUParameters::DEVICE_SESSION_ID => session_id(),
            //IP del pagadador
            PayUParameters::IP_ADDRESS => getHostByName(getHostName()),
            //Cookie de la sesión actual.
            PayUParameters::PAYER_COOKIE => session_id(),
            //Cookie de la sesión actual.        
            PayUParameters::USER_AGENT=>"Mozilla/5.0 (Windows NT 5.1; rv:18.0) Gecko/20100101 Firefox/18.0"
      
        );
  
        // var_dump($parameters);die;
        $response = PayUPayments::doAuthorizationAndCapture($parameters);
        return $response;
    }
   



    function get_client_ip_server() {
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
     
        return $ipaddress;
    }




}


  /*
     logica de pagos 


     Cambio de suscripcion
     
     Modificar la suscripcion 
     
     si el pagador ya lleva 15 dias y creo una nueva suscripcion con los dias de prueba
     
     Payu cargo adicional para el siguiente cargo, cada uno de los pagadores con un plan.

     * Elimino la suscripcion y la creo con el periodo de gracia y el adicional
     lo cobro con pago indibidual de tokenizacion.

     * Debes consultar el pago 


     * Consulta de orden por identificador

Guardar informacion

  id_pagador 
  id_token (tarjeta)
  id_suscripcion
  id_plan
  





  
  
  
  */