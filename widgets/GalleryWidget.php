<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\widgets;

use app\models\GalleryCategory;
use yii\base\Widget;

/**
 * Description of PortfolioWidget
 *
 * @author Hendri <hendri.gnw@gmail.com>
 */
class GalleryWidget extends Widget
{
    public $galleries;
    
    public function run()
    {
        return $this->render('gallery', [
            'galleries' => $this->galleries,
            'categories' => $this->getCategories(),
        ]);
    }
    
    /**
     * returns service
     * 
     * @return array
     */
    protected function getCategories()
    {
        return GalleryCategory::find()->actived()->ordered()->all();
    }
}
