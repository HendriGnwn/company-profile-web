<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Hendri <hendri.gnw@gmail.com>
 */
class GoogleMapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js;
    
    public function init() 
    {
        parent::init();
        $this->js = [
            'https://maps.googleapis.com/maps/api/js?key='.\Yii::$app->params['credential_googlemap_api']//.'&callback=initMap',
        ];
    }
}
