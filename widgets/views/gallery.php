<?php

use app\helpers\Url;
use kop\y2sp\ScrollPager;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

/* @var $portfolios ActiveDataProvider */

?>

<section class="section-padding">
    <div class="container">

        <div class="text-center mb-50">
            <h2 class="section-title text-uppercase">Works</h2>
            <p class="section-sub">There are many versions of our portfolio online, where the visitor can follow the links to the details. We provide an overview and explanation of the each portfolios. </p>
        </div>

        <div class="portfolio-container text-center">
            <ul class="portfolio-filter brand-filter">
                <li class="active waves-effect waves-light" data-group="all">All</li>
                <?php foreach($services as $service) : ?>
                    <li class="waves-effect waves-light" data-group="<?= $service->slug ?>"><?= $service->name ?></li>
                <?php endforeach; ?>
            </ul>
            
            <?php if ($portfolios->getCount() == 0) : ?>
                
                <div class="alert alert-box info-box col-xs-12 mt-50" role="alert">

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>

                    <div class="icon-wrap">
                        <i class="fa fa-check-circle-o"></i>
                    </div><!-- /.icon-wrap -->

                    <div class="info-wrap">
                        <strong>Info Message: Portfolio is empty</strong>
                        <span>Please contact us if the website there is a problem, thank you.</span>
                    </div><!-- /.info-wrap -->
                </div>
            
            <?php else: ?>
            
                <?= ListView::widget([
                    'dataProvider' => $portfolios,
                    'layout' => '{items}',
                    'options' => [
                        'class' => 'portfolio portfolio-with-title col-3 gutter mt-50',
                    ],
                    'itemOptions' => function ($model, $key, $index, $widget) {
                        $groups = $model->service ? $model->service->slug : 'all';
                        return [
                            'class' => 'portfolio-item',
                            'data-groups' => '["'.$groups.'"]',
                            //'tag' => null,
                        ];
                    },
                    'itemView' => '_item-portfolio',
                    'pager' => [
                        'class' => ScrollPager::className(),
                        'container' => '.portfolio-container',
                        'item' => '.portfolio-item',
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

        </div><!-- portfolio-container -->

    </div><!-- /.container -->
</section>