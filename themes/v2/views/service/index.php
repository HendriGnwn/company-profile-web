<?php

use app\models\Service;
use yii\helpers\Html;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* @var $services Service */

$this->title = 'Our Services';
$this->params['breadcrumbs'][] = $this->title;

$metakey = $pageService->metakey;
$description = $pageService->metadesc;

/** SEO */
$this->registerMetaTag([
    'http-equiv' => 'Content-Type',
    'content' => 'text/html; charset=utf-8'
]);
$this->registerLinkAlternate();
$this->registerLinkCanonical();
$this->registerMetaTitle();
$this->registerMetaKeywords($metakey);
$this->registerMetaDescription($description);
$this->registerMetaTag(['name' => 'robots',  'content' => 'index,follow']);
$this->registerMetaTag(['name' => 'googlebot',  'content' => 'index,follow']);
$socialMedia = [
    'title' => $this->title .' - '. Yii::$app->name,
    'description' => $description,
];
$this->registerMetaSocialMedia($socialMedia);
$this->registerCssFile('themes/v2/css/service_style_1.css');

?>
<div class="about_section bg-white">
    <div class="container">
        <div class="row padding-bottom-100">
            <div class="col-lg-8 col-md-12 col-xs-12 col-sm-12 col-lg-offset-2">
                <div class="section_heading">
                    <h2><?= $pageService->name ?></h2>
                    <span class="bordered-icon"><i class="fa fa-square"></i></span>
                </div>
                <div class="section_content">
                    <?= $pageService->description ?>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach($services as $id => $service) : ?>
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-6">
                    <div class="gb_icon_wrapper">
                        <div class="gb_icon_img">
                            <i class="fa fa-<?= $service->icon ?>" aria-hidden="true"></i>
                        </div>
                        <div class="gb_icon_content">
                            <h4><a href="javascript:;"><?= $service->name ?></a></h4>
                            <p><?= $service->description ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>