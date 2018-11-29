<?php

use app\models\Branch;
use app\models\Member;
use app\models\Provinces;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Member */
/* @var $form ActiveForm */
?>

<div class="member-form">

    <?php $form = ActiveForm::begin(); ?>
    
   <?= $form->errorSummary($model) ?>

    <?php if ($model->isNewRecord): ?>
        <?php
        $prefix = Member::prefixMemberCodeLabels();
        $options = ['data' => $prefix, 'pluginOptions' => ['allowClear' => true], 'options' => ['prompt' => 'Select']];
        ?>
        <?= $form->field($model, 'prefix_member_code')->widget(Select2::className(), $options) ?>
    <?php endif; ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php if ($model->isNewRecord): ?>
    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>
    <?php endif; ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_card_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idCardPhotoFile')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photoFile')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['maxlength' => true]) ?>

    <?php
    $provinces = ArrayHelper::map(Provinces::find()->all(), 'id', 'name');
    $provinceOptions = ['data' => $provinces, 'pluginOptions' => ['allowClear' => true], 'options' => ['prompt' => 'Select']];
    ?>
    <?= $form->field($model, 'province_id')->widget(Select2::className(), $provinceOptions) ?>
    
    <?= Html::hiddenInput('regency_id_selected', $model->isNewRecord ? '' : $model->regency_id, ['id'=>'regency_id_selected']) ?>
    
    <?= $form->field($model, 'regency_id')->widget(DepDrop::classname(), [
        'type'=>DepDrop::TYPE_SELECT2,
        'options'=>['prompt'=>$model->getAttributeLabel('regency_id')],
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'depends'=>['member-province_id'],
            'initialize' => !$model->isNewRecord ? true : false,
            'placeholder'=>$model->getAttributeLabel('regency_id'),
            'url'=>Url::to(['/ajax/find-regency']),
            'params'=>['regency_id_selected']
        ]
    ]) ?>
    
    <?= Html::hiddenInput('district_id_selected', $model->isNewRecord ? '' : $model->district_id, ['id'=>'district_id_selected']) ?>
    
    <?= $form->field($model, 'district_id')->widget(DepDrop::classname(), [
        'type'=>DepDrop::TYPE_SELECT2,
        'options'=>['prompt'=>$model->getAttributeLabel('district_id')],
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'depends'=>['member-regency_id'],
            'initialize' => !$model->isNewRecord ? true : false,
            'placeholder'=>$model->getAttributeLabel('district_id'),
            'url'=>Url::to(['/ajax/find-district']),
            'params'=>['district_id_selected']
        ]
    ]) ?>
    <?= $form->field($model, 'postal_code')->textInput() ?>

    <?php
    $provinces = ArrayHelper::map(Branch::find()->actived()->all(), 'id', 'name');
    $provinceOptions = ['data' => $provinces, 'pluginOptions' => ['allowClear' => true], 'options' => ['prompt' => 'Select']];
    ?>
    <?= $form->field($model, 'branch_id')->widget(Select2::className(), $provinceOptions) ?>

    <?php
    $status = Member::statusLabels();
    $statusOptions = ['data' => $status, 'pluginOptions' => ['allowClear' => true], 'options' => ['prompt' => 'Choose One']];
    ?>
    <?= $form->field($model, 'status')->widget(Select2::className(), $statusOptions) ?>

    <?= $form->field($model, 'blocked_reason')->textarea(['maxlength' => true]) ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
