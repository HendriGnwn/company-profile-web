<?php

use app\helpers\DetailViewHelper;
use app\models\Member;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Member */
?>
<div class="member-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'member_code',
            'first_name',
            'last_name',
            'email:email',
//            'password',
            'phone',
            'id_card_number',
            [
                'attribute' => 'id_card_photo',
                'value' => $model->getIdCardPhotoUrlHtml(),
                'format' => 'raw',
            ],
            [
                'attribute' => 'photo',
                'value' => $model->getPhotoUrlHtml(),
                'format' => 'raw',
            ],
            'address',
            [
                'attribute' => 'province_id',
                'value' => $model->province ? $model->province->name : $model->province_id
            ],
            [
                'attribute' => 'regency_id',
                'value' => $model->regency ? $model->regency->name : $model->regency_id
            ],
            [
                'attribute' => 'district_id',
                'value' => $model->district ? $model->district->name : $model->district_id
            ],
            'postal_code',
            [
                'attribute' => 'branch_id',
                'value' => $model->branch ? $model->branch->name : $model->branch_id,
            ],
            [
                'attribute' => 'status',
                'value' => $model->getStatusWithStyle(),
                'format' => 'raw',
            ],
            'confirmed_at',
            DetailViewHelper::author($model, 'confirmed_by'),
            'blocked_at',
            'blocked_reason',
            'created_at',
            'updated_at',
            DetailViewHelper::author($model, 'created_by'),
            DetailViewHelper::author($model, 'updated_by'),
        ],
    ]) ?>

</div>
