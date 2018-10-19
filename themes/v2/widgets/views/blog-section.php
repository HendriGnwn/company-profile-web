<?php

use app\models\BlogPost;
use app\helpers\FormatConverter;
use yii\helpers\Html;

$this->registerCssFile('themes/v2/css/blog_style_6.css');

/* @var $blogPosts BlogPost */

?>

<!-- blog_section start -->
<div class="blog_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-xs-12 col-sm-12 col-lg-offset-2">
                <div class="section_heading">
                    <h2><?= Yii::t('app', 'Latest Blog Posts') ?></h2>
                    <span class="bordered-icon"><i class="fa fa-square"></i></span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="row">
                    <?php foreach($blogPosts as $post) : ?>
                    <div class="col-lg-46 col-md-4 col-sm-12 col-xs-12">
                        <article class="blog-post-wrapper clearfix">
                            <div class="post-thumbnail">
                                <?= $post->getPhotoImg() ?>

                                <div class="posted-date">
                                    <span class="day"><?= FormatConverter::dateFormat($post->post_date, 'd') ?></span>
                                    <span class="month"><?= FormatConverter::dateFormat($post->post_date, 'M') ?></span>
                                </div>
                            </div>
                            <!-- /.post-thumbnail -->

                            <div class="blog-content">
                                <header class="entry-header">
                                    <h4 class="entry-title">
                                        <?= Html::a($post->title, $post->getDetailUrl()) ?>
                                    </h4>
                                    <div class="entry-meta">
                                        <ul>
                                            <li><span class="author"><?= Yii::t('app', 'By') ?> <a href="#"><?= $post->createdBy ? $post->createdBy->username : 'Anonymous' ?></a></span>
                                            </li>
                                            <li><span class="posted-in"><?= Yii::t('app', 'In') ?> <a href="#"><?= Html::a($post->blogCategory->name, $post->blogCategory->getUrl()) ?></a></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.entry-meta -->
                                </header>
                                <!-- /.entry-header -->

                                <div class="entry-content">
                                    <p><?= $post->lead_text ?></p>
                                </div>
                                <!-- /.entry-content -->
                            </div>
                            <!-- /.blog-content -->

                            <div class="entry-footer clearfix">
                                <ul class="entry-meta pull-left">
                                </ul>
                                <?= Html::a('<i class="fa fa-long-arrow-right"></i> More', $post->getDetailUrl(), ['class' => 'readmore pull-right']) ?>
                            </div>
                            <!-- /.entry-footer -->
                        </article>
                    </div>
                    <?php endforeach; ?>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
<!-- blog_section end -->