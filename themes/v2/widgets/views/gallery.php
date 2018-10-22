<?php

use app\helpers\Url;
use kop\y2sp\ScrollPager;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

$this->registerCssFile('/themes/v2/css/portfolio_masonry_style_1.css');

/* @var $galleries ActiveDataProvider */

?>

<div class="port_menu_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-xs-12 col-sm-12 col-lg-offset-2">
                <div class="section_heading">
                    <h2><?= Yii::t('app', 'Works') ?></h2>
                    <span class="bordered-icon"><i class="fa fa-square"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-area">
        <div class="container">
            <div class="portfolio-filter clearfix text-center">
                <ul class="list-inline" id="filter">
                    <li><a class="active" data-group="all">All</a></li>
                    <?php foreach($categories as $category) : ?>
                    <li><a data-group="<?= $category->slug ?>"><?= $category->name ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="row three-column">
                <?php if ($galleries->getCount() == 0) : ?>

                    <div class="alert fade_info .fade">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <strong>Info Message: Portfolio is empty</strong>
                        <p><strong>Please contact us if the website there is a problem, thank you.</strong</p>
                    </div>

                <?php else: ?>

                    <?= ListView::widget([
                        'dataProvider' => $galleries,
                        'layout' => '{items}',
                        'options' => [
                            'class' => 'clearfix',
                            'id' => 'gridWrapper'
                        ],
                        'itemOptions' => function ($model, $key, $index, $widget) {
                            $groups = $model->getListCategorySlugs();
                            return [
                                'class' => 'col-xs-12 col-sm-6 col-md-6 col-lg-4 portfolio-wrapper',
                                'data-groups' => json_encode($groups),
                                //'tag' => null,
                            ];
                        },
                        'itemView' => '_item-gallery',
                        'pager' => [
                            'class' => ScrollPager::className(),
                            'container' => '.portfolio-container',
                            'item' => '.portfolio_img_wrapper',
                            //'paginationSelector' => '.portfolio .pagination',
                            'triggerText' => 'View All',
                            'triggerTemplate' => '<div class="load-more-button text-center"><a class="waves-effect waves-light btn mt-30"> <i class="fa fa-spinner left"></i> {text}</a></div>',
                            'spinnerSrc' => Url::to(['data/img/spinner.gif']),
                            'spinnerTemplate' => '<div class="load-more-button text-center"><a class="waves-effect waves-light btn mt-30"><img src="{src}"/></a></div>',
                            'noneLeftText' => '',
                            //'noneLeftTemplate' => '<div class="load-more-button text-center"><a class="waves-effect waves-light btn mt-30">{text}</a></div>',
    //                        'eventOnLoaded' => "function(data, items) {
    //                            $('.portfolio').append(items);
    //                            $('.portfolio').shuffle({
    //                                itemSelector: '.portfolio-item'
    //                            });
    //                            $('.portfolio').shuffle('appended', items);
    //                        }",
                        ],

                   ]) ?>

                <?php endif; ?>

                <!--</div>-->
                <!--/#gridWrapper-->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
</div>