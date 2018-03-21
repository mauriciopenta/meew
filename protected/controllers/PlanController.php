<?php

class PlanController extends Controller
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
				'actions'=>array('create','update'),
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
		$model= new PlanForm;
	  if(isset($_POST['PlanForm']))
		{
			//var_dump(json_encode($_POST));die;
    		$model->attributes=$_POST['PlanForm'];
			$modelplan= new Plan;
			$modelplan->plan_nombre=$model->plan_nombre;
			$modelplan->plan_codigo=$model->plan_codigo;
			$modelplan->valor_text=$model->valor_text;
			$modelplan->valor=$model->valor;
			$modelplan->moneda = $model->moneda;
		    $modelplan->mensajes_push=$model->mensajes_push;
			$modelplan->periodo_plan=$model->periodo_plan;
			$modelplan->descripcion=$model->descripcion;
			$rnd = rand(0,9999999999);
			$modelplan->plan_code="{$rnd}";
            if($model->validate()){
			  $pago=new Pago;
			  $response = $pago->crear_plan($modelplan->plan_nombre, $modelplan->plan_code, $modelplan->periodo_plan, $modelplan->moneda, $modelplan->valor );
			  if($response){
				$modelplan->id_payu=$response->id;
				if($modelplan->insert()){
					foreach( $_POST['Modulos'] as $value){
						if($value!=0){
							$planHasParametros =new PlanHasParametros;
							$planHasParametros->plan_id_plan=$modelplan->id_plan;
							$planHasParametros->parametros_idparametros=$value;
							$planHasParametros->save();
						}
					}
                  	$this->redirect(array('view','id'=>$modelplan->id_plan));
				}
	    	}
		}
	  }
		$sql = "select idparametros ,codigo, nombre, (SELECT count(1) FROM plan_has_parametros a WHERE a.parametros_idparametros=b.idparametros AND a.plan_id_plan=0) as estado  from parametros b where  b.tipo='modulo'";

		$consulta1 = Yii::app()->db->createCommand($sql)->queryAll();
       // var_dump(json_encode($consulta1));die;
		$model->modulos=$consulta1;
       
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
		$model_plan=$this->loadModel($id);

		$model= new PlanForm;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['PlanForm']))
		{
			
			$model->attributes=$_POST['PlanForm'];
			$model_plan->plan_nombre=$model->plan_nombre;
			$model_plan->plan_codigo=$model->plan_codigo;
			$model_plan->valor_text=$model->valor_text;
			$model_plan->valor=$model->valor;
		
			$model_plan->mensajes_push=$model->mensajes_push;
			$pago=new Pago;

			$response = $pago->editar_plan($modelplan->plan_nombre, $model_plan->plan_code, $model_plan->moneda, $modelplan->valor );
			var_dump($response);die;
			if($response){
         	 	if($model_plan->save()){
	             $sql = "select idparametros ,codigo, nombre from parametros b where  b.tipo='modulo'";
			     $consulta1 = Yii::app()->db->createCommand($sql)->queryAll();
				 for( $i=0; $i<count($consulta1);$i++){
				    if (!in_array($consulta1[$i]['idparametros'] , $_POST['Modulos'], true )) {
						$criteria = new CDbCriteria();
						$criteria->select = 'parametros_idparametros, plan_id_plan, id_plan_has_parametroscol';
						$criteria->condition = 'parametros_idparametros=:parametros_idparametros AND plan_id_plan=:plan_id_plan';
						$criteria->params = array(':parametros_idparametros'=>$consulta1[$i]['idparametros'], ':plan_id_plan'=>$model_plan->id_plan);
						$plan_has_par=PlanHasParametros::model()->find($criteria);
						if($plan_has_par->plan_id_plan!=null){
							$plan_has_par->delete();
						}
					}else{
						$criteria = new CDbCriteria();
						$criteria->select = 'parametros_idparametros, plan_id_plan, id_plan_has_parametroscol';
						$criteria->condition = 'parametros_idparametros=:parametros_idparametros AND plan_id_plan=:plan_id_plan';
						$criteria->params = array(':parametros_idparametros'=>$consulta1[$i]['idparametros'], ':plan_id_plan'=>$model_plan->id_plan);
						$plan_has_par=PlanHasParametros::model()->find($criteria);
					
						if($plan_has_par->plan_id_plan==null) {
							$planHasParametros=new PlanHasParametros;
							$planHasParametros->plan_id_plan=$model_plan->id_plan;
							$planHasParametros->parametros_idparametros=$consulta1[$i]['idparametros'];
							$planHasParametros->save();
						}
				
					}
                    
			      	}
				$this->redirect(array('update','id'=>$model_plan->id_plan));	
			
			}
		}

	       


		 
		 
		}
		$model->plan_nombre=$model_plan->plan_nombre;
		$model->plan_codigo=$model_plan->plan_codigo;
		$model->valor_text=$model_plan->valor_text;
		$model->valor=$model_plan->valor;

		$model->periodo_plan=$model_plan->periodo_plan;
		$model->moneda=$model_plan->moneda;
		
		$model->mensajes_push=$model_plan->mensajes_push;
		$model->descripcion=$model_plan->descripcion;
		$model->isNewRecord=false;
		$sql = "select idparametros ,codigo, nombre, (SELECT count(1) FROM plan_has_parametros a WHERE a.parametros_idparametros=b.idparametros AND a.plan_id_plan=".$model_plan->id_plan.") as estado  from parametros b where  b.tipo='modulo'";
		  $consulta1 = Yii::app()->db->createCommand($sql)->queryAll();
		$model->modulos=$consulta1;
		$this->render('update',array(
		  'model'=>$model
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$pago=new Pago;
		$response = $pago->eliminar_plan($this->loadModel($id)->plan_code);
	    if($response) {
        	$this->loadModel($id)->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax'])){
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
    	}
	}



	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Plan('search');
		$model->unsetAttributes(); 
		// clear any default values
		if(isset($_GET['Plan']))
			$model->attributes=$_GET['Plan'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Plan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Plan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Plan $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='plan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
