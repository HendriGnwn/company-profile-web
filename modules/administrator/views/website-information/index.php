<?php

use kartik\color\ColorInput;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
/* @var $this View */
$this->title = Yii::t('app', 'Website Information');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-solid">
            <div class="box-header">
                
            </div>
            <div class="box-body">
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'enctype' => 'multipart/form-data',
                    ]
                ]); ?>
                <?= $form->field($model, 'app_name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'app_copyright')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                <?= $form->field($model, 'app_copyright_url')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">Company Information</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'app_company_name')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'app_motto')->textarea(['maxlength' => true]) ?>
                                <?= $form->field($model, 'appLogoFile')->fileInput(['maxlength' => true]) ?>
                                <?= $model->getAppLogoHtml() ?>
                                <br/><br/>
                                <?= $form->field($model, 'appFaviconFile')->fileInput(['maxlength' => true]) ?>
                                <?= $model->getAppFaviconHtml() ?>
                                <br/><br/>
                                <?= $form->field($model, 'app_contact_email')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'email_subject')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'app_contact_address')->textarea() ?>
                                <?= $form->field($model, 'app_contact_phone')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'app_account_facebook')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'app_account_twitter')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'app_account_googleplus')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'email_noreply')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'email_web_support')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-primary hide">
                    <div class="panel-heading">Counters Information</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'counter_year_of_experience')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'counter_project_completed')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'counter_happy_customers')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'counter_our_employees')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-primary hide">
                    <div class="panel-heading">About Information</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'progress_web_analyst')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'progress_web_development')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'progress_mobile_hybrid')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'progress_network_analyst')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'progress_network_development')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-primary">
                    <div class="panel-heading">SEO Information</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'app_metakey')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'app_metadesc')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'appSeoImageFile')->fileInput(['maxlength' => true]) ?>
                                <?= $model->getAppSeoImageHtml() ?>
                                <br/><br/>
                                <?= $form->field($model, 'app_seo_alt_image')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-primary">
                    <div class="panel-heading">Templating</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'app_color_primary')->widget(ColorInput::classname(), [
                                    'options' => ['placeholder' => 'Select color ...'],
                                ]) ?>
                                <?= $form->field($model, 'app_color_secondary')->widget(ColorInput::classname(), [
                                    'options' => ['placeholder' => 'Select color ...'],
                                ]) ?>
                                <?= $form->field($model, 'app_color_footer_content')->widget(ColorInput::classname(), [
                                    'options' => ['placeholder' => 'Select color ...'],
                                ]) ?>
                                <?= $form->field($model, 'app_color_footer_copyright')->widget(ColorInput::classname(), [
                                    'options' => ['placeholder' => 'Select color ...'],
                                ]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'app_background_primary')->widget(ColorInput::classname(), [
                                    'options' => ['placeholder' => 'Select color ...'],
                                ]) ?>
                                <?= $form->field($model, 'app_background_secondary')->widget(ColorInput::classname(), [
                                    'options' => ['placeholder' => 'Select color ...'],
                                ]) ?>
                                <?= $form->field($model, 'app_background_footer_content')->widget(ColorInput::classname(), [
                                    'options' => ['placeholder' => 'Select color ...'],
                                ]) ?>
                                <?= $form->field($model, 'app_background_footer_copyright')->widget(ColorInput::classname(), [
                                    'options' => ['placeholder' => 'Select color ...'],
                                ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<!--	#4285f4	NULL	NULL
 edit	40	app_color_secondary	#f9f9f9	NULL	NULL
 edit	41	app_color_footer_content	#212121	NULL	NULL
 edit	42	app_color_footer_copyright	#1a1a1a-->
