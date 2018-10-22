<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\widgets;

use yii\base\Widget;

/**
 * Description of BannerWidget
 *
 * @author Hendri <hendri.gnw@gmail.com>
 */
class MemberSigninWidget extends Widget
{
    public function run()
    {
        $model = new \app\models\MemberLoginForm();
        
        return $this->render('member-sign-in', [
            'model' => $model
        ]);
    }
}
