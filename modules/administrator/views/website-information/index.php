<?php

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
                <?= $form->field($model, 'app_motto')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'app_copyright')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'app_copyright_url')->textInput(['maxlength' => true]) ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>