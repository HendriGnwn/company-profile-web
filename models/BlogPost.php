<?php

namespace app\models;

use app\helpers\FormatConverter;
use app\helpers\Url;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\web\UploadedFile;

/**
 * This is the model class for table "blog_post".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $photo
 * @property string $post_date
 * @property string $lead_text
 * @property string $content
 * @property string $metakey
 * @property string $metadesc
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $blog_category_id
 *
 * @property BlogCategory $blogCategory
 * @property BlogPostTag[] $blogPostTags
 */
class BlogPost extends BaseActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $photoFile;
    
    private $_path;
    
    public $blogTag;
    
    public function init()
    {
        parent::init();
        
        $this->path = 'web/uploads/blog-post/';
        if (!is_dir(Yii::getAlias('@app/' . $this->path))) {
            mkdir(Yii::getAlias('@app/' . $this->path));
        }

        return true;
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors() 
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
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
        return 'blog_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'blog_category_id', 'post_date', 'blogTag'], 'required'],
            [['lead_text', 'content'], 'string'],
            [['slug', 'created_at', 'updated_at'], 'safe'],
            [['post_date'],'datetime', 'format' => 'php: Y-m-d H:i:s', 'message' => Yii::t('app.message', 'Datetime format must be `Y-m-d H:i:s` eg: 2017-01-30 19:00:50')],
            [['created_by', 'updated_by', 'blog_category_id'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 128],
            [['photo'], 'string', 'max' => 100],
            [['metakey'], 'string', 'max' => 150],
            [['metadesc'], 'string', 'max' => 160],
            [['lead_text'], 'string', 'max' => 200],
            [['title'], 'unique'],
            [['slug'], 'unique'],
            [['blog_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategory::className(), 'targetAttribute' => ['blog_category_id' => 'id']],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['photoFile'], 'file', 'skipOnEmpty' => true, 'checkExtensionByMimeType' => false,
                'extensions' => ['jpg', 'jpeg', 'png'],
                'maxSize' => 1024 * 1024 * 1],
        ];
    }
    
    public function afterFind() 
    {
        $this->blogTag = $this->getBlogPostTags()->select('blog_tag_id')->indexBy('blog_tag_id')->column();
        
        return parent::afterFind();
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
            'title' => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'photo' => Yii::t('app', 'Photo'),
            'post_date' => Yii::t('app', 'Post Date'),
            'lead_text' => Yii::t('app', 'Lead Text'),
            'content' => Yii::t('app', 'Content'),
            'metakey' => Yii::t('app', 'Metakey'),
            'metadesc' => Yii::t('app', 'Metadesc'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'blog_category_id' => Yii::t('app', 'Blog Category ID'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getBlogCategory()
    {
        return $this->hasOne(BlogCategory::className(), ['id' => 'blog_category_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getBlogPostTags()
    {
        return $this->hasMany(BlogPostTag::className(), ['blog_post_id' => 'id']);
    }
    
    /**
     * returns list blog post has tags
     * 
     * @return array
     */
    public function getListBlogPostTags()
    {
        if (!$this->blogPostTags) {
            return [];
        }
        
        $result = [];
        foreach ($this->blogPostTags as $tag) {
            $result[$tag->id] = $tag->blogTag ? $tag->blogTag->name : '';
        }
        
        return $result;
    }
    
    /**
     * get detail url -> 'blog/<year>/<month>/<slug>'
     * 
     * @param type $absolute by default is false
     * @return type
     */
    public function getDetailUrl($absolute = false)
    {
        $year = FormatConverter::dateFormat($this->post_date, 'Y');
        $month = FormatConverter::dateFormat($this->post_date, 'm');
        
        return Url::to([
            'blog/detail', 
            'year' => $year, 
            'month' => $month, 
            'slug' => $this->slug
        ], $absolute);
    }
    
    public static function getSearch($params = [])
    {
        $query = self::find()
            ->select([
                'blog_post.*',
            ])
            ->joinWith('blogCategory')
            ->joinWith('blogPostTags')
            ->where([
                'blog_post.status' => self::STATUS_ACTIVE,
            ])
            ->distinct(true);

        // Filter by post_name
        if(isset($params['post_title'])) {
            $query->andFilterWhere(['like','title',$params['post_title']]);
        }

        // Filter by post_date
        if(isset($params['post_date'])) {
            $query->andFilterWhere(['like','post_date',$params['post_date']]);
        }

        // Filter by taxonomy it could be categories
        if(isset($params['category'])) {
            $query->andFilterWhere(['blog_category_id' => $params['category']]);
        }
        
        // Filter by taxonomy it could be tag
        if(isset($params['tag'])) {
            $query->andFilterWhere(['blog_tag_id' => $params['tag']]);
        }

        if(isset($params['limit'])) {
            $query->limit($params['limit']);
        }
        
        if (isset($params['search'])) {
            $search = $params['search'];
            if (isset($search['post_title'])) {
                $query->andFilterWhere(['like','title',$search['post_title']]);
            }
            if (isset($search['category'])) {
                $query->orFilterWhere(['like','blog_category.name',$search['category']]);
            }
            if (isset($search['content'])) {
                $query->orFilterWhere(['like','content',$search['content']]);
            }
            if (isset($search['lead_text'])) {
                $query->orFilterWhere(['like','lead_text',$search['lead_text']]);
            }
        }

        $query->orderBy([
            'post_date' => SORT_DESC
        ]);
        
        if (isset($params['result'])) {
            switch ($params['result']) {
                case 'query':
                    $results = $query;
                    break;
                case 'count':
                    $results = $query->count();
                    break;
                case 'result':
                default:
                    $results = $query->all();
                    break;
            }
        } else {
            $results = $query->all();
        }

        return $results;
    }
    
    public function afterSave($insert, $changedAttributes) 
    {
        $this->savePostTags();
        
        return parent::afterSave($insert, $changedAttributes);
    }
    
    /**
     * process save post tags
     * 
     * @return boolean
     */
    protected function savePostTags()
    {
        BlogPostTag::deleteAll('blog_post_id = ' . $this->id);
        foreach($this->blogTag as $tag) {
            $postTag = new BlogPostTag();
            $postTag->blog_post_id = $this->id;
            $postTag->blog_tag_id = $tag;
            
            $postTag->save();
        }
        
        return true;
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
        
        if (
            empty($this->title) ||
            empty($this->slug) ||
            empty($this->content) ||
            empty($this->lead_text) ||
            empty($this->photo) ||
            empty($this->blog_category_id)
        ) {
            $this->status = self::STATUS_INACTIVE;
        }
        
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
            $filename = Inflector::slug($this->slug . '-' . Yii::$app->security->generateRandomString(20));
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
            return 'https://via.placeholder.com/850x550';
        }

        return Url::to('@' . $path, true);
    }
    
    public function getPhotoImg($options = ['class' => 'img-responsive'])
    {
        if (!$this->getPhotoUrl()) {
            return Html::img('https://via.placeholder.com/850x550', $options);
        }
        
        return Html::img($this->getPhotoUrl(), $options + ['alt' => $this->title]);
    }

    public function getPhotoUrlHtml($name = null, $options = ['target' => '_blank']) 
    {
        $name = $name ? $name : $this->title;

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
}
