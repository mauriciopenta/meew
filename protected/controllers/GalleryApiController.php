<?php
/**
 * Created by PhpStorm.
 * User: z_bodya
 * Date: 11/16/13
 * Time: 5:44 PM
 */

class GalleryApiController extends GalleryController
{

    public function filters()
    {
        return array_merge(
            parent::filters(),
            array(
                'accessControl', // perform access control for CRUD operations
            )
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
            array('allow', // allow authenticated users to access all actions
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
} 