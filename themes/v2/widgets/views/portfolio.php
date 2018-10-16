<?php

use app\helpers\Url;
use kop\y2sp\ScrollPager;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

/* @var $portfolios ActiveDataProvider */

?>

<div class="port_menu_wrapper">
    <div class="section_heading">
        <h2><?= Yii::t('app', 'Works') ?></h2>
        <p><?= Yii::t('app', 'There are many versions of our portfolio online, where the visitor can follow the links to the details. We provide an overview and explanation of the each portfolios.') ?> </p>
    </div>
    <div class="portfolio-area">
        <div class="container">
            <div class="portfolio-filter clearfix text-center">
                <ul class="list-inline" id="filter">
                    <li><a class="active" data-group="all">All</a></li>
                    <?php foreach($services as $service) : ?>
                    <li><a data-group="<?= $service->slug ?>"><?= $service->name ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="row three-column">
                <?php if ($portfolios->getCount() == 0) : ?>

                    <div class="alert fade_info .fade">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <strong>Info Message: Portfolio is empty</strong>
                        <p><strong>Please contact us if the website there is a problem, thank you.</strong</p>
                    </div>

                <?php else: ?>

                    <?= ListView::widget([
                        'dataProvider' => $portfolios,
                        'layout' => '{items}',
                        'options' => [
                            'class' => 'clearfix',
                            'id' => 'gridWrapper'
                        ],
                        'itemOptions' => function ($model, $key, $index, $widget) {
                            $groups = $model->service ? $model->service->slug : '';
                            return [
                                'class' => 'col-xs-12 col-sm-6 col-md-6 col-lg-4 portfolio-wrapper',
                                'data-groups' => '["all", "'.$groups.'"]',
                                //'tag' => null,
                            ];
                        },
                        'itemView' => '_item-portfolio',
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