<?php

use app\models\Config;
use app\widgets\BannerWidget;
use app\widgets\BlogSectionWidget;
use app\widgets\ContactUsWidget;
use app\widgets\GoogleMapWidget;
use app\widgets\PortfolioWidget;
use app\widgets\ShortServiceWidget;
use app\widgets\SubscribeFormWidget;
use app\widgets\TestimonialWidget;


$this->title = Config::getAppMotto();

/** SEO */
$this->registerMetaTag([
    'http-equiv' => 'Content-Type',
    'content' => 'text/html; charset=utf-8'
]);
$this->registerLinkAlternate();
$this->registerLinkCanonical();
$this->registerMetaTitle();
$this->registerMetaKeywords(Config::getAppMetaKey());
$this->registerMetaDescription(Config::getAppMetaDescription());
$this->registerMetaTag(['name' => 'robots',  'content' => 'index,follow']);
$this->registerMetaTag(['name' => 'googlebot',  'content' => 'index,follow']);
$socialMedia = [
    'title' => Yii::$app->name . ' | ' . $this->title,
    'description' => Config::getAppMetaDescription(),
    'image' => Config::getAppSeoImageUrl(),
];
$this->registerMetaSocialMedia($socialMedia);

?>
    <?= BannerWidget::widget() ?>

    <?= ShortServiceWidget::widget() ?>

    <?php 
    $projectCompleted = Config::getCounterProjectCompleted(); 
    $happyCustomer = Config::getCounterHappyCustomer();
    $ourEmployee = Config::getCounterOurEmployee();
    $yearOfExperience = Config::getCounterYearOfExperience();
    ?>

    <div class="counterFour ptb-100">
        <div class="container text-center">
            <div class="row">

                <div class="col-xs-12 col-md-3 col-sm-3">
                    <span class="icon-one"><i class="fa fa-check"></i></span>
                    <h4><a href="#"><?= $projectCompleted->label ?></a></h4>
                    <div class="count-description">
                        <span class="timer"><?= $projectCompleted->value ?></span>
                    </div>
                </div>


                <div class="col-xs-12 col-md-3 col-sm-3">
                    <span class="icon-two"><i class="fa fa-calendar"></i></span>
                    <h4><a href="#"><?= $yearOfExperience->label ?></a></h4>
                    <div class="count-description">
                        <span class="timer"><?= $yearOfExperience->value ?></span>
                    </div>
                </div>


                <div class="col-xs-12 col-md-3 col-sm-3">
                    <span class="icon-three"><i class="fa fa-heart"></i></span>
                    <h4><a href="#"><?= $happyCustomer->label ?></a></h4>
                    <div class="count-description">
                        <span class="timer"><?= $happyCustomer->value ?></span>
                    </div>
                </div>


                <div class="col-xs-12 col-md-3 col-sm-3">
                    <span class="icon-four"><i class="fa fa-users"></i></span>
                    <h4><a href="#"><?= $ourEmployee->label ?></a></h4>
                    <div class="count-description">
                        <span class="timer"><?= $ourEmployee->value ?></span>
                    </div>
                </div>


            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>

    <?= PortfolioWidget::widget(['portfolios' => $portfolioProvider]) ?>

    <?= TestimonialWidget::widget() ?>

    <?= BlogSectionWidget::widget() ?>

    <?= ContactUsWidget::widget(['model' => $contactModel, 'sectionClass' => 'counterFour']) ?>

    <?= GoogleMapWidget::widget() ?>