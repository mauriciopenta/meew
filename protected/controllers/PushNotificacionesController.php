<?php

class PushNotificacionesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
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

       // var_dump(json_encode($_POST));die;
		

		

		$model=new PushNotificaciones;
	   
		$model_usuario=new Usuario('search');
		$model_usuario->unsetAttributes();
		
		$modeloUsuario=new Usuario();
		$modeloPersona=new Persona();
		$conditions="";
		$params=array();
		$conditions.="id_aplicacion=:id_aplicacion";
		$aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
		$params[':id_aplicacion']=$aplicacionFromDb->idaplicacion;

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

			//if($model->save())
			//$this->redirect(array('view','id'=>$model->idpush_notificaciones));
			$aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
		
			$model->id_aplicacion =$aplicacionFromDb->idaplicacion;
		
		
		  


		   if($_POST['yt1']=='Enviar'){
			
			if($model->validate() && $model->save()){
				$destino="";

				if($model->genero!=""){

					$destino.=$genero[$model->genero];
					
				}
				
				if($model->edad!=""){
					
					$destino.=$edades[$model->edad];
				}

				if($destino==""){
					$destino="all";
				}
				$push=new Push;
			//	$push.print("fefesfew");

				$push_parametros= PushParametros::model()->find('id_aplicacion='.$aplicacionFromDb->idaplicacion);
				$return=$push->send_push($push_parametros->restricted_package_name, $push_parametros->key, $model->titulo ,$model->cuerpo ,  $model->id_modulo , $destino );
				
				$this->redirect(array('view','id'=>$model->idpush_notificaciones));
			 }
			 

		   }else{
			

		
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


	

		$this->render('create',array(
			'model'=>$model,
			"modeloUsuario"=>$modeloUsuario,
            "modeloPersona"=>$modeloPersona,
            "personas"=>$personas,
			"dataTipoLogin"=>$dataTipoLogin,
			"genero"=>$genero,
			"edades"=> $edades
		));
	}







	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PushNotificaciones']))
		{
			$model->attributes=$_POST['PushNotificaciones'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idpush_notificaciones));
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
		$dataProvider=new CActiveDataProvider('PushNotificaciones');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PushNotificaciones('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PushNotificaciones']))
			$model->attributes=$_GET['PushNotificaciones'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PushNotificaciones the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PushNotificaciones::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PushNotificaciones $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='push-notificaciones-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
