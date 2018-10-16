<?php

use app\models\BlogPost;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\Menu;

/* @var $latestBlogs BlogPost */
/* @var $model BlogPost */
/* @var $createdBy User */

$createdBy = $model->createdBy;

$imgAuthor = $createdBy->userProfile->getPhotoUrl() ? $createdBy->userProfile->getPhotoUrl() : ['data/img/working-man.png'];
$imgBackgroundAuthor = $createdBy->userProfile->getPhotoBackgroundUrl() ? $createdBy->userProfile->getPhotoBackgroundUrl() : ['themes/v1/img/blog/author-large-thumb.jpg'];

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="tt-sidebar-wrapper" role="complementary">
    <div class="widget widget_search">
        <?= Html::beginForm(['/blog/search'], 'get', ['class'=>'search-form']) ?>
        <?= Html::input('text', 'query', null, ['placeholder'=>'Write any keywords', 'class'=>'form-control']) ?>
        <?= Html::submitButton('<i class=\'fa fa-search\'></i>') ?>
        <?= Html::endForm() ?>
    </div><!-- /.widget_search -->


    <div class="widget widget_tt_author_widget">

        <div class="author-info-wrapper">

            <div class="author-cover">
                <?= Html::img($imgBackgroundAuthor, ['alt'=>$createdBy->getName()]) ?>
            </div>

            <div class="author-avatar">
                <?= Html::img($imgAuthor, ['alt'=>$createdBy->getName()]) ?>

                <h2><?= $createdBy->getName() ?></h2>
                <span><?= $createdBy->userProfile->proffesional ?></span>
            </div>

            <p><?= $createdBy->userProfile->bio ?></p>

            <div class="author-social-links">
                <ul class="list-inline">
                    <?php
                    $facebook = $createdBy->userProfile->social_facebook ? $createdBy->userProfile->social_facebook : '#';
                    $twitter = $createdBy->userProfile->social_twitter ? $createdBy->userProfile->social_twitter : '#';
                    $linkedIn = $createdBy->userProfile->social_linked_in ? $createdBy->userProfile->social_linked_in : '#';
                    $dribbble = $createdBy->userProfile->social_dribbble ? $createdBy->userProfile->social_dribbble : '#';
                    $email = $createdBy->userProfile->social_email ? 'mailto:'.$createdBy->userProfile->social_email : '#';
                    ?>
                    <li><?= Html::a('<i class=\'fa fa-facebook\'></i>', $facebook, ['target' => '_blank']) ?></li>
                    <li><?= Html::a('<i class=\'fa fa-twitter\'></i>', $twitter, ['target' => '_blank']) ?></li>
                    <li><?= Html::a('<i class=\'fa fa-linkedin\'></i>', $linkedIn, ['target' => '_blank']) ?></li>
                    <li><?= Html::a('<i class=\'fa fa-dribbble\'></i>', $dribbble, ['target' => '_blank']) ?></li>
                    <li><?= Html::a('<i class=\'fa fa-envelope-o\'></i>', $email, ['target' => '_blank']) ?></li>
                </ul>
            </div>
        </div> <!-- /author-info-wrapper -->
    </div><!-- /.widget_tt_author_widget -->


    <div  class="widget widget_tt_popular_post">
        <div class="tt-popular-post border-bottom-tab">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tt-popular-post-tab1" data-toggle="tab" aria-expanded="true">Latest</a>
                </li>
                <li class="">
                    <a href="#tt-popular-post-tab2" data-toggle="tab" aria-expanded="false">Popular</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <!-- latest post tab -->
                <div id="tt-popular-post-tab1" class="tab-pane fade active in">
                    
                    <?php foreach ($latestBlogs as $blog) : ?>
                        <div class="media">
                            <?= Html::a(
                                Html::img($blog->getPhotoUrl(), ['alt' => $blog->title]),
                                $blog->getDetailUrl(),
                                [
                                    'class' => 'media-left'
                                ]
                            ) ?>
                            <div class="media-body">
                                <h4><a href="#"><?= $blog->title ?></a></h4>
                            </div> <!-- /.media-body -->
                        </div> <!-- /.media -->
                    <?php endforeach; ?>

                </div>

                <!-- popular post tab-->
                <div id="tt-popular-post-tab2" class="tab-pane fade">

                    <?php foreach ($latestBlogs as $blog) : ?>
                        <div class="media">
                            <?= Html::a(
                                Html::img($blog->getPhotoUrl(), ['alt' => $blog->title]),
                                $blog->getDetailUrl(),
                                [
                                    'class' => 'media-left'
                                ]
                            ) ?>
                            <div class="media-body">
                                <h4><a href="#"><?= $blog->title ?></a></h4>
                            </div> <!-- /.media-body -->
                        </div> <!-- /.media -->
                    <?php endforeach; ?>

                </div>
            </div><!-- /.tab-content -->
        </div><!-- /.tt-popular-post -->
    </div><!-- /.widget_tt_popular_post -->


    <div class="widget widget_categories">
        <h3 class="widget-title">Categories</h3>
        <?= Menu::widget([
            'items' => $blogCategories,
        ]) ?>
    </div><!-- /.widget_categories -->


    <div class="widget widget_tt_twitter">
        <i class="fa fa-twitter"></i>
        <div id="twitter-gallery-feed">
            <div class="twitter-widget"></div> <!-- this div is required for carousel injected by javascript -->
            <!-- html code injected via javascript -->
        </div>

    </div><!-- /.widget_tt_twitter -->


<!--    <div class="widget widget_tt_instafeed">
        <i class="fa fa-instagram"></i>
        <h3 class="widget-title">Instagram Photos</h3>

        <div id="myinstafeed">
             html code injected via javascript 
        </div> 

    </div> /.widget_tt_instafeed -->

</div><!-- /.tt-sidebar-wrapper -->