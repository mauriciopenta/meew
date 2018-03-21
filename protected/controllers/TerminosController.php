<?php

class TerminosController extends Controller
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
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('edit','update'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	public function actionEdit()
	{
		$model=new Terminos;

		if(Yii::app()->user->getState('nombreRole')=="ADMINISTRADOR"){
			
			$modelTerminos= Terminos::model()->findByAttributes(array('tipo'=>"ADMINISTRADOR"));
			if(is_object($modelTerminos)){
               $model=$modelTerminos;
			}




		}else{
			$aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
			
			if(is_object($aplicacionFromDb) && isset($aplicacionFromDb->nombre)){
				$modelTerminos= Terminos::model()->findByAttributes(array('id_aplicacion'=>$aplicacionFromDb->idaplicacion));
		        if(is_object($modelTerminos)){
					$model=$modelTerminos;
				 }
			}
		}


		if(isset($_POST['Terminos']))
		{
			$model->attributes=$_POST['Terminos'];

			if(Yii::app()->user->getState('nombreRole')=="ADMINISTRADOR"){
				$model->tipo="ADMINISTRADOR";
			}else{
				$model->tipo="CLIENTE";
				$aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
				if(is_object($aplicacionFromDb) && isset($aplicacionFromDb->nombre)){
					$model->id_aplicacion=$aplicacionFromDb->idaplicacion;
				}
			}

			if($model->save())
				$this->redirect(array('edit'));
		}

		$this->render('edit',array(
			'model'=>$model,
		));
	}




	public function actionAdmin()
	{
		$model=new Terminos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Terminos']))
			$model->attributes=$_GET['Terminos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Terminos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Terminos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Terminos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='terminos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
