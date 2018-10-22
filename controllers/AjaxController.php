<?php

namespace app\controllers;

use app\models\BlogCategory;
use app\models\BlogPost;
use app\models\BlogTag;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;

/**
 * BlogController
 * 
 * @author Hendri <hendri.gnw@gmail.com>
 */
class AjaxController extends BaseController
{
    /**
     * displays listing blog by search
     * 
     * @return string
     */
    public function actionFindRegency()
    {
        $key = \Yii::$app->request->post('depdrop_parents');
        $selected = \Yii::$app->request->get('selected');
        if ($key) {
            $models = \app\models\Regencies::find()->where(['province_id' => $key])->all();
            $result = [];
            foreach ($models as $model) :
                $result[] = [
                    'id' => $model->id,
                    'name' => $model->name
                ];
            endforeach;
            return Json::encode(['output'=>$result, 'selected'=>$selected]);
        }
        return Json::encode(['output'=>'', 'selected'=>$selected]);
    }
    
    /**
     * displays listing blog by search
     * 
     * @return string
     */
    public function actionFindDistrict()
    {
        $key = \Yii::$app->request->post('depdrop_parents');
        $selected = \Yii::$app->request->get('selected');
        if ($key) {
            $models = \app\models\Districts::find()->where(['regency_id' => $key])->all();
            $result = [];
            foreach ($models as $model) :
                $result[] = [
                    'id' => $model->id,
                    'name' => $model->name
                ];
            endforeach;
            return Json::encode(['output'=>$result, 'selected'=>$selected]);
        }
        return Json::encode(['output'=>'', 'selected'=>$selected]);
    }
}
