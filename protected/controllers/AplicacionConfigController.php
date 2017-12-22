<?php

class AplicacionConfigController extends Controller
{



	/**
    * Acción que se ejecuta en segunda instancia para verificar si el usuario tiene sesión activa.
    * En caso contrario no podrá acceder a los módulos del aplicativo y generará error de acceso.
    */
    public function filterEnforcelogin($filterChain){
		if(Yii::app()->user->isGuest){
            if(isset($_POST) && !empty($_POST)){
                $response["status"]="nosession";
                echo CJSON::encode($response);
                exit();
            }
            else{
          
               // Yii::app()->user->returnUrl = array("site/login");                                                          
              //  $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        else{
            Yii::app()->user->returnUrl = array("site/index");          
            $this->redirect(Yii::app()->user->returnUrl);
        }
        $filterChain->run();
    }
    /**
     * @return array action filters
     */
	public function filters(){
        return array(
                'enforcelogin  -index -logout -contact -registerPlatform -searchservices -registerPlatformMovile -loginPlatformMovile -plantillaManager -aplicacionConfig',                      
        );
    }






/*

	public function actionAplicacionConfig()
	{
		$model=new Aplicacion;
	
		// uncomment the following code to enable ajax-based validation
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='aplicacionConfig-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
	
		if(isset($_POST['Aplicacion']))
		{
			$model->attributes=$_POST['Aplicacion'];
			if($model->validate())
			{
				// form inputs are valid, do something here
				return;
			}
		}
		$this->render('aplicacionConfig',array('model'=>$model));
	}

	*/
}