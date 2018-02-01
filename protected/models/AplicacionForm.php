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

    public $imagen_splash="";
    public $imagen_icon="";
    public $icon_interno="";



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

    const STATUS_DRAFT=1;
	const STATUS_PUBLISHED=2;
	const STATUS_ARCHIVED=3;

	private $_oldTags;


            public function rules()
            {
             
                return [
                    ['nombre, id_plantilla, color_icon', 'required', 'message' => 'Campo requerido'],
                    ["login_activo, login_facebook, facebook, twitter, instagram, nombre_activo, apellido_activo, nombre_usuario_activo,  politicas_privacidad_activo,
                    politicas_privacidad_activo, celular_activo,modulo_viral, genero, rango_edad "  , "boolean"],
                    ['nombre', 'match', 'pattern' => "/^.{5,20}$/", 'message' => 'Mínimo 3 y máximo 20 caracteres'],
                    ['color', 'match', 'pattern' => "/^.{7,30}$/", 'message' => 'No es un color valido'],
                    ['imageFile', 'file','types'=>'jpg, jpeg, png, PNG, JPEG, JPG', 'maxSize'=>1024 * 1024 * 100,'allowEmpty'=>true, 'on'=>'update','message' => 'No es una imagen']
                    
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
               
//var_dump("swiqhwbdiqbduyhbqwhybq");die;

                 /* $S3_BUCKET = 'meew/Imagenes/'.Yii::app()->user->getState('id_usuario');
                  
                  $s3file='http://s3.amazonaws.com/'.$S3_BUCKET.'/'.$fileName;
                  
                  $consulta_key = Yii::app()->db->createCommand($sql1)->queryAll();
                  $sql2 = "select codigo, nombre from parametros b where  b.tipo='s3_credential' and b.codigo=2";
      
                  $consulta_key_s = Yii::app()->db->createCommand($sql2)->queryAll();
                  $S3_KEY = $consulta_key[0]['nombre'];
                  $S3_SECRET = $consulta_key_s[0]['nombre'];
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

                          $imagen= $s3file;*/
                    



                
            

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
                    $table_aplicacion->imagen_splash=$this->imagen_splash;
                    $table_aplicacion->imagen_icon=$this->imagen_icon;
                    $table_aplicacion->icon_interno=$this->icon_interno;
                    $aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
                    //validacion para creacion o actualizacion de tabla
                    if(is_object($aplicacionFromDb) && isset($aplicacionFromDb->nombre)){
                       
                        if($table_aplicacion->save()){
                        $uploadedFile=CUploadedFile::getInstance($this,'imageFile');
                      
                          if(isset($uploadedFile)){  
                            $fileName = "fondo-".$table_aplicacion->idaplicacion.".".$uploadedFile->getExtensionName(); 
                        
                            // random number + file name
                            $uploadedFile->saveAs(dirname (Yii::app()->request->scriptFile).'/uploads/'.$fileName);
                            $imagen='/uploads/'.$fileName;
                            $table_aplicacion->url_fondo=$imagen;
                            $table_aplicacion->save();

                          } 
                        }



                         return true;
                    }else{ 
                        if($table_aplicacion->insert()){
                            $uploadedFile=CUploadedFile::getInstance($this,'imageFile');
                            if(isset($uploadedFile)){  
                              $fileName = "fondo-".$table_aplicacion->idaplicacion.".".$uploadedFile->getExtensionName();  // random number + file name
                              $uploadedFile->saveAs(dirname (Yii::app()->request->scriptFile).'/uploads/'.$fileName);
                              $imagen='/uploads/'.$fileName;
                              $table_aplicacion->url_fondo=$imagen;
                              $table_aplicacion->save();
                            } 
                            return true;
                        }
                    }
                    $table_aplicacion=null;
                    return true;
            }
            
                    
           

        



            
           
}


            

