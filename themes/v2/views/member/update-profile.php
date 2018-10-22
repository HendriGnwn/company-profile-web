<?php

use app\components\View;
use app\models\BlogPost;
use app\models\Provinces;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $postDetail BlogPost */

$this->title = Yii::t('app', 'Update Profile');
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
                                'action' => ['/member/update-profile'],
                                'id' => 'member-signup-form',
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
                                <?= $this->render('_alert') ?>

                                <?= $form->errorSummary($model, ['class' => 'alert alert_error', 'style'=>'text-transform: inherit']) ?>

                                <div class="formsix-pos">
                                    <?= $form->field($model, 'first_name')
                                        ->textInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('first_name')]) ?>
                                </div>
                                <div class="formsix-pos">
                                    <?= $form->field($model, 'last_name')
                                        ->textInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('last_name')]) ?>
                                </div>
                                <div class="formsix-pos">
                                    <?= $form->field($model, 'phone')
                                        ->textInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('phone')]) ?>
                                </div>
                                <div class="formsix-pos">
                                    <?= $form->field($model, 'id_card_number')
                                        ->textInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('id_card_number')]) ?>
                                </div>
                                <div class="formsix-pos">
                                    <label for="Member_id_card_photo"><?= $model->getAttributeLabel('id_card_photo') ?></label>
                                    <?= $form->field($model, 'idCardPhotoFile')
                                        ->fileInput(['maxlength' => true]) ?>
                                </div>
                                <div class="formsix-pos">
                                    <label for="Member_id_card_photo"><?= $model->getAttributeLabel('photo') ?></label>
                                    <?= $form->field($model, 'photoFile')
                                        ->fileInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('photo')]) ?>
                                </div>
                                <div class="formsix-pos">
                                    <?= $form->field($model, 'address')
                                        ->textarea(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('address')]) ?>
                                </div>
                                <div class="formsix-pos">
                                    <?php
                                    $provinces = ArrayHelper::map(Provinces::find()->all(), 'id', 'name');
                                    $provinceOptions = ['data' => $provinces, 'pluginOptions' => ['allowClear' => true], 'options' => ['prompt' => $model->getAttributeLabel('province_id')]];
                                    ?>
                                    <?= $form->field($model, 'province_id')->widget(Select2::className(), $provinceOptions) ?>
                                </div>
                                <?= Html::hiddenInput('regency_id_selected', $model->isNewRecord ? '' : $model->regency_id, ['id'=>'regency_id_selected']) ?>
                                <div class="formsix-pos">
                                    <?= $form->field($model, 'regency_id')->widget(DepDrop::classname(), [
                                        'type'=>DepDrop::TYPE_SELECT2,
                                        'options'=>['prompt'=>$model->getAttributeLabel('regency_id')],
                                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                                        'pluginOptions'=>[
                                            'depends'=>['member-province_id'],
                                            'initialize' => true,
                                            'placeholder'=>$model->getAttributeLabel('regency_id'),
                                            'url'=>Url::to(['/ajax/find-regency']),
                                            'params'=>['regency_id_selected']
                                        ]
                                    ]) ?>
                                </div>
                                <?= Html::hiddenInput('district_id_selected', $model->isNewRecord ? '' : $model->district_id, ['id'=>'district_id_selected']) ?>
                                <div class="formsix-pos">
                                    <?= $form->field($model, 'district_id')->widget(DepDrop::classname(), [
                                        'type'=>DepDrop::TYPE_SELECT2,
                                        'options'=>['prompt'=>$model->getAttributeLabel('district_id')],
                                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                                        'pluginOptions'=>[
                                            'depends'=>['member-regency_id'],
                                            'initialize' => true,
                                            'placeholder'=>$model->getAttributeLabel('district_id'),
                                            'url'=>Url::to(['/ajax/find-district']),
                                            'params'=>['district_id_selected']
                                        ]
                                    ]) ?>
                                </div>
                                <div class="formsix-pos">
                                    <?= $form->field($model, 'postal_code')
                                        ->textInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('postal_code')]) ?>
                                </div>
                                <div class="formsix-pos">
                                    <?= $form->field($model, 'email')
                                        ->textInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('email'), 'readonly' => true]) ?>
                                </div>
                                <div class="login_btn_wrapper">
                                    <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary login_btn', 'name' => 'login-button']) ?>
                                </div>
                                <?php ActiveForm::end(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
