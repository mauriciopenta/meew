<?php




class UsuarioController extends Controller{

		/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

      /**
    * Acción que se ejecuta en segunda instancia para verificar si el usuario tiene sesión activa.
    * En caso contrario no podrá acceder a los módulos del aplicativo y generará error de acceso.
    */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to access 'index' and 'view' actions.
				'actions'=>array('index','view','selectpais','home','update','usuarios','updateuser','password','registropago','Validate_plan'),
				'users'=>array('@'),
			),
            array('allow', 
            'actions' => array('admin', 'delete','userManager','update','agregar','usuarios'),
            'users' => array('admin')
            ),
            array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}



    public function filterEnforcelogin($filterChain){
        if(Yii::app()->user->isGuest){
            if(isset($_POST) && !empty($_POST)){
                $response["status"]="nosession";
                echo CJSON::encode($response);
                exit();
            }
            else{
               // Yii::app()->user->returnUrl = array("site/login");                                                          
                //$this->redirect(Yii::app()->user->returnUrl);
            }
        }
        $filterChain->run();
    }

    public function actionUserManager(){
        $modeloUsuario=new Usuario();
		$modeloPersona=new Persona();
		
        $personas=$modeloPersona->model()->findAll();
        $dataTipoLogin= TipoLogin::model()->findAll();
	  
		$this->render('userManager',array(
            "modeloUsuario"=>$modeloUsuario,
            "modeloPersona"=>$modeloPersona,
            "personas"=>$personas,
            "dataTipoLogin"=>$dataTipoLogin
        ));
    }

	public function actionHome(){
        $modeloUsuario=new Usuario();
        $modeloPersona=new Persona();
        $personas=$modeloPersona->model()->findAll();
		$dataTipoLogin= TipoLogin::model()->findAll();

		$estadistica=array();
		if(Yii::app()->user->getState('nombreRole')=="CLIENTE"){
	
		    $aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
			if($aplicacionFromDb->idaplicacion!=""){
				$sql = "select 
				SUM(CASE WHEN id_persona > 0 THEN 1 ELSE 0 END) usuarios,
				SUM(CASE WHEN id_genero = 2 THEN 1 ELSE 0 END) usuarios_hombres,
				SUM(CASE WHEN id_genero = 1 THEN 1 ELSE 0 END) usuarios_mujeres,
				SUM(CASE WHEN id_genero = 3 THEN 1 ELSE 0 END) usuarios_otro,
					SUM(CASE WHEN id_rango_edad = 1 THEN 1 ELSE 0 END) usuarios_1824,
					SUM(CASE WHEN id_rango_edad = 2 THEN 1 ELSE 0 END) usuarios_2534,
					SUM(CASE WHEN id_rango_edad = 3 THEN 1 ELSE 0 END) usuarios_3544,
					SUM(CASE WHEN id_rango_edad = 4 THEN 1 ELSE 0 END) usuarios_4554,
					SUM(CASE WHEN id_rango_edad = 5 THEN 1 ELSE 0 END) usuarios_mas
				from persona where  id_aplicacion=".$aplicacionFromDb->idaplicacion;
				$usuarios = Yii::app()->db->createCommand($sql)->queryAll();

				$sql2 = "select * from push_notificaciones where  id_aplicacion=".$aplicacionFromDb->idaplicacion;
				$notificaciones = Yii::app()->db->createCommand($sql2)->queryAll();
				$total = count($notificaciones);

				$estadistica=$usuarios[0];
				$estadistica['notificaciones']=$total;
				

			}else{
				$estadistica = array(
				"usuarios"=>"0",
				"usuarios_hombres"=>"0",
				"usuarios_mujeres"=>"0",
				"usuarios_otro"=>"0",
				"usuarios_1824"=>"0",
				"usuarios_2534"=>"0",
				"usuarios_3544"=>"0",
				"usuarios_4554"=>"0",
				"usuarios_mas"=>"0",
				"notificaciones"=>"0");
			}
			
		}else if(Yii::app()->user->getState('nombreRole')=="ADMINISTRADOR"){

			$sql_aplicaciones = "select * from aplicacion" ;
			$caplicaciones = Yii::app()->db->createCommand($sql_aplicaciones)->queryAll();
			$aplicaciones=count($caplicaciones);
			$sql_plantillas = "select p.nombre as nombre, (select count(*) from aplicacion a where a.id_plantilla=p.idplantilla) num
			from plantilla p";
			
			$plantillas = Yii::app()->db->createCommand($sql_plantillas)->queryAll();
			
			
			$sql = "select p.plan_nombre as  nombre,(select count(*) from usuario u where u.codigo_plan=plan_code) num
			 from plan p";
			$planes = Yii::app()->db->createCommand($sql)->queryAll();
        	$estadistica['plantillas']=$plantillas;
        	$estadistica['planes']=$planes;
			$estadistica['aplicaciones']=$aplicaciones;
			
		}


		//var_dump($estadistica);die;
		
		$this->render('home',array(
			"modeloUsuario"=>$modeloUsuario,
			"modeloPersona"=>$modeloPersona,
			"personas"=>$personas,
			"dataTipoLogin"=>$dataTipoLogin,
			"estadistica"=> $estadistica,
			
		));


    }




	public function actionValidate_plan($code)
	{
  
		$model=$this->loadModel(Yii::app()->user->getState('id_usuario'));
		if($model->codigo_plan!=$code ){
		  $plan_antiguo=Plan::model()->find("plan_code='".$model->codigo_plan."'");
		  $plan_nuevo=Plan::model()->find("plan_code='".$code."'");
	
		  $pago=new Pago;
		  $info_pago=$pago->consulta_id($model->id_cliente_payu);
			
		  $currentPeriodStart =$info_pago->subscriptions[0]->currentPeriodStart;
		  $currentPeriodEnd =$info_pago->subscriptions[0]->currentPeriodEnd;
		  $dias	= (strtotime($currentPeriodEnd)-strtotime($currentPeriodStart))/86400;
		  $dias = abs($dias); 
		  $dias = floor($dias);		
		  header('Content-type: application/json');
			  if($plan_antiguo->periodo_plan=="MONTH" && $plan_nuevo->periodo_plan=="MONTH"){
			

				
					 if($dias > 15 && $plan_nuevo->valor > $plan_antiguo->valor){
						
						$valor= $plan_nuevo->valor - (($plan_antiguo->valor)/30)*$dias;
						$valor = abs($valor); 
						$valor = floor($valor);		
					 	echo CJSON::encode( array("response"=> "El cambio de plan tiene un costo de $".$valor."."));die;
					
					 }else{
						$date = new DateTime($currentPeriodEnd);
						
						/// si el cambio se realiza a menos de 15 dias se dan los dias de trial y se cambia el plan dejando el cobro para despues
						echo CJSON::encode(array("response"=>"El cambio de plan se cobrara despues del ".date_format($date, 'd M Y')));die;
					  }
			  }else if($plan_antiguo->periodo_plan=="YEAR" && $plan_nuevo->periodo_plan=="YEAR"){
			
				  if($plan_nuevo->valor>$plan_antiguo->valor){
					 $valor= $plan_nuevo->valor - ($plan_antiguo->valor/365)*$dias;
					 $valor = abs($valor); 
					 $valor = floor($valor);		
				  
					 echo CJSON::encode( array("response"=>"El cambio de plan tiene un costo de $".$valor."."));die;
			
				  }else{
					  
					echo CJSON::encode( array("response"=>"Este cambio no se puede realizar hasta terminar el periodo."));die;
				  }
			  }else if($plan_antiguo->periodo_plan=="MONTH" && $plan_nuevo->periodo_plan=="YEAR"){
				   $valor= $plan_nuevo->valor;
				   $valor = abs($valor); 
				   $valor = floor($valor);		
				
				   echo CJSON::encode( array("response"=>"El cambio de plan tiene un costo de $".$valor."."));die;
	 		  }else if($plan_antiguo->periodo_plan=="YEAR" && $plan_nuevo->periodo_plan=="MONTH"){
				   echo CJSON::encode( array("response"=>"El cambio de plan no se puede realizar."));die;
	 		  }
  
			   echo CJSON::encode( array("response"=>" "));die;
	 		
		}
  
		       echo CJSON::encode( array("response"=>" "));die;
	 		
	}


	public function actionUsuarios($genero=null, $edad=null)
	{
    	$model=new PushNotificaciones;
		$conditions="";
		$params=array();
		$model_usuario=new Usuario('search');
		$model_usuario->unsetAttributes();
		$modeloUsuario=new Usuario();
		$modeloPersona=new Persona();
		$conditions.="id_aplicacion=:id_aplicacion";
		$aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
		$params[':id_aplicacion']=$aplicacionFromDb->idaplicacion;
		if($genero!=null){
			$model->genero=$genero;
			$conditions.=" and id_genero=:id_genero";
			$params[':id_genero']=$model->genero;
		}
		
		if($edad!=null){
			$model->edad=$edad;
			$conditions.=" and id_rango_edad=:id_rango_edad";
			$params[':id_rango_edad']=$model->edad;
		}

		$consulta=array('select'=>'*',
		'condition'=> $conditions
		,'params'=> $params);
		$personas=$modeloPersona->model()->findAll($consulta);

        $dataTipoLogin= TipoLogin::model()->findAll();
		
		$sql_genero = "select codigo, nombre from parametros b where b.tipo='genero'";
						
		$consulta_genero = Yii::app()->db->createCommand($sql_genero)->queryAll();
						
		$genero=CHtml::listData($consulta_genero,'codigo','nombre');
					
		$sql_edad = "select codigo, nombre from parametros b where b.tipo='rango_edad'";
					
		$consulta_edad = Yii::app()->db->createCommand($sql_edad)->queryAll();
	
		$edades=CHtml::listData($consulta_edad,'codigo','nombre');
		if(isset($_POST['PushNotificaciones']))
		{
			$model->attributes=$_POST['PushNotificaciones'];
        	$aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
			$model->id_aplicacion =$aplicacionFromDb->idaplicacion;
		   if($_POST['yt1']!='Enviar'){
			$conditions="";   
			$conditions.="id_aplicacion=:id_aplicacion";
			if($model->genero!=""){
				$conditions.=" and id_genero=:id_genero";
				$params[':id_genero']=$model->genero;
			}
			
			if($model->edad!=""){
				$conditions.=" and id_rango_edad=:id_rango_edad";
				$params[':id_rango_edad']=$model->edad;
			}
			$consulta=array('select'=>'*',
			'condition'=> $conditions
			,'params'=> $params);
  			 $personas=$modeloPersona->model()->findAll($consulta);
			 $dataTipoLogin= TipoLogin::model()->findAll();
		   }
		}
		if(isset($_GET['Usuario']))
			$model->attributes=$_GET['Usuario'];
		$this->render('usuarios',array(
			'model'=>$model,
			"modeloUsuario"=>$modeloUsuario,
            "modeloPersona"=>$modeloPersona,
            "personas"=>$personas,
			"dataTipoLogin"=>$dataTipoLogin,
			"genero"=>$genero,
			"edades"=> $edades
		));
	}



    public function actionSort()
    {

       
        if (isset($_POST['items']) && is_array($_POST['items'])) {

            var_dump($_POST);die;
            $i = 0;
            foreach ($_POST['items'] as $item) {
               // $project = Project::model()->findByPk($item);
               // $project->sortOrder = $i;
               // $project->save();
               
               $i++;
            }
        }
    }

    
	public function actionAgregar(){
		
			$model=new RegisterForm;
		
			if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
			{
   			    print_r( CActiveForm::validate($model));
				Yii::app()->end();
			}
			// collect user input data
			if(isset($_POST['RegisterForm'])){
					$model->attributes=$_POST['RegisterForm'];
					// validate user input and redirect to the previous page if valid
					if($model->validate() && $model->register()){
						$this->redirect(array('userManager'));
					}
			}
			$this->render('agregar',array("model"=>$model));
	}


      public function actionParametrosConfig()
      {
          $model=new Parametros;
      
          // uncomment the following code to enable ajax-based validation
          /*
          if(isset($_POST['ajax']) && $_POST['ajax']==='parametros-parametrosConfig-form')
          {
              echo CActiveForm::validate($model);
              Yii::app()->end();
          }
          */
      
          if(isset($_POST['Parametros']))
          {
              $model->attributes=$_POST['Parametros'];
              if($model->validate())
              {
                  // form inputs are valid, do something here
                  return;
              }
          }
          $this->render('parametrosConfig',array('model'=>$model));
      }


    public function actionCambiaEstado(){
        $estado=Yii::app()->request->getPost("estado");
        $idpersona=Yii::app()->request->getPost("idpersona");
        $usuario=  Usuario::model()->findByAttributes(array("id_persona"=>$idpersona));
        $idUsuario=$usuario->id_usuario;
        if($usuario->updateByPk($idUsuario,array('usuario_activo'=>$estado))){
            $response["status"]="exito";
            $response["msg"]="Se ha cambiado el estado de usuario";
        }
        else{
            $response["status"]="noexito";
            $response["msg"]="Sin cambios";
        }
        echo CJSON::encode($response);
    }
    
    public function actionConsultaPersona(){
        $conn= Yii::app()->db;
        $slq="select a.*,b.usuario_activo from persona as a left join usuario as b on b.id_persona=a.id_persona where b.id_persona<>:idpersona";
        $query=$conn->createCommand($slq);
        $idSelfUsuario=Yii::app()->user->getId();
        $query->bindParam(":idpersona",$idSelfUsuario );
        $read=$query->query();
        $res=$read->readAll();
        echo CJSON::encode($res);

        
    }

    public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$model=new Usuario;
		if(isset($_POST['Usuario']))
		{
			$model->attributes=$_POST['Usuario'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_usuario));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
	
		$model=new UsuarioFormUpdate;
		if(isset($_POST['ajax']) && $_POST['ajax']==='update-form')
		{
			  	print_r( CActiveForm::validate($model));
//                        
			    Yii::app()->end();
		}

		$modelUsuario=$this->loadModel($id);  
		   
		$modelPersona=Persona::model()->findByPk($modelUsuario->id_persona);
		$model=new UsuarioFormUpdate;
		if(isset($_POST['UsuarioFormUpdate']))
		{
          //var_dump($_POST);die;
		
			 $identity=new UserIdentity($modelUsuario->usuario, $modelUsuario->password);
			 $model->attributes=$_POST['UsuarioFormUpdate'];
				if($model->save($modelUsuario,$modelPersona ))
				    $this->redirect(array('update','id'=>$model->id_usuario));
		}
		$model->id_usuario=$modelUsuario->id_usuario;
		$model->usuario=$modelUsuario->usuario;
		$model->plan=$modelUsuario->codigo_plan;
		
		$model->id_persona=$modelPersona->id_persona;
		$model->persona_nombre=$modelPersona->persona_nombre;
		$model->persona_apellidos=$modelPersona->persona_apellidos;
		$model->id_doc=$modelPersona->id_doc;
		$model->persona_doc=$modelPersona->persona_doc;
		$model->persona_correo=$modelPersona->persona_correo;
		$model->ubicacion=$modelPersona->persona_ubicacion;
		$model->region=$modelPersona->persona_ciudad;
		$model->telefono=$modelPersona->persona_telefono;

		$pago=new Pago;
		$response=$pago->consultar_tarjeta($modelUsuario->id_tarjeta);
        if($response){
			//var_dump($response);die;
		   $model->numero_tarjeta=$response->number;
		   $model->tipo_tarjeta=$response->type;
		   $model->nombre_tarjeta=$response->name;
		}

     //   var_dump($response);die;


		$paises=array();
        if($model->ubicacion!=""){

            $consulta=Ciudades::model()->findAll( array('condition'=> 'Paises_Codigo=:codigo','params'=> array(':codigo'=>$model->region)));
            $paises=CHtml::listData($consulta,'idCiudades','Ciudad');

        }
            $this->render('update',array(
                'model'=>$model,
                'paises'=>$paises
            ));
	
	}


    public function actionSelectPais() {
       
        $codigo = $_POST ['UsuarioFormEdit']['ubicacion'];

        $consulta=Ciudades::model()->findAll( array('order'=>'Ciudad asc', 'condition'=> 'Paises_Codigo=:codigo','params'=> array(':codigo'=>$codigo)));
        $ciudades=CHtml::listData($consulta,'idCiudades','Ciudad');
    
        echo CHtml::tag('option', array('value'=>''), 'Seleccione', true);

        foreach ($ciudades as $valor=>$Ciudad) {
            echo CHtml::tag('option', array('value'=>$valor), CHtml::encode($Ciudad), true);
        }
    }

	public function actionPassword($id)
	{
		$modelUsuario=$this->loadModel($id);
		$model=new PasswordForm;
		if(isset($_POST['PasswordForm']))
		{
			$model->attributes=$_POST['PasswordForm'];  
			
           if($model->validate()){
		      
          	    $identity=new UserIdentity($modelUsuario->usuario, $model->password);
				if($identity->authenticate()){
                  	$opciones = [
						'cost' => 10
					];
					$password=password_hash($model->PasswordNew, PASSWORD_BCRYPT, $opciones);
					$modelUsuario->password=$password;
					if($modelUsuario->save()){
						$this->redirect(array('update','id'=>$modelUsuario->id_usuario));
					}
				}
		   }
		}
		$this->render('formPassword',array(
			'model'=>$model
		));
	    
	}

	public function actionUpdateUser($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Usuario']))
		{
			$model->attributes=$_POST['Usuario'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_usuario));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Usuario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Usuario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuario']))
			$model->attributes=$_GET['Usuario'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Usuario the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Usuario::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}



	/**
	 * Performs the AJAX validation.
	 * @param ModuloApp $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='modulo-app-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}




}