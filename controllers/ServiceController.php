<?php

namespace app\controllers;

use app\models\Service;

/**
 * ServiceController
 * 
 * @author Hendri <hendri.gnw@gmail.com>
 */
class ServiceController extends BaseController
{
    public function actionIndex()
    {
        $services = Service::find()->actived()->all();
        
        $pageService = \app\models\Page::findOne([
            'slug' => 'program',
            'status' => \app\models\Page::STATUS_ACTIVE,
        ]);
        
        return $this->render('index', [
            'services' => $services,
            'pageService' => $pageService
        ]);
    }
}
