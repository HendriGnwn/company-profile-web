<?php

namespace app\models;

use app\helpers\Url;
use Yii;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\web\UploadedFile;

/**
 * This is the model class for table "team".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $professional
 * @property string $photo
 * @property string $social_account
 * @property string $description
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * 
 * @property string $path
 */
class Team extends BaseActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $photoFile;
    
    private $_path;
    
    /** social */
    public $social_facebook;
    public $social_twitter;
    public $social_linked_in;
    public $social_dribbble;
    public $social_email;
    
    public function init()
    {
        parent::init();
        
        $this->path = 'web/uploads/team/';
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
        return 'team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'professional', 'description'], 'required'],
            [['description'], 'string'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['social_account', 'photo', 'created_at', 'updated_at', 
                'social_facebook', 'social_twitter', 'social_linked_in', 'social_dribbble', 'social_email'], 'safe'],
            [['first_name'], 'string', 'max' => 30],
            [['last_name'], 'string', 'max' => 50],
            [['professional'], 'string', 'max' => 100],
            [['photo', 'social_account'], 'string', 'max' => 255],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['photoFile'], 'file', 'skipOnEmpty' => true, 'checkExtensionByMimeType' => false,
                'extensions' => ['jpg', 'jpeg', 'png'],
                'maxSize' => 1024 * 1024 * 1],
        ];
    }
    
    public function afterFind()
    {
        $this->normalizeSocialAccounts();
        
        return parent::afterFind();
    }
    
    /**
     * normalize social accounts to another variables
     * 
     * @return boolean
     */
    protected function normalizeSocialAccounts()
    {
        $socialAccounts = json_decode($this->social_account, true);
        
        $this->social_facebook = $socialAccounts['facebook'];
        $this->social_twitter = $socialAccounts['twitter'];
        $this->social_linked_in = $socialAccounts['linked_in'];
        $this->social_dribbble = $socialAccounts['dribbble'];
        $this->social_email = $socialAccounts['email'];
        
        return true;
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
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'professional' => Yii::t('app', 'Professional'),
            'photo' => Yii::t('app', 'Photo'),
            'social_account' => Yii::t('app', 'Social Account'),
            'social_facebook' => Yii::t('app', 'Social Facebook Url'),
            'social_twitter' => Yii::t('app', 'Social Twitter Url'),
            'social_linked_in' => Yii::t('app', 'Social Linked In Url'),
            'social_dribbble' => Yii::t('app', 'Social Dribbble Url'),
            'social_email' => Yii::t('app', 'Social Email'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
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
        $this->social_account = $this->mergeSocialAccount();
        
        return parent::beforeSave($insert);
    }
    
    /**
     * returns merge social accounts
     * 
     * @return array
     */
    protected function mergeSocialAccount($json = true)
    {
        $values = [
            'facebook' => $this->social_facebook,
            'twitter' => $this->social_twitter,
            'linked_in' => $this->social_linked_in,
            'dribbble' => $this->social_dribbble,
            'email' => $this->social_email,
        ];
        
        return ($json == true) ? json_encode($values) : $values;
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
            $filename = Inflector::slug($this->first_name . '-' . Yii::$app->security->generateRandomString(20));
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
            return 'https://via.placeholder.com/350x350/ffffff';
        }

        return Url::to('@' . $path, true);
    }

    public function getPhotoUrlHtml($name = null, $options = ['target' => '_blank']) 
    {
        $name = $name ? $name : $this->first_name;

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
    
    /**
     * returns full name
     * 
     * @return string
     */
    public function getFullName()
    {
        return $this->first_name .' '. $this->last_name;
    }
}
