<?php

use app\models\BlogPost;
use app\helpers\FormatConverter;
use yii\helpers\Html;

/* @var $blogPosts BlogPost */

?>

<!-- blog_section start -->
<div class="blog_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-xs-12 col-sm-12 col-lg-offset-2">
                <div class="section_heading">
                    <h2><?= Yii::t('app', 'Latest Blog Posts') ?></h2>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="row">
                    <?php foreach($blogPosts as $post) : ?>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <article class="blog-post-wrapper clearfix">
                            <div class="post-thumbnail">
                                <?= $post->getPhotoImg() ?>
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
                                            <li><span class="posted-date"><a href="#"><?= FormatConverter::dateFormat($post->post_date, 'd M Y') ?></a></span>
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
                                    <a class="readmore_btn" href="#"> More</a>
                                </div>
                                <!-- /.entry-content -->

                            </div>
                            <!-- /.blog-content -->
                            
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