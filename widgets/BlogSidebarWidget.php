<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\widgets;

use app\models\BlogPost;
use yii\base\Widget;

/**
 * Description of BlogSidebarWidget
 *
 * @author Hendri <hendri.gnw@gmail.com>
 */
class BlogSidebarWidget extends Widget
{
    public $model;
    
    public function run()
    {
        return $this->render('blog-sidebar', [
            'latestBlogs' => $this->getLatestBlogs(),
            'blogCategories' => $this->getBlogCategories(),
            'model' => $this->model,
            'tags' => $this->getTags(),
        ]);
    }
    
    public function getTags()
    {
        return \app\models\BlogPostTag::find()->groupBy('blog_tag_id')->limit(15)->all();
    }
    
    /**
     * returns latest blog
     * 
     * @return array
     */
    protected function getLatestBlogs()
    {
        $params = [
            'result' => 'result',
            'limit' => 5,
        ];
        
        return BlogPost::getSearch($params);
    }
    
    /**
     * returns blog categories for menu
     * 
     * @return array
     */
    protected function getBlogCategories()
    {
        $items = [];
        $query = \app\models\BlogCategory::find()->actived()->all();
        foreach($query as $category) {
            $items[] = [
                'label' => $category->name,
                'url' => $category->getUrl(),
            ];
        }
        
        return $items;
    }
}
