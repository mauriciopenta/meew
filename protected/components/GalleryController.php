<?php

/**
 * Backend controller for GalleryManager widget.
 * Provides following features:
 *  - Image removal
 *  - Image upload/Multiple upload
 *  - Arrange images in gallery
 *  - Changing name/description associated with image
 *
 * @author Bogdan Savluk <savluk.bogdan@gmail.com>
 */
class GalleryController extends CController
{
    public function filters()
    {
        return array(
            'postOnly + delete, ajaxUpload, order, changeData',
        );
    }

    /**
     * Removes image with ids specified in post request.
     * On success returns 'OK'
     */
    public function actionDelete()
    {
        $id = $_POST['id'];
        /** @var $photos GalleryPhoto[] */
        $photos = GalleryPhoto::model()->findAllByPk($id);
        foreach ($photos as $photo) {
            if ($photo !== null) {
              if($photo->tipo_contenido==1){
                    $S3_KEY = 'AKIAI77TVSZ7KWTFPWMQ';
                    $S3_SECRET = '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';
                    $S3_URL = 'http://s3.amazonaws.com/';
                    // expiration date of query
                    $s3 = new A2S3(array(
                    'key'    => $S3_KEY,
                    'secret' => $S3_SECRET));
                    $file_name=  $photo->file_name;
                    $file_name= str_replace($S3_URL,"",$file_name);
                    $start =strripos($file_name, '/') + 1;
                    $key=substr($file_name,$start);

                   $file_name= str_replace( "/".$key,"",$file_name);
                   // var_dump("key :".$key." Bucket: ".$file_name);die;
                    $s3->deleteObject(array(
                        'Bucket' => $file_name,
                        'Key'    => $key
                    ));

              }
                
                $photo->delete();
            }
            else throw new CHttpException(400, 'Photo, not found');
        }
        echo 'OK';
    }

    /**
     * Method to handle file upload thought XHR2
     * On success returns JSON object with image info.
     * @param $gallery_id string Gallery Id to upload images
     * @throws CHttpException
     */
    public function actionAjaxUpload($gallery_id = null)
    {
        $model = new GalleryPhoto();
        $model->gallery_id = $gallery_id;
        $imageFile = CUploadedFile::getInstanceByName('image');
        
        $imagen="";
        $rnd = rand(0,9999);  // generate random number between 0-9999
    
        if(isset($imageFile)){  

          $tmp = $imageFile->tempName;

          $fileName = "{$rnd}-{$imageFile}";

          $S3_BUCKET = 'meew/Imagenes/'.Yii::app()->user->getState('id_usuario').'/galeria'.'/'.$gallery_id;
          
          $s3file='http://s3.amazonaws.com/'.$S3_BUCKET.'/'.$fileName;
          
          $S3_KEY = 'AKIAI77TVSZ7KWTFPWMQ';
          $S3_SECRET = '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';
        
          $S3_URL = 'http://s3.amazonaws.com/';
 
          // expiration date of query
                $s3 = new A2S3(array(
                              'key'    => $S3_KEY,
                              'secret' => $S3_SECRET));

                  $s3->putObject(array(
                      'Bucket' => $S3_BUCKET,
                      'Key'    => $fileName,
                      'SourceFile'=>$tmp,
                      'ACL'    => 'public-read',
                      'x-amz-storage-class' => 'REDUCED_REDUNDANCY',
                  ));

                  $imagen= $s3file;
        }
        
        $model->file_name = $imagen;
        $model->save();
        // not "application/json", because  IE8 trying to save response as a file
        header("Content-Type: text/html");
        echo CJSON::encode(
            array(
                'id' => $model->id,
                'rank' => $model->rank,
                'name' => (string)$model->name,
                'description' => (string)$model->description,
                'precio_text' => (string)$model->precio_txt,
                'precio' => (int)$model->precio,
                'unidades' => (int)$model->unidades,
                'url_video' => (string)$model->url_video,
                'preview_video' => "https://www.youtube.com/embed/" . $model->url_video,
                'tipo_contenido'=>1,
                'preview' => (string)$model->file_name,
            ));
    }

    /**
     * Saves images order according to request.
     * Variable $_POST['order'] - new arrange of image ids, to be saved
     * @throws CHttpException
     */
    public function actionOrder()
    {
        if (!isset($_POST['order'])) throw new CHttpException(400, 'No data, to save');
        $gp = $_POST['order'];
        $orders = array();
        $i = 0;
        foreach ($gp as $k => $v) {
            if (!$v) $gp[$k] = $k;
            $orders[] = $gp[$k];
            $i++;
        }
        sort($orders);
        $i = 0;
        $res = array();
        foreach ($gp as $k => $v) {
            /** @var $p GalleryPhoto */
            $p = GalleryPhoto::model()->findByPk($k);
            $p->rank = $orders[$i];
            $res[$k] = $orders[$i];
            $p->save(false);
            $i++;
        }

        echo CJSON::encode($res);

    }

