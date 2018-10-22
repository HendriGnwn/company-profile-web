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

if ($model->getIsGallery()) :
    $photoUrl = $model->getFirstGallery()->getPhotoUrl();
    $photoName = $model->getFirstGallery()->name;
else:
    $photoUrl = Url::to(['data/img/portfolio-dummy-1.jpg']);
    $photoName = 'Portfolio';
endif;
?>
<!--<div class="item portfolio-item" data-groups='["<?//= $model->service ? $model->service->slug : 'all' ?>"]'>-->
    <div class="portfolio-wrapper">

        <div class="thumb">
            <div class="bg-overlay brand-overlay"></div>
            <?= Html::img($photoUrl, ['alt' => $photoName]) ?>

            <div class="portfolio-intro">
                <div class="action-btn">
                    <?= Html::a('<i class=\'fa fa-search\'></i>', $photoUrl, ['title' => $photoName, 'class' => 'tt-lightbox']) ?>
                </div>
            </div>
        </div><!-- thumb -->

        <div class="portfolio-title">
            <h2><?= Html::a($model->name, $model->getDetailUrl()) ?></h2>
            <p><?= $model->service ? $model->service->name : 'All' ?></p>
        </div>

    </div><!-- /.portfolio-wrapper -->
<!--</div> /.portfolio-item -->
