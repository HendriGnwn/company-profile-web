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
        if ($key) {
            $models = \app\models\Regencies::find()->where(['province_id' => $key])->all();
            $result = [];
            foreach ($models as $model) :
                $result[] = [
                    'id' => $model->id,
                    'name' => $model->name
                ];
            endforeach;
            return Json::encode(['output'=>$result, 'selected'=>'']);
        }
        return Json::encode(['output'=>'', 'selected'=>'']);
    }
    
    /**
     * displays listing blog by search
     * 
     * @return string
     */
    public function actionFindDistrict()
    {
        $key = \Yii::$app->request->post('depdrop_parents');
        if ($key) {
            $models = \app\models\Districts::find()->where(['regency_id' => $key])->all();
            $result = [];
            foreach ($models as $model) :
                $result[] = [
                    'id' => $model->id,
                    'name' => $model->name
                ];
            endforeach;
            return Json::encode(['output'=>$result, 'selected'=>'']);
        }
        return Json::encode(['output'=>'', 'selected'=>'']);
    }
    
    /**
     * displays listing blog
     * 
     * @return string
     */
    public function actionIndex()
    {
        $params = [
            'result' => 'query',
        ];

        $query = BlogPost::getSearch($params);

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize'=>20]);
        $blogPosts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        
        return $this->render('index', [
            'blogPosts' => $blogPosts,
            'pages' => $pages,
        ]);
    }
    
    /**
     * displays blog detail
     * 
     * @param type $year d+ {4}
     * @param type $month d+ {2}
     * @param type $slug w+
     * @return type
     */
    public function actionDetail($year, $month, $slug)
    {
        $postDetail = BlogPost::findOne([
            'slug' => $slug,
            'status' => BlogPost::STATUS_ACTIVE
        ]);
        
        return $this->render('detail', [
            'postDetail' => $postDetail,
        ]);
    }
    
    /**
     * displays listing blog by category
     * 
     * @param type $slug w+
     * @return type
     */
    public function actionCategory($slug)
    {
        $category = BlogCategory::findOne(['slug' => $slug, 'status' => BlogCategory::STATUS_ACTIVE]);
        if (!$category) {
            throw new NotFoundHttpException('Page is not found.');
        }
        
        $params = [
            'result' => 'query',
            'category' => $category->id,
        ];

        $query = BlogPost::getSearch($params);

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize'=>20]);
        $blogPosts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        
        return $this->render('category', [
            'blogPosts' => $blogPosts,
            'pages' => $pages,
            'blogCategory' => $category,
        ]);
    }
    
    /**
     * displays listing blog by tag
     * 
     * @param type $slug w+
     * @return type
     */
    public function actionTag($slug)
    {
        $tag = BlogTag::findOne(['slug' => $slug]);
        if (!$tag) {
            throw new NotFoundHttpException('Page is not found.');
        }
        
        $params = [
            'result' => 'query',
            'tag' => $tag->id,
        ];

        $query = BlogPost::getSearch($params);

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize'=>20]);
        $blogPosts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        
        return $this->render('tag', [
            'blogPosts' => $blogPosts,
            'pages' => $pages,
            'blogTag' => $tag,
        ]);
    }
}
