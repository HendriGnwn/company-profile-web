<?php

use app\models\Config;
use app\widgets\ContactUsWidget;


$this->title = 'Contact Us';
$this->params['breadcrumbs'][] = $this->title;

$metakey = 'contact PT Qelopak Teknologi Indonesia';
$metadescription = 'Please call to get more information of PT Qelopak Teknologi Indonesia';

/** SEO */
$this->registerMetaTag([
    'http-equiv' => 'Content-Type',
    'content' => 'text/html; charset=utf-8'
]);
$this->registerLinkAlternate();
$this->registerLinkCanonical();
$this->registerMetaTitle();
$this->registerMetaKeywords($metakey);
$this->registerMetaDescription($metadescription);
$this->registerMetaTag(['name' => 'robots',  'content' => 'index,follow']);
$this->registerMetaTag(['name' => 'googlebot',  'content' => 'index,follow']);
$socialMedia = [
    'title' => $this->title . ' | ' . Yii::$app->name,
    'description' => $metadescription,
];
$this->registerMetaSocialMedia($socialMedia);

?>

<?= ContactUsWidget::widget(['model' => $model, 'sectionClass' => '']) ?>

<?= app\widgets\GoogleMapWidget::widget() ?>