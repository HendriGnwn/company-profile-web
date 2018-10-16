<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\widgets;

use app\models\Page;
use yii\base\Widget;

/**
 * Description of BannerWidget
 *
 * @author Hendri <hendri.gnw@gmail.com>
 */
class ShortServiceWidget extends Widget
{
    public function run()
    {
        $model = Page::findOne(['id' => Page::PAGE_SERVICE_PARTIAL, 'status' => Page::STATUS_ACTIVE]);
        $services = \app\models\Service::find()
                ->actived()
                ->limit(3)
                ->all();
        
        return $this->render('short-service', [
            'model' => $model,
            'services' => $services
        ]);
    }
}
