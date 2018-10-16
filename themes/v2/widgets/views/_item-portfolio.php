<?php

use app\models\Portfolio;
use yii\helpers\Html;
use yii\helpers\Url;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* @var $model Portfolio */

if (!$model->getIsGallery()) :
    $photoUrl = $model->getFirstGallery()->getPhotoUrl();
    $photoName = $model->getFirstGallery()->name;
else:
    $photoUrl = Url::to(['data/img/portfolio-dummy-1.jpg']);
    $photoName = 'Portfolio';
endif;
?>
<div class="portfolio_img_wrapper">
    <div class="portfolio_img">
        <?= Html::img($photoUrl, ['title' => $photoName, 'class' => 'img-responsive']) ?>
        <div class="portfolio_img_overlay">
            <div class="portfolio_img_text">
                <?= Html::a("<i class='fa fa-plus' aria-hidden='true'></i>", $photoUrl, ['class' => 'search', 'alt' => $photoName]) ?>
                <?= Html::a("<i class='fa fa-chain' aria-hidden='true'></i>", $model->getDetailUrl()) ?>
            </div>
        </div>
    </div>
</div>