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

$this->title = Yii::t('app', 'Sign Up');
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
?>

<div class="login_section">
    <div class="login_section_overlay"></div>
    <!-- login_form_wrapper -->
    <div class="login_form_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    
                    <?php
                    $form = ActiveForm::begin([
                        'action' => ['/member/signup'],
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
                        <div class="formsix-pos">
                            <?= $form->field($model, 'regency_id')->widget(DepDrop::classname(), [
                                'type'=>DepDrop::TYPE_SELECT2,
                                'data'=>[],
                                'options'=>['prompt'=>$model->getAttributeLabel('regency_id')],
                                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                                'pluginOptions'=>[
                                    'depends'=>['member-province_id'],
                                    'placeholder'=>$model->getAttributeLabel('regency_id'),
                                    'url'=>Url::to(['/ajax/find-regency', ['selected' => $model->regency_id]])
                                ]
                            ]) ?>
                        </div>
                        <div class="formsix-pos">
                            <?= $form->field($model, 'district_id')->widget(DepDrop::classname(), [
                                'type'=>DepDrop::TYPE_SELECT2,
                                'data'=>[],
                                'options'=>['prompt'=>$model->getAttributeLabel('district_id')],
                                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                                'pluginOptions'=>[
                                    'depends'=>['member-regency_id'],
                                    'placeholder'=>$model->getAttributeLabel('district_id'),
                                    'url'=>Url::to(['/ajax/find-district', ['selected' => $model->district_id]])
                                ]
                            ]) ?>
                        </div>
                        <div class="formsix-pos">
                            <?= $form->field($model, 'postal_code')
                                ->textInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('postal_code')]) ?>
                        </div>
                        <div class="formsix-pos">
                            <?= $form->field($model, 'email')
                                ->textInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('email')]) ?>
                        </div>
                        <div class="formsix-e">
                            <?= $form->field($model, 'password_hash')
                                ->passwordInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('password')]) ?>
                        </div>
                        <div class="formsix-e">
                            <?= $form->field($model, 'agree')->checkbox(['label' => 'Saya setuju <a target="_blank" href="/page/term-condition" style="color:#999">Ketentuan Penggunaan</a> dan <a target="_blank" href="/page/privacy-policy" style="color:#999">Kebijakan Privasi</a>']) ?>
                        </div>
                        <div class="login_btn_wrapper">
                            <?= Html::submitButton(Yii::t('app', 'Sign Up'), ['class' => 'btn btn-primary login_btn', 'name' => 'login-button']) ?>
                        </div>
                        <div class="sign_up_message">
                            <p>
                                <?= Yii::t('app', 'Have an account ?') ?>
                                <?= Html::a(Yii::t('app', 'Sign In'), ['/member/signin']) ?>
                            </p>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <!-- /.login_wrapper-->
                </div>
            </div>
        </div>
    </div>
    <!-- /.login_form_wrapper-->
</div>

<?php
$this->registerJs("
    $('#member-province_id').trigger('change');
");