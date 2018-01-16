<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class AplicacionForm extends CFormModel
{
    
    public $nombre="";
    public $color="";
    public $color_icon="";
    
    public $url_fondo="";
    public $login_activo;
    public $login_facebook;
    public $modulo_viral;
    
    public $facebook;
    public $twitter;
    public $instagram;
    public $usuario_id_usuario;
    public $id_plantilla;
    public $estado_app;
    public $imageFile;
    public $nombre_activo;
    public $apellido_activo;
    public $nombre_usuario_activo;
    public $politicas_privacidad_activo;
    public $celular_activo;
    public $genero;
    public $rango_edad;
    public $aplicacion_existe=false;
    public $campos_existe=false;
    public $idaplicacion;
    public $idcampos_registro;
    
    
            public function rules()
            {
             
                return [
                    ['nombre, id_plantilla, color_icon', 'required', 'message' => 'Campo requerido'],
                    ["login_activo, login_facebook, facebook, twitter, instagram, nombre_activo, apellido_activo, nombre_usuario_activo,  politicas_privacidad_activo,
                    politicas_privacidad_activo, celular_activo,modulo_viral, genero, rango_edad "  , "boolean"],
                    ['nombre', 'match', 'pattern' => "/^.{5,20}$/", 'message' => 'Mínimo 3 y máximo 20 caracteres'],
                    ['color', 'match', 'pattern' => "/^.{7,30}$/", 'message' => 'No es un color valido'],
                    ['imageFile', 'file','types'=>'jpg, jpeg, png', 'maxSize'=>1024 * 1024 * 50,'allowEmpty'=>true, 'on'=>'update','message' => 'No es una imagen']
                    
                ];
            
            }
            public function attributeLabels()
            {
             return [
              'file' => 'Seleccionar archivos:',
             ];
            }

           public function uploadS3(){



          }


            public function guardar()
            {

                $imagen="";
                $rnd = rand(0,9999);  // generate random number between 0-9999
            
                $uploadedFile=CUploadedFile::getInstance($this,'imageFile');
                if(isset($uploadedFile)){  
  
                  $tmp = $uploadedFile->tempName;
  
                  $fileName = "fondo-".Yii::app()->user->getState('id_usuario');  // random number + file name
                  
                  $S3_BUCKET = 'meew/Imagenes/'.Yii::app()->user->getState('id_usuario');
                  
                  $s3file='http://s3.amazonaws.com/'.$S3_BUCKET.'/'.$fileName;
                  
                  $S3_KEY = 'AKIAI77TVSZ7KWTFPWMQ';
                  $S3_SECRET = '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';
                
                  $S3_URL = 'http://s3.amazonaws.com/';
         
                  // expiration date of query
                        $s3 = new A2S3(array(
                                      'key'    => $S3_KEY,
                                      'secret' => $S3_SECRET));
  
                          $s3->putObject(array(
                              'Bucket' => $S3_BUCKET,
                              'Key'    => $fileName,
                              'SourceFile'=>$tmp,
                              'ACL'    => 'public-read',
                              'x-amz-storage-class' => 'REDUCED_REDUNDANCY',
                          ));

                          $imagen= $s3file;
                }
            

                 $table_aplicacion = new Aplicacion;
                
                 $aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
                 //validacion para creacion o actualizacion de tabla
                 if(is_object($aplicacionFromDb) && isset($aplicacionFromDb->nombre)){
                    $aplicacion_existe=true;
                    $table_aplicacion =  $aplicacionFromDb;
                    $idaplicacion = $table_aplicacion->idaplicacion;
                  
                 }else{
                    $table_aplicacion->usuario_id_usuario=Yii::app()->user->getState('id_usuario');
                    $table_aplicacion->estado_app=1; //estado de configuracion de plantilla
                    
                 }
                // var_dump(Yii::app()->user->getState('id_usuario'));
                 //var_dump(json_encode($camposFromDb));die;
                
                    $table_aplicacion->nombre=$this->nombre;
                    $table_aplicacion->color=$this->color;
                    if($imagen!==""){
                       $table_aplicacion->url_fondo=$imagen;
                    }
                    $table_aplicacion->login_activo = $this->login_activo;
                    $table_aplicacion->instagram=$this->instagram;

                    $table_aplicacion->login_facebook=$this->login_facebook;
                    $table_aplicacion->facebook=$this->facebook;
                    $table_aplicacion->twitter=$this->twitter;
                    $table_aplicacion->id_plantilla= $this->id_plantilla;
                    $table_aplicacion->nombre_activo=$this->nombre_activo;
                    $table_aplicacion->apellido_activo=$this->apellido_activo;
                    $table_aplicacion->nombre_usuario_activo=$this->nombre_usuario_activo;
                    $table_aplicacion->politicas_privacidad_activo=$this->politicas_privacidad_activo;
                    $table_aplicacion->celular_activo=$this->celular_activo;
                    $table_aplicacion->modulo_viral=$this->modulo_viral;
                    $table_aplicacion->color_icon=$this->color_icon;
                    $table_aplicacion->genero=$this->genero;
                    $table_aplicacion->rango_edad=$this->rango_edad;
                    $aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
                    //validacion para creacion o actualizacion de tabla
                    if(is_object($aplicacionFromDb) && isset($aplicacionFromDb->nombre)){
                  
                         $table_aplicacion->update(); 
                         return true;
                    }else{ 
                        if($table_aplicacion->insert()){
                            return true;
                        }
                    }
                    $table_aplicacion=null;
                    return true;
            }
            
                    
               
           
}


            

