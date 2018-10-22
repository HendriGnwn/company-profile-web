<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $url
 * @property integer $is_absolute_url
 * @property string $option
 * @property integer $status
 * @property integer $order
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * 
 * @property Menu[] $parent
 * @property Menu[] $parents
 */
class Menu extends BaseActiveRecord
{
    const CATEGORY_MAIN = 1;
    const CATEGORY_MAIN_FOOTER = 2;
    const CATEGORY_BACKEND = 10;
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'is_absolute_url', 'status', 'order', 'created_by', 'updated_by', 'category'], 'integer'],
            [['name', 'url'], 'required'],
            [['option'], 'string'],
            [['created_at', 'updated_at', 'order'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['url'], 'string', 'max' => 255],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['order'], 'default', 'value' => 0],
            [['parent_id'], 'in',
                'range' => self::find()->select(['id'])->column(),
                'message' => 'Menu "{value}" not found.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'name' => Yii::t('app', 'Name'),
            'url' => Yii::t('app', 'Url'),
            'is_absolute_url' => Yii::t('app', 'Full Url'),
            'category' => Yii::t('app', 'Category'),
            'option' => Yii::t('app', 'Option'),
            'status' => Yii::t('app', 'Status'),
            'order' => Yii::t('app', 'Order'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
    
    /**
     * get menu parent
     * 
     * @return ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }
    
    /**
     * get menu children
     * 
     * @return ActiveQuery
     */
    public function getParents()
    {
        return $this->hasMany(self::className(), ['parent_id' => 'id']);
    }
    
    /**
     * get menus
     * 
     * @param type $category
     * @param type $options
     * @param type $childOptions
     * @return type
     */
    public function getMenus($category = self::CATEGORY_MAIN, $options = [], $childOptions = [])
    {
        $query = self::find()
                ->where([
                    'category' => $category,
                    'parent_id' => null,
                ])
                ->ordered()
                ->actived()
                ->all();
        
        $items = [];
        foreach ($query as $data) {
            $items[$data->id]['label'] = $data->name;
            $items[$data->id]['id'] = $data->id;
            $items[$data->id]['url'] = [$data->url];
            $items[$data->id]['options'] = $options;
            
            if ($data->parents != null) {
                $items[$data->id]['url'] = '#';
                $items[$data->id]['options'] = $childOptions;
                $items[$data->id]['items'] = $this->getMenuChildren($items[$data->id]['items'], $data->parents, $options, $childOptions);
            }
            
            if (!empty($data->option)) {
                $items[$data->id] = ArrayHelper::merge($items[$data->id], $data->getOption());
            }
            
        }
        
        return $items;
    }
    
    /**
     * get children
     * 
     * @param type $items
     * @param type $children
     * @return type
     */
    protected function getMenuChildren(&$items, $parents, $options = [], $childOptions = [])
    {
        foreach ($parents as $data) {
            $items[$data->id]['label'] = $data->name;
            $items[$data->id]['id'] = $data->id;
            $items[$data->id]['url'] = [$data->url];
            $items[$data->id]['options'] = $options;
            if ($data->parents != null) {
                $items[$data->id]['url'] = '#';
                $items[$data->id]['options'] = $childOptions;
                $items[$data->id]['items'] = $this->getMenuChildren($items[$data->id]['items'], $data->parents, $options, $childOptions);
            }
            
            if (!empty($data->option)) {
                $items[$data->id] = ArrayHelper::merge($items[$data->id], $data->getOption());
            }
        }
        
        return $items;
    }
    
    /**
     * get option
     * 
     * @return eval
     */
    public function getOption()
    {
        return eval($this->option);
    }
    
    /**
     * @return string
     */
    public function getCategoryWithName()
    {
        return $this->getCategoryLabel() .' - '. $this->name;
    }
    
    public static function categoryLabels() 
    {
        return [
            self::CATEGORY_MAIN => Yii::t('app', 'Front Page'),
            self::CATEGORY_MAIN_FOOTER => Yii::t('app', 'Front Footer'),
            self::CATEGORY_BACKEND => Yii::t('app', 'Admin Page'),
        ];
    }

    public function getCategoryLabel() 
    {
        return self::categoryLabels()[$this->category] ? self::categoryLabels()[$this->category] : $this->category;
    }
}