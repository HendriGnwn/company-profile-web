<?php

use app\components\View;
use app\models\Portfolio;
use app\widgets\PortfolioWidget;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* @var $this View */
/* @var $portfolios Portfolio */

$this->title = 'Our Portfolios';
$this->params['breadcrumbs'][] = $this->title;

$metakey = 'Our portfolio PT Qelopak Teknologi Indonesia, Web and Network maintenance, renovation and development, Hosting, VPS and Domain';
$description = 'This is a portfolios of the PT Qelopak Teknologi Indonesia, We are work with great heart';

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
<div class="padding-bottom-100"></div>
<?= PortfolioWidget::widget([
    'portfolios' => $portfolios,
]) ?>