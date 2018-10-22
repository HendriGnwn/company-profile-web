<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "gallery".
 *
 * @property integer $id
 * @property integer $portfolio_id
 * @property string $name
 * @property string $photo
 * @property string $is_video
 * @property string $video_url
 * @property string $gallery_category
 * @property string $description
 * @property string $metakey
 * @property string $metadesc
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * 
 * @property Portfolio[] $portfolio
 */
class Gallery extends BaseActiveRecord
{
	/**
     * @var UploadedFile
     */
    public $photoFile;
    
    private $_path;
    
    public function init()
    {
        parent::init();
        
        $this->path = 'web/uploads/gallery/';
        if (!is_dir(Yii::getAlias('@app/' . $this->path))) {
            mkdir(Yii::getAlias('@app/' . $this->path));
        }

        return true;
    }
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'gallery_category'], 'required'],
            [['portfolio_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at', 'portfolio_id', 'is_video', 'video_url'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['photo'], 'string', 'max' => 255],
			[['metakey'], 'string', 'max' => 100],
            [['metadesc'], 'string', 'max' => 150],
			[['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['photoFile'], 'file', 'skipOnEmpty' => true, 'checkExtensionByMimeType' => false,
                'extensions' => ['jpg', 'jpeg', 'png'],
                'maxSize' => 1024 * 1024 * 1],
        ];
    }
	
    /**
     * - delete photoFile
     * 
     * @return type
     */
    public function beforeDelete()
    {
        /* todo: delete the corresponding file in storage */
        $this->deleteFile();
        
        return parent::beforeDelete();
    }
    
    protected function deleteFile()
    {
        @unlink(Yii::getAlias('@app/' . $this->path) . $this->photo);
    }	
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'portfolio_id' => Yii::t('app', 'Portfolio ID'),
            'name' => Yii::t('app', 'Name'),
            'photo' => Yii::t('app', 'Photo'),
            'is_video' => Yii::t('app', 'Is Video'),
            'video_url' => Yii::t('app', 'Video Url Youtube Embed'),
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
    
    /**
     * @return yii\db\ActiveQuery
     */
    public function getPortfolio()
    {
        return $this->hasOne(Portfolio::className(), ['id'=>'portfolio_id']);
    }
    
    public function getGalleryCategories()
    {
        return GalleryCategory::find()->where(['in', 'id', $this->gallery_category])->all();
    }
    
    public function getListCategorySlugs($withAll = true)
    {
        $result = [];
        if ($withAll) {
            $result[] = Yii::t('app', 'All');
        }
        if (count($this->getGalleryCategories()) <= 0) {
            return $result;
        }
        foreach ($this->getGalleryCategories() as $model) {
            $result[] = $model->slug;
        }
        
        return $result;
    }
	
	/**
     * - process upload file
     * 
     * @param type $insert
     * @return type
     */
    public function beforeSave($insert) 
    {
        $this->processUploadFile();
        
        return parent::beforeSave($insert);
    }
    
    /**
     * process uploaded file
     * 
     * @return boolean
     */
    public function processUploadFile()
    {
        if (!empty($this->photoFile)) {
            $this->deleteFile();

            $path = str_replace('web/', '', $this->path);
            
            // generate filename
            $filename = Inflector::slug($this->name . '-' . Yii::$app->security->generateRandomString(20));
            $filename = $filename . '.' . $this->photoFile->extension;
            
            $this->photoFile->saveAs($path . $filename);
            $this->photo = $filename;
        }

        return true;
    }
    
    /**
     * get url file
     * 
     * @return type
     */
    public function getPhotoUrl() 
    {
        if (empty($this->photo)) {
            return null;
        }

        $path = $this->path . $this->photo;

        if (!file_exists(Yii::getAlias('@app/' . $path))) {
            return 'https://via.placeholder.com/550x550';
        }

        return Url::to('@' . $path, true);
    }
    
    public function getPhotoImg($options = ['class' => 'img-responsive'])
    {
        return Html::img($this->getPhotoUrl(), $options);
    }

    public function getPhotoUrlHtml($name = null, $options = ['target' => '_blank']) 
    {
        $name = $name ? $name : $this->name;

        if (!$this->getPhotoUrl()) {
            return $name;
        }

        return Html::a($name, $this->getPhotoUrl(), $options);
    }

    /**
     * set path
     * 
     * @param type $value
     */
    public function setPath($value)
    {
        $this->_path = $value;
    }
    
    /**
     * @return string
     */
    public function getPath()
    {
        return $this->_path;
    }
    
    public function afterFind() {
        
        $this->gallery_category = explode(',', $this->gallery_category);
        
        return parent::afterFind();
    }
}
