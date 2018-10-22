<?php

use app\components\View;
use app\models\BlogPost;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $postDetail BlogPost */

$this->title = Yii::t('app', 'Change Password');
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
$this->registerCssFile('/themes/v2/css/login_and_register.css');
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
                            <?php
                            $form = ActiveForm::begin([
                                'action' => ['/member/change-password'],
                                'id' => 'member-change-password-form',
                                'options' => [
                                    'class' => 'clearfix',
                                ],
                                'fieldConfig' => [
                                    'template' => "\n{label}\n{input}\n{error}",
                                    'labelOptions' => ['class' => 'sr-only'],
                                    'inputOptions' => ['class' => 'form-control'],
                                    'errorOptions' => ['style' => 'margin-top: 0px; position:absolute !important;color:#fff !important;font-weight:normal !important;', 'class' => 'help-block help-block-error label label-danger'],
                                ]
                            ]);
                            ?>
                            <!-- login_wrapper -->
                            <div class="login_wrapper">
                                
                                <div class="formsix-pos">
                                    <?= $form->field($model, 'current_password')
                                        ->passwordInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('current_password')]) ?>
                                </div>
                                <div class="formsix-e">
                                    <?= $form->field($model, 'new_password')
                                        ->passwordInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('new_password')]) ?>
                                </div>
                                <div class="formsix-e">
                                    <?= $form->field($model, 'confirm_password')
                                        ->passwordInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('confirm_password')]) ?>
                                </div>
                                <div class="login_btn_wrapper">
                                    <?= Html::submitButton(Yii::t('app', 'Change'), ['class' => 'btn btn-primary login_btn']) ?>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                            <!-- /.login_wrapper-->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
