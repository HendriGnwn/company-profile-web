<?php

use app\helpers\FormatConverter;
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
<div class="sidebar_widget">
    <h4>Search Feed</h4>
    <?= Html::beginForm(['/blog/search'], 'get', ['class'=>'search_form']) ?>
    <?= Html::input('text', 'query', null, ['placeholder'=>'Write any keywords', 'class'=>'form-control']) ?>
    <?= Html::submitButton('<i class=\'fa fa-search\'></i>') ?>
    <?= Html::endForm() ?>
</div>
<div class="sidebar_widget">
    <h4>Categories</h4>
    <div class="archives_wrapper">
        <?= Menu::widget([
            'items' => $blogCategories,
            'linkTemplate' => '<a href="{url}">{label}</a>',
        ]) ?>
    </div>
</div>
<div class="sidebar_widget">
    <h4>Latest Post</h4>
    <div class="latest_post_wrapper">
        <?php foreach ($latestBlogs as $blog) : ?>
            <div class="blog_wrapper1">
                <div class="blog_image">
                    <?= Html::a(
                        Html::img($blog->getPhotoUrl(), ['alt' => $blog->title, 'class' => 'img-responsive']),
                        $blog->getDetailUrl()
                    ) ?>
                </div>
                <div class="blog_text">
                    <h5>
                        <?= Html::a(
                            $blog->title,
                            $blog->getDetailUrl()
                        ) ?>
                    </h5>
                    <div class="blog_date"><i class="fa fa-calendar-o" aria-hidden="true"></i><?= FormatConverter::dateFormat($blog->post_date, 'M d, Y') ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="sidebar_widget">
    <h4>Tags Cloud</h4>
    <div class="tag_cloud_wrapper">
        <ul>
            <?php foreach($tags as $tag): ?>
            <li>
                <?= Html::a($tag->blogTag->name, $tag->blogTag->getUrl()) ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>