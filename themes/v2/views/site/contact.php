<?php

use app\models\Config;
use app\widgets\ContactUsWidget;


$this->title = Yii::t('app', 'Contact Us');
$this->params['breadcrumbs'][] = $this->title;

$metakey = $metadescription = Yii::t('app', 'Contact Us') . ' '. \app\models\Config::getAppCompanyName();

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