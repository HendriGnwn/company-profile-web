<?php

namespace app\models;

use app\helpers\MailHelper;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "contact".
 *
 * @property integer $id
 * @property integer $title_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $subject
 * @property string $description
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * 
 * @property string $title
 */
class Contact extends BaseActiveRecord
{
    const STATUS_REPLIED = 5;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'phone', 'subject', 'description'], 'required'],
            [['title_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['title_id', 'created_at', 'updated_at'], 'safe'],
            [['first_name'], 'string', 'max' => 30],
            [['last_name'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 15],
            [['subject'], 'string', 'max' => 150],
            [['title_id'], 'default', 'value' => 0],
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
            'title_id' => Yii::t('app', 'Title ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'subject' => Yii::t('app', 'Subject'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function statusLabels() 
    {
        return ArrayHelper::merge(parent::statusLabels(), [
           self::STATUS_REPLIED => Yii::t('app', 'Replied'),
        ]);
    }
    
    public function getStatusLabel()
	{
		$list = self::statusLabels();
		return $list[$this->status] ? $list[$this->status] : $this->status;
	}
    
    /**
     * @inheritdoc
     */
    public function getStatusWithStyle()
	{
		switch ($this->status) {
			case self::STATUS_REPLIED :
				return Html::label($this->getStatusLabel(), null, ['class'=>'label label-primary label-sm']);
            case self::STATUS_ACTIVE :
				return Html::label($this->getStatusLabel(), null, ['class'=>'label label-success label-sm']);
			case self::STATUS_INACTIVE :
				return Html::label($this->getStatusLabel(), null, ['class'=>'label label-danger label-sm']);
			default :
				return Html::label($this->getStatusLabel(), null, ['class'=>'label label-default label-sm']);
		}
	}
    
    /**
     * @return string
     */
    public function getTitle()
    {
       $list = Config::getTitles();
       return $list[$this->title_id];
    }
    
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    /**
     * send email to user when create contact us from front end
     * It's called by ContactForm
     * 
     * @return boolean
     */
    public function sendEmailNewNotification()
    {
        $model = $this;
        $mail = Yii::$app->mailer
			->compose(['html' => 'contact/new-contact-to-admin'], ['model' => $model])
			->setFrom([Config::getEmailNoReply() => Yii::$app->name])
			->setTo(Config::getAppContactEmail())
			->setReplyTo($this->email)
			->setSubject('New Contact | '.$this->subject.' from '. $this->first_name)
            ->send();
        
        return $mail;
    }
}
