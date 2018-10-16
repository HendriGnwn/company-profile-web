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

?>

<?= $model->description ?>

<?= TeamWidget::widget() ?>

<section class="section-padding">
    <div class="container">

        <div class="text-center mb-50">
            <h2 class="section-title text-uppercase">Our Skills</h2>
            <p>Dolores eos qui ratione voluptatem sequi nesciunt.</p>
        </div>

        <div class="row">

            <div class="col-sm-6">
                <?php
                $progress = Config::getProgressWebAnalyst();
                ?>
                <div class="progress-section">
                    <span class="progress-title"><?= $progress['label'] ?></span>
                    <div class="progress">
                        <div class="progress-bar brand-bg progress-dot six-sec-ease-in-out" role="progressbar" aria-valuenow="<?= $progress['value'] ?>" aria-valuemin="0" aria-valuemax="100">
                            <span><?= $progress['value'] ?>%</span>
                        </div>
                    </div><!-- /.progress -->
                </div> <!-- progress-section end -->

                <?php
                $progress = Config::getProgressWebDevelopment();
                ?>
                <div class="progress-section">
                    <span class="progress-title"><?= $progress['label'] ?></span>
                    <div class="progress">
                        <div class="progress-bar brand-bg progress-dot six-sec-ease-in-out" role="progressbar" aria-valuenow="<?= $progress['value'] ?>" aria-valuemin="0" aria-valuemax="100">
                            <span><?= $progress['value'] ?>%</span>
                        </div>
                    </div><!-- /.progress -->
                </div> <!-- progress-section end -->

                <?php
                $progress = Config::getProgressMobileHybrid();
                ?>
                <div class="progress-section">
                    <span class="progress-title"><?= $progress['label'] ?></span>
                    <div class="progress">
                        <div class="progress-bar brand-bg progress-dot six-sec-ease-in-out" role="progressbar" aria-valuenow="<?= $progress['value'] ?>" aria-valuemin="0" aria-valuemax="100">
                            <span><?= $progress['value'] ?>%</span>
                        </div>
                    </div><!-- /.progress -->
                </div> <!-- progress-section end -->
            </div><!-- /.col-md-6 -->

            <div class="col-sm-6">
                <?php
                $progress = Config::getProgressNetworkAnalyst();
                ?>
                <div class="progress-section">
                    <span class="progress-title"><?= $progress['label'] ?></span>
                    <div class="progress">
                        <div class="progress-bar brand-bg progress-dot six-sec-ease-in-out" role="progressbar" aria-valuenow="<?= $progress['value'] ?>" aria-valuemin="0" aria-valuemax="100">
                            <span><?= $progress['value'] ?>%</span>
                        </div>
                    </div><!-- /.progress -->
                </div> <!-- progress-section end -->

                <?php
                $progress = Config::getProgressNetworkDevelopment();
                ?>
                <div class="progress-section">
                    <span class="progress-title"><?= $progress['label'] ?></span>
                    <div class="progress">
                        <div class="progress-bar brand-bg progress-dot six-sec-ease-in-out" role="progressbar" aria-valuenow="<?= $progress['value'] ?>" aria-valuemin="0" aria-valuemax="100">
                            <span><?= $progress['value'] ?>%</span>
                        </div>
                    </div><!-- /.progress -->
                </div> <!-- progress-section end -->
            </div>

        </div><!-- /.row -->

    </div><!-- /.container -->
</section>

<?php if (!empty($clients)) : ?>
<section class="section-padding grid-news-hover grid-blog">
    <div class="container">
        <div class="text-center mb-80">
            <h2 class="section-title text-uppercase">Our Clients</h2>
            <p class="section-sub">Quisque non erat mi. Etiam congue et augue sed tempus. Aenean sed ipsum luctus, scelerisque ipsum nec, iaculis justo. Sed at vestibulum purus, sit amet viverra diam nulla ac nisi rhoncus.</p>
        </div>

        <div class="clients-grid grid-gutter">
            <div class="row">
                <div id="blogGrid">
                    <?php foreach ($clients as $client) : ?>
                        <div class="col-md-3 col-sm-6 blog-grid-item">
                            <article class="post-wrapper">
                                <div class="border-box">
                                    <?= Html::a(
                                            Html::img($client->getPhotoUrl(), ['alt' => $client->name]), 
                                            $client->website, 
                                            ['target' => '_blank']
                                    ) ?>
                                </div><!-- /.border-box -->
                            </article>
                        </div><!-- /.col-md-3 -->
                    <?php endforeach; ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.clients-grid -->

    </div><!-- /.container -->
</section>
<?php endif; ?>
