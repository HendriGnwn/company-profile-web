<?php

use app\components\View;
use app\helpers\FormatConverter;
use app\models\BlogPost;
use app\models\BlogTag;
use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this View */
/* @var $blogPosts BlogPost */
/* @var $blogTag BlogTag */

$this->title = $blogTag->name;
$this->params['breadcrumbs'][] = ['label' => 'Blog', 'url' =>['/blog/index']];
$this->params['breadcrumbs'][] = 'Tag: ' . $this->title;

$metakey = 'Blog Build web and network, tutorials, tips, workshop, project development, PT Qelopak Teknologi Indonesia';
$description = 'This is a list Blog Posts tag '.$this->title.', you will be know about us in here';

/** SEO */
$this->registerMetaTag([
    'http-equiv' => 'Content-Type',
    'content' => 'text/html; charset=utf-8'
]);
$this->registerLinkAlternate();
$this->registerLinkCanonical();
$this->registerMetaTitle();
$this->registerMetaKeywords($metakey);
$this->registerMetaDescription($description);
$this->registerMetaTag(['name' => 'robots',  'content' => 'index,follow']);
$this->registerMetaTag(['name' => 'googlebot',  'content' => 'index,follow']);
$socialMedia = [
    'title' => $this->title,
    'description' => $description,
];
$this->registerMetaSocialMedia($socialMedia);
$this->registerCssFile('/themes/v2/css/blog_style_6.css');
$this->registerCss("
.grid {
  display: grid;
  grid-gap: 20px;
  grid-template-columns: repeat(auto-fill, minmax(333px,1fr));
  grid-auto-rows: 20px;
}
");
$this->registerJs("
function resizeGridItem(item){
  grid = document.getElementsByClassName('grid')[0];
  rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
  rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap'));
  rowSpan = Math.ceil((item.querySelector('.blog-post-wrapper').getBoundingClientRect().height+rowGap)/(rowHeight+rowGap));
    item.style.gridRowEnd = 'span '+rowSpan;
}

function resizeAllGridItems(){
  allItems = document.getElementsByClassName('item');
  for(x=0;x<allItems.length;x++){
    resizeGridItem(allItems[x]);
  }
}

function resizeInstance(instance){
	item = instance.elements[0];
  resizeGridItem(item);
}

window.onload = resizeAllGridItems();
window.addEventListener('resize', resizeAllGridItems);

allItems = document.getElementsByClassName('item');
for(x=0;x<allItems.length;x++){
  imagesLoaded( allItems[x], resizeInstance);
}   
");

?>
<div class="blog_section">
    <div class="container">
        
        <?php if (empty($blogPosts)) { ?>
        <div class="alert fade_info fade">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <strong><?= Yii::t('app', 'Information: Blog is empty') ?></strong>
        </div>
        
        <?php } else { ?>

        <div class="grid">
            <?php foreach ($blogPosts as $post) : ?>
            <div class="item blog">
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
</div>