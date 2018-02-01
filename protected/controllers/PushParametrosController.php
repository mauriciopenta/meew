<?php

class PushParametrosController extends Controller
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
	
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','config'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actionConfig($id)
	{
		$model= PushParametros::model()->find('id_aplicacion='.$id);

		if(!isset($model)){
			$model=new PushParametros;
			$model->id_aplicacion=$id;
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PushParametros']))
		{
			$model->attributes=$_POST['PushParametros'];
			if($model->save()){
				Yii::app()->user->returnUrl = array("aplicacion/aplicaciones");          
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}

		$this->render('config',array(
			'model'=>$model,
		));
	}

}
