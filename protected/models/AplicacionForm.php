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
    public $url_fondo="";
    public $login_activo;
    public $login_facebook;
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
    public $aplicacion_existe=false;
    public $campos_existe=false;
    public $idaplicacion;
    public $idcampos_registro;
    
    
            public function rules()
            {
             
                return [
                    ['nombre, id_plantilla', 'required', 'message' => 'Campo requerido'],
                    ["login_activo, login_facebook, facebook, twitter, instagram, nombre_activo, apellido_activo, nombre_usuario_activo,  politicas_privacidad_activo,
                    politicas_privacidad_activo, celular_activo"  , "boolean"],
                    ['nombre', 'match', 'pattern' => "/^.{5,20}$/", 'message' => 'Mínimo 3 y máximo 20 caracteres'],
                    ['color', 'match', 'pattern' => "/^.{7}$/", 'message' => 'No es un color valido'],
                    ['imageFile', 'file','types'=>'jpg, jpeg, png', 'maxSize'=>1024 * 1024 * 50,'allowEmpty'=>true, 'on'=>'update','message' => 'No es una imagen']
                    
                ];
            
            }
            public function attributeLabels()
            {
             return [
              'file' => 'Seleccionar archivos:',
             ];
            }


            public function guardar()
            {
                $imagen="";
                 $rnd = rand(0,9999);  // generate random number between 0-9999
                 
                   $uploadedFile=CUploadedFile::getInstance($this,'imageFile');
                   if(isset($uploadedFile)){  
                   $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                   $uploadedFile->saveAs(Yii::app()->basePath.'/uploads/'.$fileName);
                   $imagen='/uploads/'.$fileName;
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


            

