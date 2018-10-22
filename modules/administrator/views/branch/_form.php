<?php

use app\models\Branch;
use app\models\Provinces;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Branch */
/* @var $form ActiveForm */
?>

<div class="branch-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

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
            'depends'=>['branch-province_id'],
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
            'depends'=>['branch-regency_id'],
            'initialize' => !$model->isNewRecord ? true : false,
            'placeholder'=>$model->getAttributeLabel('district_id'),
            'url'=>Url::to(['/ajax/find-district']),
            'params'=>['district_id_selected']
        ]
    ]) ?>

    <?= $form->field($model, 'postal_code')->textInput() ?>

    <?php
    $status = Branch::statusLabels();
    $statusOptions = ['data' => $status, 'pluginOptions' => ['allowClear' => true], 'options' => ['prompt' => 'Choose One']];
    ?>
    <?= $form->field($model, 'status')->widget(Select2::className(), $statusOptions) ?>
    
    <?php if (!$model->isNewRecord) : ?>
        <?php
        $provinces = ArrayHelper::map(app\models\Districts::find()->where(['regency_id' => $model->regency_id])->all(), 'id', 'name');
        $provinceOptions = ['data' => $provinces, 'pluginOptions' => ['allowClear' => true, 'multiple' => true], 'options' => ['prompt' => 'Select', 'multiple' => true, 'value' => $model->district_mapping]];
        ?>
        <?= $form->field($model, 'district_mapping[]')->widget(Select2::className(), $provinceOptions) ?>
    <?php else: ?>
        <?= Html::hiddenInput('district_mapping_selected', $model->isNewRecord ? '' : json_encode($model->district_mapping), ['id'=>'district_mapping_selected']) ?>
        <?= $form->field($model, 'district_mapping[]')->widget(DepDrop::classname(), [
            'type'=>DepDrop::TYPE_SELECT2,
            'options'=>['prompt'=>$model->getAttributeLabel('district_mapping')],
            'select2Options'=>['pluginOptions'=>['allowClear'=>true, 'multiple' => true]],
            'pluginOptions'=>[
                'depends'=>['branch-regency_id'],
                'initialize' => !$model->isNewRecord ? true : false,
                'placeholder'=>$model->getAttributeLabel('district_mapping'),
                'url'=>Url::to(['/ajax/find-district']),
                'params'=>['district_mapping_selected']
            ]
        ]) ?>
    <?php endif; ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
