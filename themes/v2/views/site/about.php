<?php

use app\components\View;
use app\models\Client;
use app\models\Config;
use app\models\Page;
use app\widgets\TeamWidget;
use yii\helpers\Html;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* @var $model Page */
/* @var $this View */
/* @var $clients Client */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;

/** SEO */
$this->registerMetaTag([
    'http-equiv' => 'Content-Type',
    'content' => 'text/html; charset=utf-8'
]);
$this->registerLinkAlternate();
$this->registerLinkCanonical();
$this->registerMetaTitle();
$this->registerMetaKeywords($model->metakey);
$this->registerMetaDescription($model->metadesc);
$this->registerMetaTag(['name' => 'robots',  'content' => 'index,follow']);
$this->registerMetaTag(['name' => 'googlebot',  'content' => 'index,follow']);
$socialMedia = [
    'title' => $this->title . ' | ' . Yii::$app->name,
    'description' => $model->metadesc,
];
$this->registerMetaSocialMedia($socialMedia);
$this->registerCssFile('themes/v2/css/owl.theme.default.css');
$this->registerCssFile('themes/v2/css/owl.carousel.css');
$this->registerCssFile('themes/v2/css/progress.css');
$this->registerCssFile('themes/v2/css/client.css');

$this->registerJsFile('themes/v2/js/jquery.min.js');
$this->registerJsFile('themes/v2/js/bootstrap.min.js');
$this->registerJsFile('themes/v2/js/owl.carousel.js');
$this->registerJs('
	// -------------------------------------------------------------
    //  clientOneSlider
    // -------------------------------------------------------------
      
	$(".clientOneSlider .owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        autoplay:false,
        responsiveClass: true,
        navText : ["<i class=\'fa fa-angle-left\' aria-hidden=\'true\'></i>","<i class=\'fa fa-angle-right\' aria-hidden=\'true\'></i>"],
        responsive: {
          0: {
            items: 1,
            nav: true
          },
          600: {
            items: 3,
            nav: true
          },
          1000: {
            items: 4,
            nav: true,
            loop: true,
            margin: 20
          }
        }
      });');

?>

<?= $model->description ?>

<?= TeamWidget::widget() ?>

<div class="progressFour ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-xs-12 col-sm-12 col-lg-offset-2">
                <div class="section_heading">
                    <h2><?= Yii::t('app', 'Our Skill') ?></h2>
                    <span class="bordered-icon"><i class="fa fa-square"></i></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="progress-wrapper">
                    <?php
                    $progress = Config::getProgressWebAnalyst();
                    ?>
                    <div class="progress-item">
                        <span class="progress-title"><i class="fa fa-bullseye"></i><?= $progress['label'] ?></span>
                        <div class="progress">

                          <div class="progress-bar progress-bar-dealy" role="progressbar" aria-valuenow="<?= $progress['value'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $progress['value'] ?>%;">

                            <span class="progress-percent"> <?= $progress['value'] ?>%</span>
                          </div>
                        </div><!-- /.progress -->
                    </div><!-- /.progress-item -->

                    <?php
                    $progress = Config::getProgressWebDevelopment();
                    ?>
                    <div class="progress-item">
                        <span class="progress-title"><i class="fa fa-bullseye"></i><?= $progress['label'] ?></span>
                        <div class="progress">

                          <div class="progress-bar progress-bar-dealy" role="progressbar" aria-valuenow="<?= $progress['value'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $progress['value'] ?>%;">

                            <span class="progress-percent"> <?= $progress['value'] ?>%</span>
                          </div>
                        </div><!-- /.progress -->
                    </div><!-- /.progress-item -->

                    <?php
                    $progress = Config::getProgressMobileHybrid();
                    ?>
                    <div class="progress-item">
                        <span class="progress-title"><i class="fa fa-bullseye"></i><?= $progress['label'] ?></span>
                        <div class="progress">

                          <div class="progress-bar progress-bar-dealy" role="progressbar" aria-valuenow="<?= $progress['value'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $progress['value'] ?>%;">

                            <span class="progress-percent"> <?= $progress['value'] ?>%</span>
                          </div>
                        </div><!-- /.progress -->
                    </div><!-- /.progress-item -->

                </div><!-- /.progress-wrapper -->
            </div><!-- /.col-md-6 -->

            <div class="col-md-6">
                <div class="progress-wrapper">

                    <?php
                    $progress = Config::getProgressNetworkAnalyst();
                    ?>
                    <div class="progress-item">
                        <span class="progress-title"><i class="fa fa-bullseye"></i><?= $progress['label'] ?></span>
                        <div class="progress">

                          <div class="progress-bar progress-bar-dealy" role="progressbar" aria-valuenow="<?= $progress['value'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $progress['value'] ?>%;">

                            <span class="progress-percent"> <?= $progress['value'] ?>%</span>
                          </div>
                        </div><!-- /.progress -->
                    </div><!-- /.progress-item -->

                    <?php
                    $progress = Config::getProgressNetworkDevelopment();
                    ?>
                    <div class="progress-item">
                        <span class="progress-title"><i class="fa fa-bullseye"></i><?= $progress['label'] ?></span>
                        <div class="progress">

                          <div class="progress-bar progress-bar-dealy" role="progressbar" aria-valuenow="<?= $progress['value'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $progress['value'] ?>%;">

                            <span class="progress-percent"> <?= $progress['value'] ?>%</span>
                          </div>
                        </div><!-- /.progress -->
                    </div><!-- /.progress-item -->

                </div><!-- /.progress-wrapper -->
            </div><!-- /.col-md-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div>

<?php if (!empty($clients)) : ?>
<div class="clientOne ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12 col-lg-offset-3">
                <div class="section_heading text_wrapper">
                    <h2><?= Yii::t('app', 'Our Client') ?></h2>
                    <span class="bordered-icon"><i class="fa fa-square"></i></span>
                </div>
            </div>
        </div>
        <div class="line-hr">
            <hr>
            <!-- /.partner-nav -->
        </div>
        <div class="clientOneSlider">
             <div class="owl-carousel owl-theme">
                <?php foreach ($clients as $client) : ?>
                <div class="item">
                    <?= Html::a(
                            Html::img($client->getPhotoUrl(), ['alt' => $client->name, 'width' => '100%']), 
                            $client->website, 
                            ['target' => '_blank']
                    ) ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