    /**
     * Method to update images name/description via AJAX.
     * On success returns JSON array od objects with new image info.
     * @throws CHttpException
     */
    public function actionChangeData($gallery_id = null)
    {
        if (!isset($_POST['photo'])) throw new CHttpException(400, 'Nothing, to save');
        $data = $_POST['photo'];

        //  var_dump(json_encode($data));die;

        if(array_keys($data)[0]==0){
            $model = new GalleryPhoto();
            $model->gallery_id = $gallery_id;  
            $model->name = $data[0]['name'];
            $model->file_name = "http://i3.ytimg.com/vi/".$data[0]['url_video']."/maxresdefault.jpg";
            $model->tipo_contenido = 2;
            
            $model->description = $data[0]['description'];
            $model->url_video = $data[0]['url_video'];



            if($model->save()){
           
           
                header("Content-Type: text/html");
                echo CJSON::encode(
                    array(
                        'id' => $model->id,
                        'rank' => $model->rank,
                        'name' => (string)$model->name,
                        'description' => (string)$model->description,
                        'precio_text' => (string)$model->precio_txt,
                        'precio' => (int)$model->precio,
                        'unidades' => (int)$model->unidades,
                        'url_video' => (string)$model->url_video,
                        'preview_video' => "https://www.youtube.com/embed/" . $model->url_video,
                        'tipo_contenido'=>2,
                        'preview' => (string)$model->file_name,
                    ));
            }else{

                echo CJSON::encode(
                    array(
                        'error' => "error insert" 
                    ));
            }
        }else{

            $criteria = new CDbCriteria();
            $criteria->index = 'id';
            $criteria->addInCondition('id', array_keys($data));
            /** @var $models GalleryPhoto[] */
            $models = GalleryPhoto::model()->findAll($criteria);
            foreach ($data as $id => $attributes) {
                if (isset($attributes['name']))
                    $models[$id]->name = $attributes['name'];
                if (isset($attributes['description']))
                    $models[$id]->description = $attributes['description'];

                if (isset($attributes['precio_text']))
                    $models[$id]->precio_txt = $attributes['precio_text'];

                if (isset($attributes['precio']))
                    $models[$id]->precio = $attributes['precio'];
                
                    if (isset($attributes['unidades']))
                    $models[$id]->unidades = $attributes['unidades'];
                
                    if (isset($attributes['url_video']))
                    $models[$id]->url_video = $attributes['url_video'];    


                $models[$id]->save();
            }
            $resp = array();
            foreach ($models as $model) {
                $resp[] = array(
                    'id' => $model->id,
                    'rank' => $model->rank,
                    'name' => (string)$model->name,
                    'description' => (string)$model->description,
                    'tipo_contenido' => (string)$model->tipo_contenido,
                    'precio_text' => (string)$model->precio_txt,
                    'precio' => (int)$model->precio,
                    'unidades' => (int)$model->unidades,
                    'url_video' => (string)$model->url_video,
                    'preview_video' => "https://www.youtube.com/embed/" . $model->url_video,
                  
                    'preview' => (string)$model->file_name,
                );
            }
            echo CJSON::encode($resp);
        }
    }

    public function actionCreateVideoData()
    {
      if (!isset($_POST['photo'])) throw new CHttpException(400, 'Nothing, to save');
           $data = $_POST['photo'];
           var_dump($data);

           $model = new GalleryPhoto();

           

           $model->gallery_id = $gallery_id;
           $imageFile = CUploadedFile::getInstanceByName('image');
           $model->file_name = $imageFile->getName();
           
           $model->save();
   
           $model->setImage($imageFile->getTempName());
           // not "application/json", because  IE8 trying to save response as a file
           header("Content-Type: text/html");
           echo CJSON::encode(
               array(
                   'id' => $model->id,
                   'rank' => $model->rank,
                   'name' => (string)$model->name,
                   'description' => (string)$model->description,
                   'name' => (string)$model->name,
                   'description' => (string)$model->description,
                   'precio_text' => (string)$model->precio_txt,
                   'precio' => (int)$model->precio,
                   'unidades' => (int)$model->unidades,
                   'url_video' => (string)$model->url_video,
                   'preview_video' => (string)$model->url_video,
                   'preview' => $model->getPreview(),
               ));
   
         
       /* foreach ($data as $id => $attributes) {
            if (isset($attributes['name']))
                $models[$id]->name = $attributes['name'];
            if (isset($attributes['description']))
                $models[$id]->description = $attributes['description'];

            if (isset($attributes['precio_text']))
                $models[$id]->precio_txt = $attributes['precio_text'];

            if (isset($attributes['precio']))
                $models[$id]->precio = $attributes['precio'];
            
                if (isset($attributes['unidades']))
                $models[$id]->unidades = $attributes['unidades'];
            
                if (isset($attributes['url_video']))
                $models[$id]->description = $attributes['url_video'];    


            $models[$id]->save();
        }
        $resp = array();
        foreach ($models as $model) {
            $resp[] = array(
                'id' => $model->id,
                'rank' => $model->rank,
                'name' => (string)$model->name,
                'description' => (string)$model->description,
                'tipo_contenido' => (string)$model->tipo_contenido,
                'precio_text' => (string)$model->precio_txt,
                'precio' => (int)$model->precio,
                'unidades' => (int)$model->unidades,
                'url_video' => (string)$model->url_video,
                'preview' => $model->getPreview(),
            );
        }
        echo CJSON::encode($resp);*/
    }

    

   



}
