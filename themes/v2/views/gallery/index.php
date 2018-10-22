<?php

use app\components\View;
use app\models\Config;
use app\models\Portfolio;
use app\widgets\GalleryWidget;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* @var $this View */
/* @var $portfolios Portfolio */

$this->title = Yii::t('app', 'Our Galleries');
$this->params['breadcrumbs'][] = $this->title;

$metakey = Config::getAppMetaKey();
$description = Config::getAppMetaDescription();

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

?>

<?=GalleryWidget::widget([
    'galleries' => $models,
]) ?>