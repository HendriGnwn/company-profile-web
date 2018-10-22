<?php

namespace app\controllers;

use app\models\GalleryCategory;
use app\models\search\GallerySearch;
use Yii;

/**
 * PageController
 * 
 * @author Hendri <hendri.gnw@gmail.com>
 */
class GalleryController extends BaseController
{
    public function actionIndex()
    {
        $categories = GalleryCategory::find()
                ->actived()
                ->ordered()
                ->all();
        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(false); //debug
        
        return $this->render('index', [
            'categories' => $categories,
            'models' => $dataProvider
        ]);
    }
}
