<?php

class EAjaxUploadAction extends CAction
{

        public function run()
        {
                Yii::import("ext.EAjaxUpload.qqFileUploader");


                $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
                $result = $uploader->handleUpload('uploads');
                // to pass data through iframe you will need to encode all html tags
                $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                echo $result;
        }
}
