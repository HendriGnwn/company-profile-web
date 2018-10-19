<?php

use app\components\View;
use app\helpers\FormatConverter;
use app\models\BlogPost;
use app\widgets\BlogSidebarWidget;
use kartik\social\Disqus;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this View */
/* @var $postDetail BlogPost */

$this->title = $postDetail->title;
$this->params['breadcrumbs'][] = ['label' => 'Blog', 'url' =>['/blog/index']];
$this->params['breadcrumbs'][] = 'Detail';
$this->params['breadcrumbs'][] = $this->title;

$description = $postDetail->metadesc;

/** SEO */
$this->registerMetaTag([
    'http-equiv' => 'Content-Type',
    'content' => 'text/html; charset=utf-8'
]);
$this->registerLinkAlternate();
$this->registerLinkCanonical();
$this->registerMetaTitle();
$this->registerMetaKeywords($postDetail->metakey);
$this->registerMetaDescription($description);
$this->registerMetaTag(['name' => 'robots',  'content' => 'index,follow']);
$this->registerMetaTag(['name' => 'googlebot',  'content' => 'index,follow']);
$socialMedia = [
    'title' => $this->title,
    'description' => $description,
    'image' => $postDetail->getPhotoUrl()
];
$this->registerMetaSocialMedia($socialMedia);

$createdBy = $postDetail->createdBy;
$imgAuthor = $createdBy->userProfile->getPhotoUrl() ? $createdBy->userProfile->getPhotoUrl() : ['data/img/working-man.png'];

?>
<!-- blog section start -->
<section class="blog-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="posts-content single-post">

                    <article class="post-wrapper">

                        <header class="entry-header-wrapper clearfix">

                            <div class="author-thumb waves-effect waves-light">
                                <?= Html::a(
                                    Html::img($imgAuthor, ['alt'=>$createdBy->getName()]),
                                    '#'
                                ) ?>
                            </div>

                            <div class="entry-header">
                                <h2 class="entry-title"><?= $postDetail->title ?></h2>

                                <div class="entry-meta">
                                    <ul class="list-inline">
                                        <li>
                                            <i class="fa fa-user"></i><?= $createdBy->getName() ?>
                                        </li>

                                        <li>
                                            <i class="fa fa-clock-o"></i><?= FormatConverter::dateFormat($postDetail->post_date, 'M d, Y H:i A') ?>
                                        </li>

                                        <li>
                                            <i class="fa fa-heart-o"></i><a href="#"><span>1</span></a>
                                        </li>

                                        <li>
                                            <i class="fa fa-comment-o"></i><a href="#">3</a>
                                        </li>
                                    </ul>
                                </div><!-- .entry-meta -->
                            </div>

                        </header><!-- /.entry-header-wrapper -->

                        <div class="thumb-wrapper">
                            <?= Html::img($postDetail->getPhotoUrl(), [
                                        'alt' => $postDetail->title,
                                        'class' => 'img-responsive',
                                    ]) ?>
                        </div><!-- .post-thumb -->


                        <div class="entry-content">
                            <?= $postDetail->content ?>
                        </div><!-- .entry-content -->


                        <footer class="entry-footer">
                            <div class="post-tags">
                                <span class="tags-links">
                                    <i class="fa fa-tags"></i>
                                    <?php 
                                    foreach ($postDetail->blogPostTags as $tag) {
                                        echo Html::a($tag->blogTag->name, $tag->blogTag->getUrl());
                                    }
                                    ?>
                                </span>
                            </div> <!-- .post-tags -->

                            <ul class="list-inline right share-post">
                                <li><a href="javascript:void(0)" onclick="CenterWindow(1000,800,50,'https://www.facebook.com/sharer/sharer.php?u=<?= $postDetail->getDetailUrl(true) ?>','demo_win');"><i class="fa fa-facebook"></i> <span>Share</span></a>
                                </li>
                                <li><a href="javascript:void(0)" onclick="CenterWindow(1000,800,50,'https://twitter.com/intent/tweet?url=<?= $postDetail->getDetailUrl(true) ?>','demo_win');"><i class="fa fa-twitter"></i> <span>Tweet</span></a>
                                </li>
                                <li><a href="javascript:void(0)" onclick="CenterWindow(1000,800,50,'https://plus.google.com/share?url=<?= $postDetail->getDetailUrl(true) ?>','demo_win');"><i class="fa fa-google-plus"></i> <span>Plus</span></a>
                                </li>
                            </ul>
                        </footer>

                    </article><!-- /.post-wrapper -->

                    <?= Disqus::widget(['settings'=>['title'=>$postDetail->title, 'identifier'=>$postDetail->slug, 'url'=>$postDetail->getDetailUrl(true)]]) ?>

                </div><!-- /.posts-content -->
            </div><!-- /.col-md-8 -->

            <div class="col-md-4">
                <?= BlogSidebarWidget::widget(['model' => $postDetail]) ?>
            </div><!-- /.col-md-4 -->

        </div><!-- /.row -->
    </div><!-- /.container -->
</section>
<!-- blog section end -->

<?php
$this->registerJs("
    function CenterWindow(windowWidth, windowHeight, windowOuterHeight, url, wname, features) {
        var centerLeft = parseInt((window.screen.availWidth - windowWidth) / 2);
        var centerTop = parseInt(((window.screen.availHeight - windowHeight) / 2) - windowOuterHeight);

        var misc_features;
        if (features) {
          misc_features = ', ' + features;
        }
        else {
          misc_features = ', status=no, location=no, scrollbars=yes, resizable=yes';
        }
        var windowFeatures = 'width=' + windowWidth + ',height=' + windowHeight + ',left=' + centerLeft + ',top=' + centerTop + misc_features;
        var win = window.open(url, wname, windowFeatures);
        win.focus();
        return win;
    }

", yii\web\View::POS_END);