<?php
class ApiController extends Controller
{
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
    /**
     * @return array action filters
     */
    public function filters(){
        return array(
            'accessControl', // perform access control for CRUD operations
            
        );
    }
  


    public function actions()
    {
        return array(
            'saveImageAttachment_imagen_splash' => 'vendor.z_bodya.yii-image-attachment.ImageAttachmentAction',
            'elFinderConnector' => array(
                'class' => 'ElFinderConnectorAction',
                'settings' => array(
                    'root' => Yii::app()->baseUrl . '/protected/uploads/',
                    'URL' => Yii::app()->baseUrl . '/protected/uploads/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none'
                )
            ),
            'tinyMceCompressor' => array(
                'class' => 'TinyMceCompressorAction',
                'settings' => array(
                    'compress' => true,
                    'disk_cache' => true,
                )
            ),
            'tinyMceSpellchecker' => array(
                'class' => 'TinyMceSpellcheckerAction',
            ),
        );
    }

} 