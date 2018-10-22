<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $category
 * @property string $description
 * @property string $metakey
 * @property string $metadesc
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Page extends BaseActiveRecord
{
	const CATEGORY_FULL = 1;
	const CATEGORY_PARTIAL = 2;
    
    const PAGE_ABOUT = 1;
    const PAGE_SERVICE_PARTIAL = 2;
   
    /**
     * @inheritdoc
     */
    public function behaviors() 
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'slugAttribute' => 'slug',
                'ensureUnique' => true,
            ]
        ]);
    }
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category', 'description'], 'required'],
            [['category', 'status', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'metakey'], 'string', 'max' => 200],
            [['slug', 'metadesc'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'slug' => Yii::t('app', 'Slug'),
            'category' => Yii::t('app', 'Category'),
            'description' => Yii::t('app', 'Description'),
            'metakey' => Yii::t('app', 'Metakey'),
            'metadesc' => Yii::t('app', 'Metadesc'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
	
    public static function categoryLabels() 
    {
        return [
            self::CATEGORY_FULL => Yii::t('app', 'Full Page'),
            self::CATEGORY_PARTIAL => Yii::t('app', 'Partial Page'),
        ];
    }

    public function getCategoryLabel() 
    {
        return self::categoryLabels()[$this->category] ? self::categoryLabels()[$this->category] : $this->category;
    }
    
    /**
     * returns page detail url
     * 
     * @param type $absolute
     * @return type
     */
    public function getDetailUrl($absolute = false)
    {
        return Url::to(['page/'.$this->slug], $absolute);
    }
}
