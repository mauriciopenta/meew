<?php
/**
 * Widget to manage aplicacion.
 * Requires Twitter Bootstrap styles to work.
 *
 * @author Bogdan Savluk <savluk.bogdan@gmail.com>
 */
class ImageManager extends CWidget
{
     /** @var Aplicacion Model of aplicacion to manage */
     public $aplicacion;
    /** @var string Route to aplicacion controller */
    public $controllerRoute = false;
    public $assets;
    public $htmlOptions = array();

 
    public function init()
    {
        $this->assets = Yii::app()->request->baseUrl;
    }


  

    /** Render widget */
    public function run()
    {
        /** @var $cs CClientScript */
        $cs = Yii::app()->clientScript;
        $cs->registerCssFile(Yii::app()->request->baseUrl . '/bootstrap/css/bootstrap.css');
        $cs->registerCssFile(Yii::app()->request->baseUrl . '/plugins/dropzone/min/dropzone.min.css');
        $cs->registerCoreScript('jquery');
        $cs->registerCoreScript('jquery.ui');

        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery.iframe-transport.js');
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/plugins/dropzone/min/dropzone.min.js');
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery.imageManager.js');
        
             $recurso = array(
                 'idaplicacion' => $this->aplicacion->idaplicacion,
                 'imagen_splash' => (string) $this->aplicacion->imagen_splash,
                 'imagen_icon' => (string) $this->aplicacion->imagen_icon,
                 'imagen_icon_int' => (string) $this->aplicacion->icon_interno,
                
             );


             $opts = array(
                'recurso' => $recurso,
                'uploadUrl' => Yii::app()->createUrl($this->controllerRoute . '/upload'), 
                'deleteUrl' => Yii::app()->createUrl($this->controllerRoute . '/delete'),
                'updateUrl' => Yii::app()->createUrl($this->controllerRoute . '/changeData',array('idaplicacion' => $this->aplicacion->idaplicacion)),
                'idaplicacion' => $this->aplicacion->idaplicacion
            );
    
            if (Yii::app()->request->enableCsrfValidation) {
                $opts['csrfTokenName'] = Yii::app()->request->csrfTokenName;
                $opts['csrfToken'] = Yii::app()->request->csrfToken;
            }
     //   var_dump(json_encode($opts));die;
            $opts = CJavaScript::encode($opts);
            $cs->registerScript('imageManager#' . $this->id, "$('#{$this->id}').imageManager({$opts});");

          //  var_dump('imageManager#' . $this->id, "$('#{$this->id}').imageManager({$opts});");die;
          
            $this->htmlOptions['id'] = $this->id;
           
            $this->render('application.views.aplicacion.imageManager');



          
    
         }



}
