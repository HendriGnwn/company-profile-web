<?php

use app\components\View;
use app\models\BlogPost;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $postDetail BlogPost */

$this->title = Yii::t('app', 'Profile');
$this->params['breadcrumbs'][] = ['label' => 'Member', 'url' =>['#']];
$this->params['breadcrumbs'][] = $this->title;

$metakey  = $metadesc = '';

/** SEO */
$this->registerMetaTag([
    'http-equiv' => 'Content-Type',
    'content' => 'text/html; charset=utf-8'
]);
$this->registerLinkAlternate();
$this->registerLinkCanonical();
$this->registerMetaTitle();
$this->registerMetaKeywords($metakey);
$this->registerMetaDescription($metadesc);
$this->registerMetaTag(['name' => 'robots',  'content' => 'index,follow']);
$this->registerMetaTag(['name' => 'googlebot',  'content' => 'index,follow']);
$socialMedia = [
    'title' => $this->title,
    'description' => $metadesc
];
$this->registerMetaSocialMedia($socialMedia);
$this->registerCssFile('/themes/v2/css/tab.css');
?>

<div class="blog_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div role="tabpanel">

                    <!-- Nav tabs -->
                    <?= $this->render('_menu') ?>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade animated slideInRight active in" id="contentTwo-1">
                            <br/>
                            <table class="table table-condensed table-striped table-hover">
                                <tr>
                                    <th width='30%'><?= $model->getAttributeLabel('branch_id') ?></th>
                                    <td><?= $branch->name ?></td>
                                </tr>
                                <tr>
                                    <th width='30%'><?= $branch->getAttributeLabel('description') ?></th>
                                    <td><?= $branch->description ?></td>
                                </tr>
                                <tr>
                                    <th width='30%'><?= $branch->getAttributeLabel('address') ?></th>
                                    <td><?= $branch->address ?></td>
                                </tr>
                                <tr>
                                    <th width='30%'><?= $branch->getAttributeLabel('province_id') ?></th>
                                    <td><?= $branch->province->name ?></td>
                                </tr>
                                <tr>
                                    <th width='30%'><?= $branch->getAttributeLabel('regency_id') ?></th>
                                    <td><?= $branch->regency->name ?></td>
                                </tr>
                                <tr>
                                    <th width='30%'><?= $branch->getAttributeLabel('district_id') ?></th>
                                    <td><?= $branch->district->name ?></td>
                                </tr>
                                <tr>
                                    <th width='30%'><?= $branch->getAttributeLabel('postal_code') ?></th>
                                    <td><?= $branch->postal_code ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
