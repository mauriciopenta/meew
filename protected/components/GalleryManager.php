<?php
/**
 * Widget to manage gallery.
 * Requires Twitter Bootstrap styles to work.
 *
 * @author Bogdan Savluk <savluk.bogdan@gmail.com>
 */
class GalleryManager extends CWidget
{
    /** @var Gallery Model of gallery to manage */
    public $gallery;
    /** @var string Route to gallery controller */
    public $controllerRoute = false;
    public $assets;
    

    public function init()
    {
        $this->assets = Yii::app()->request->baseUrl;
    }


    public $htmlOptions = array();


    /** Render widget */
    public function run()
    {
        /** @var $cs CClientScript */
        $cs = Yii::app()->clientScript;
        $cs->registerCssFile(Yii::app()->request->baseUrl . '/bootstrap/css/bootstrap.css');
        $cs->registerCssFile($this->assets . '/css/galleryManager.css');
        
        $cs->registerCoreScript('jquery');
        $cs->registerCoreScript('jquery.ui');
      

        if (YII_DEBUG) {
            $cs->registerScriptFile($this->assets . '/js/jquery.iframe-transport.js');
            $cs->registerScriptFile($this->assets . '/js/jquery.galleryManager.js');
        } else {
            $cs->registerScriptFile($this->assets . '/js/jquery.iframe-transport.js');
            $cs->registerScriptFile($this->assets . '/js/jquery.galleryManager.js');
        }

        if ($this->controllerRoute === null)
            throw new CException('$controllerRoute must be set.', 500);

        $photos = array();
        
        


        foreach ($this->gallery->galleryPhotos as $photo) {
           // var_dump(json_encode($photo));die;
            $photos[] = array(
                'id' => $photo->id,
                'rank' => $photo->rank,
                'name' => (string)$photo->name,
                'description' => (string) $photo->description,
                'precio_text' => (string) $photo->precio_txt,
                'precio' => (int) $photo->precio,
                'unidades' => (int) $photo->unidades,
              
                'url_video' => (string)$photo->url_video,
                'preview_video' => "https://www.youtube.com/embed/" . $photo->url_video,
                'tipo_contenido' => (string) $photo->tipo_contenido,
                'preview' => Yii::app()->request->baseUrl.$photo->file_name,

            );
        }

        $opts = array(
            'hasName' => $this->gallery->name ? true : false,
            'hasDesc' => $this->gallery->description ? true : false,
            'hasPrecio' => $this->gallery->precio ? true : false,
            'hasPrecioText' => $this->gallery->precio_text ? true : false, 
            'hasUnidades' => $this->gallery->unidades ? true : false,
            'hasUrl_video' => $this->gallery->url_video ? true : false, 
            'uploadUrl' => Yii::app()->createUrl($this->controllerRoute . '/ajaxUpload', 
             array('gallery_id' => $this->gallery->id)),
            'deleteUrl' => Yii::app()->createUrl($this->controllerRoute . '/delete'),
            'updateUrl' => Yii::app()->createUrl($this->controllerRoute . '/changeData',array('gallery_id' => $this->gallery->id)),
            'createVideoUrl' => Yii::app()->createUrl($this->controllerRoute . '/createVideoData'),
            'arrangeUrl' => Yii::app()->createUrl($this->controllerRoute . '/order'),
            'nameLabel' => Yii::t('galleryManager.main', 'Name'),
            'descriptionLabel' => Yii::t('galleryManager.main', 'Description'),
            'photos' => $photos,
            'galeria' => $this->gallery->id
        );

        if (Yii::app()->request->enableCsrfValidation) {
            $opts['csrfTokenName'] = Yii::app()->request->csrfTokenName;
            $opts['csrfToken'] = Yii::app()->request->csrfToken;
        }
        $opts = CJavaScript::encode($opts);
        $cs->registerScript('galleryManager#' . $this->id, "$('#{$this->id}').galleryManager({$opts});");

        $this->htmlOptions['id'] = $this->id;
        $this->htmlOptions['class'] = 'GalleryEditor';

        $this->render('application.views.galleryManager');
    }

}
