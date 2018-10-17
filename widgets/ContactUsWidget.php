<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\widgets;

use yii\base\Widget;

/**
 * Description of ContactUsWidget
 *
 * @author Hendri <hendri.gnw@gmail.com>
 */
class ContactUsWidget extends Widget
{
    public $model;
    public $sectionClass;
    
    public function run()
    {
        return $this->render('contact-us', [
            'model' => $this->model,
            'sectionClass' => $this->sectionClass
        ]);
    }
}
