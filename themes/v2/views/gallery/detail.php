<?php

use app\helpers\FormatConverter;
use app\models\Config;
use app\models\Portfolio;
use yii\helpers\Html;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* @var $model Portfolio */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Portfolios'), 'url' => ['/portfolio/index']];
$this->params['breadcrumbs'][] = $this->title;

$description = $model->metadesc;

/** SEO */
$this->registerMetaTag([
    'http-equiv' => 'Content-Type',
    'content' => 'text/html; charset=utf-8'
]);
$this->registerLinkAlternate();
$this->registerLinkCanonical();
$this->registerMetaTitle();
$this->registerMetaKeywords($model->metakey);
$this->registerMetaDescription($description);
$this->registerMetaTag(['name' => 'robots',  'content' => 'index,follow']);
$this->registerMetaTag(['name' => 'googlebot',  'content' => 'index,follow']);
$socialMedia = [
    'title' => $this->title,
    'description' => $description,
    'image' => $model->getIsGallery() ? $model->getFirstGallery()->getPhotoUrl(true) : Config::getAppSeoImageUrl(),
];
$this->registerMetaSocialMedia($socialMedia);

?>

<!-- Single Project Section -->
<section class="single-project-section padding-top-100">
    <div class="container">

        <div id="<?= $model->slug ?>" class="carousel slide boot-slider" data-ride="carousel">

            <?php if (!$model->getIsGallery()) : ?>
                <?= Html::img(['themes/v1/img/portfolio/single-project-1.jpg'], ['class' => 'img-responsive']) ?>
            <?php else: ?>
                <ol class="carousel-indicators">
                    <?php
                    $no = 1;
                    foreach ($model->galleries as $gallery) :
                        echo Html::tag('li', '', ['data-target' => '#'.$model->slug, 'data-slide'=>$no, 'class' => ($no==1) ? 'active' : '']);
                        $no++;
                    endforeach;
                    ?>
                </ol>

                <div class="carousel-inner" role="listbox">
                    <?php
                    $no = 1;
                    ?>
                    <?php foreach($model->galleries as $gallery) : ?>
                        <div class="item <?= ($no==1) ? 'active' : '' ?>">
                            <?= Html::img($gallery->getPhotoUrl(), ['alt' => $gallery->name, 'class' => 'img-responsive', 'style' => 'width:100%', 'title' => $gallery->name]) ?>
                        </div>
                    <?php 
                        $no++;
                    endforeach; 
                    ?>
                </div>

                <a class="left carousel-control" href="#<?= $model->slug ?>" role="button" data-slide="prev">
                    <span class="fa fa-angle-left" aria-hidden="true"></span>
                    <span class="sr-only"><?= Yii::t('app', 'Previous') ?></span>
                </a>
                <a class="right carousel-control" href="#<?= $model->slug ?>" role="button" data-slide="next">
                    <span class="fa fa-angle-right" aria-hidden="true"></span>
                    <span class="sr-only"><?= Yii::t('app', 'Next') ?></span>
                </a>
            <?php endif; ?>
        </div>


        <div class="project-overview padding-top-70 padding-bottom-100">
            <div class="row mb-80">
                <div class="col-md-8">
                    <span class="text-medium text-uppercase brand-color"><?= $model->service ? $model->service->name : '' ?></span>
                    <h2 class="mb-30 font-35"><?= $model->name ?></h2>
                    <?= $model->description ?>
                </div>

                <div class="col-md-4 quick-overview">
                    <ul class="portfolio-meta">
                        <li><span> Client </span> <?= $model->client ?></li>
                        <li><span> Created by </span> <?= $model->createdBy ? $model->createdBy->username : 'Admin' ?></li>
                        <li><span> Completed on </span> <?= FormatConverter::dateFormat($model->completed_on, 'd M Y') ?></li>
                        <li><span> Technology </span> <?= $model->technology ?></li>
                    </ul>
                    
                    <?= Html::a('Visit Website', $model->website, ['target'=>'_blank', 'class'=>'btn btn-lg text-capitalize mt-30 waves-effect waves-light']) ?>

                </div>
            </div><!-- /.row -->

        </div><!-- /.project-overview -->

    </div><!-- /.container -->
</section><!-- /.single-project-section -->