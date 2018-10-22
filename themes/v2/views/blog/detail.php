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
<div class="blog_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
                <article class="blog-post-wrapper clearfix">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="post-thumbnail">
                                <?= Html::img($postDetail->getPhotoUrl(), [
                                    'alt' => $postDetail->title,
                                    'class' => 'img-responsive',
                                ]) ?>
                            </div>
                            <!-- /.post-thumbnail -->

                            <div class="blog-content">
                                <header class="entry-header">
                                    <h4 class="entry-title"><a href="#"><?= $postDetail->title ?></a></h4>
                                    <div class="entry-meta">
                                        <ul>
                                            <li><span class="author">By <a href="#"><?= $createdBy->getName() ?></a></span>
                                            </li>
                                            <li><span class="posted-date"><a href="#"><?= $createdBy->getName() ?></a></span>
                                            </li>
                                            <li><span class="posted-in">In <a href="#">Web Design</a></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.entry-meta -->
                                </header>
                                <!-- /.entry-header -->

                                <div class="entry-content">
                                    <?= $postDetail->content ?>
                                </div>
                                <!-- /.entry-content -->

                            </div>
                            <!-- /.blog-content -->
                        </div>
                     </div>
                </article>

                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">	
                    <div class="blog_post_bottom_wrapper">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12">
                                    <div class="tags">
                                        <i class="fa fa-tags" aria-hidden="true"></i> 
                                        Tags:
                                        <?php 
                                        foreach ($postDetail->blogPostTags as $tag) {
                                            echo Html::a($tag->blogTag->name, $tag->blogTag->getUrl());
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12">
                                    <div class="share_icons">
                                        Share:
                                        <a href="javascript:void(0);" onclick="CenterWindow(1000,800,50,'https://www.facebook.com/sharer/sharer.php?u=<?= $postDetail->getDetailUrl(true) ?>','demo_win');"><i class="fa fa-facebook"></i></a>
                                        <a href="javascript:void(0);" onclick="CenterWindow(1000,800,50,'https://twitter.com/intent/tweet?url=<?= $postDetail->getDetailUrl(true) ?>','demo_win');"><i class="fa fa-twitter"></i></a>
                                        <a href="javascript:void(0);" onclick="CenterWindow(1000,800,50,'https://plus.google.com/share?url=<?= $postDetail->getDetailUrl(true) ?>','demo_win');"><i class="fa fa-google" aria-hidden="true"></i> </a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
                <?= BlogSidebarWidget::widget(['model' => $postDetail]) ?>
            </div>
        </div>
    </div>
</div>

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