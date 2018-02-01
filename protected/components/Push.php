<?php
    class Push
    {



    
      function send_push($package , $key, $title ,$msg ,$id_contenido , $destino )
        {
            //datos a enviar
            $data = array("notification" => "a");
            //url contra la que atacamos
            $ch = curl_init("https://fcm.googleapis.com/fcm/send");
            //a true, obtendremos una respuesta de la url, en otro caso, 
            //true si es correcto, false si no lo es
             $fields = array (
                    'restricted_package_name' => $package,
                    'notification' => array (
                            "title" => $title,
                            "body" => $msg,
                            "sound"=>"default",
                           "click_action"=>"FCM_PLUGIN_ACTIVITY",
                            
                    ),
                    "data"=> array (
                      "id"=>$id_contenido,
                       "title" => $title,
                       "body" => $msg,

                     ),
                    " priority " => "high" ,
                     "to" => "/topics/".$destino
            );
            $fields = json_encode ( $fields );
            $headers = array (
                    'Authorization: key='.$key,
                    'Content-Type: application/json'
            );
           // var_dump($fields);
            curl_setopt ( $ch, CURLOPT_POST, true );
            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

            //enviamos el array data
        //    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
            //obtenemos la respuesta
            $response = curl_exec($ch);
            
            // Se cierra el recurso CURL y se liberan los recursos del sistema
            curl_close($ch);


         // var_dump(json_encode($response));die;
            if(!$response) {
                return false;
            }else{
                return $response;
            }
        }
    }


    //$new = new CurlRequest();

    //$resultado = $new ->sendPost("mensaje prueba","contenido msg prueba",654);
    //var_dump($resultado);