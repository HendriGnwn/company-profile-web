<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Member */
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
            'password',
            'phone',
            'id_card_number',
            'id_card_photo',
            'photo',
            'address',
            'province_id',
            'regency_id',
            'district_id',
            'postal_code',
            'branch_id',
            'status',
            'confirmed_at',
            'confirmed_by',
            'blocked_at',
            'blocked_reason',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
