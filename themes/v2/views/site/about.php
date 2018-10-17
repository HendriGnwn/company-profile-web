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

<div class="section_heading">
    <h2><?= Yii::t('app', 'Works') ?></h2>
    <p><?= Yii::t('app', 'There are many versions of our portfolio online, where the visitor can follow the links to the details. We provide an overview and explanation of the each portfolios.') ?> </p>
</div>
<div class="text_wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
					<div class="text_wrapper_content">
						<h3>Website Builder Kit</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut tempus orci, in dignissim erat. Mauris at ullamcorper dolor. Integer hendrerit lectus ut lectus consectetur, a semper enim facilisis. Duis velit erat, viverra pharetra quam efficitur, pellentesque hendrerit nunc. Ut vitae aliquam tellus. Ut lacinia leo et dui ornare interdum. Etiam viverra placerat mi nec suscipit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras accumsan eget eros volutpat ullamcorper. Duis eget risus pulvinar, consectetur nisi id, mollis massa. Nulla porta ut risus vel interdum. Nunc sit amet mollis magna. Phasellus facilisis odio nec eros dapibus mollis.</p>
						<p>Nullam ac magna vitae ex ultrices ornare quis ac est. Nam ex ante, aliquet non mollis id, convallis vitae ex. Cras consequat, lectus nec rutrum dictum, purus ligula ultrices massa, nec eleifend dui dolor at turpis. Proin sit amet sollicitudin nunc, ut pharetra sem. Praesent dictum ullamcorper auctor. Phasellus vitae dui scelerisque, finibus nibh et, lacinia orci. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi lobortis dolor mi, eget vehicula magna egestas a. Aliquam aliquet lobortis elit, vitae sodales est hendrerit eget. Suspendisse erat neque, posuere id ipsum nec, consequat sagittis ipsum. Pellentesque metus sapien, finibus et scelerisque in, porttitor non urna.</p>
						<p>Nullam ornare, dolor sed imperdiet facilisis, metus turpis porta metus, non placerat nulla eros non quam. Maecenas rutrum ante est, non imperdiet tortor accumsan ut. Aliquam gravida purus elit, tempor tristique elit lobortis eu. Aenean in gravida ipsum. Nullam non nunc non nibh laoreet semper. Praesent nec molestie ante, eget commodo felis. Praesent mattis posuere mattis. Aenean ornare augue massa, vel auctor lectus tristique vel. Sed efficitur sapien ac mauris lacinia aliquet sed sed tellus. Suspendisse dictum, augue eget aliquam interdum, magna massa elementum turpis, vel pulvinar mi lorem quis nisi.</p>
						<p>Maecenas in mauris at diam eleifend fringilla. Sed viverra tellus ac varius molestie. Nunc ut nulla a risus elementum luctus vel id tellus. Morbi porttitor mi ut pellentesque aliquam. Cras gravida et neque sit amet luctus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam in sapien laoreet, pharetra neque a, aliquet eros. Sed nec nibh nunc. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut felis erat, sodales eu venenatis sit amet, luctus non felis. Nullam elementum elementum dolor, vel aliquam metus rutrum sed.</p>
						<p>Vivamus mattis enim eros, ac tempus orci congue in. Nunc tincidunt mattis blandit. Sed ornare finibus nulla, vitae sagittis nisl viverra nec. Phasellus in eros a lectus viverra sollicitudin. Donec dapibus eros erat, vel consectetur libero sollicitudin nec. Aliquam erat volutpat. Nam vitae sagittis ipsum. Proin elementum sapien augue. Ut vel sodales tortor, ac scelerisque nulla. Nam massa velit, pulvinar a dapibus at, tincidunt at libero.</p>
						<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

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
