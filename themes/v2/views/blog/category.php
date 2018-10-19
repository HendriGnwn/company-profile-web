<?php

use app\components\View;
use app\helpers\FormatConverter;
use app\models\BlogCategory;
use app\models\BlogPost;
use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this View */
/* @var $blogPosts BlogPost */
/* @var $blogCategory BlogCategory */

$this->title = $blogCategory->name;
$this->params['breadcrumbs'][] = ['label' => 'Blog', 'url' =>['/blog/index']];
$this->params['breadcrumbs'][] = Yii::t('app.label', 'Category');
$this->params['breadcrumbs'][] = $this->title;

$description = $blogCategory->metadesc;

/** SEO */
$this->registerMetaTag([
    'http-equiv' => 'Content-Type',
    'content' => 'text/html; charset=utf-8'
]);
$this->registerLinkAlternate();
$this->registerLinkCanonical();
$this->registerMetaTitle();
$this->registerMetaKeywords($blogCategory->metakey);
$this->registerMetaDescription($description);
$this->registerMetaTag(['name' => 'robots',  'content' => 'index,follow']);
$this->registerMetaTag(['name' => 'googlebot',  'content' => 'index,follow']);
$socialMedia = [
    'title' => $this->title,
    'description' => $description,
];
$this->registerMetaSocialMedia($socialMedia);

?>
<section class="section-padding grid-news-hover grid-blog">
    <div class="container">
        
        <?php if (empty($blogPosts)) { ?>
        <div class="alert alert-box info-box col-xs-12" role="alert">

            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>

            <div class="icon-wrap">
                <i class="fa fa-check-circle-o"></i>
            </div><!-- /.icon-wrap -->

            <div class="info-wrap">
                <strong>Info Message: Blog is empty</strong>
                <span>Please subscribe us for get the blog updates</span>
            </div><!-- /.info-wrap -->
        </div>
        
        <?php } else { ?>

        <div class="row">
            <div id="blogGrid">
                
                <?php foreach ($blogPosts as $post) : ?>
                <div class="col-xs-12 col-sm-6 col-md-4 blog-grid-item">
                    <article class="post-wrapper">

                        <div class="thumb-wrapper waves-effect waves-block waves-light">
                            <?= Html::a(
                                    Html::img($post->getPhotoUrl(), [
                                        'alt' => $post->title,
                                        'class' => 'img-responsive',
                                    ]),
                                    $post->getDetailUrl(),
                                    []
                                ) ?>
                            <div class="post-date">
                                <?= FormatConverter::dateFormat($post->post_date, 'd') ?><span><?= FormatConverter::dateFormat($post->post_date, 'M') ?></span>
                            </div>
                        </div><!-- .post-thumb -->

                        <div class="blog-content">

                            <div class="hover-overlay light-blue"></div>

                            <header class="entry-header-wrapper">
                                <div class="entry-header">
                                    <h2 class="entry-title">
                                        <?= Html::a($post->title, $post->getDetailUrl()) ?>
                                    </h2>

                                    <div class="entry-meta">
                                        <ul class="list-inline">
                                            <li>
                                                By <a href="#"><?= $post->createdBy ? $post->createdBy->username : 'Anonymous' ?></a>
                                            </li>
                                            <li>
                                                In <?= Html::a($post->blogCategory->name, $post->blogCategory->getUrl()) ?>
                                            </li>
                                        </ul>
                                    </div><!-- .entry-meta -->
                                </div><!-- /.entry-header -->
                            </header><!-- /.entry-header-wrapper -->

                            <div class="entry-content">
                                <p><?= $post->lead_text ?></p>
                            </div><!-- .entry-content -->

                        </div><!-- /.blog-content -->

                    </article><!-- /.post-wrapper -->
                </div><!-- /.col-md-4 -->
                <?php endforeach; ?>

            </div><!-- /#blogGrid -->
        </div><!-- /.row -->
        
        <?php } ?>
        
        <?= LinkPager::widget([
            'pagination' => $pages,
            'options' => [
                'class' => 'pagination post-pagination text-center mt-50',
            ],
            'linkOptions' => [
                'class' => 'waves-effect waves-light',
            ],
            'disabledPageCssClass' => 'waves-effect waves-light',
            'activePageCssClass' => 'current',
        ]) ?>


    </div><!-- /.container -->
</section>
<!-- Grid News End -->