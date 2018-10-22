<?php

use app\helpers\DetailViewHelper;
use app\models\Branch;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Branch */
?>
<div class="branch-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
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
            //'address_mapping:ntext',
            [
                'attribute' => 'status',
                'value' => $model->getStatusWithStyle(),
                'format' => 'raw',
            ],
            'created_at',
            'updated_at',
            DetailViewHelper::author($model, 'created_by'),
            DetailViewHelper::author($model, 'updated_by'),
        ],
    ]) ?>
    <h3>District Mapping By Regency <?= $model->regency ? $model->regency->name : $model->regency_id ?></h3>
    <table class="table table-condensed">
        <tr>
            <th>District</th>
        </tr>
        <?php foreach ($model->getDistrictMappings() as $map) { ?>
        <tr>
            <td><?= $map->name ?></td>
        </tr>
        <?php } ?>
    </table>
    

</div>
