<?php

namespace app\models;

use app\helpers\MailHelper;
use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%member}}".
 *
 * @property integer $id
 * @property string $member_code
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property string $id_card_number
 * @property string $id_card_photo
 * @property string $photo
 * @property string $address
 * @property string $province_id
 * @property string $regency_id
 * @property string $district_id
 * @property integer $postal_code
 * @property integer $branch_id
 * @property integer $status
 * @property string $confirmed_at
 * @property integer $confirmed_by
 * @property string $blocked_at
 * @property string $blocked_reason
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Provinces $province
 * @property Regencies $regency
 * @property Districts $district
 * @property Branch $branch
 */
class Member extends BaseActiveRecord implements IdentityInterface
{
    const PREFIX_MEMBER_MAIN = 1;
    const PREFIX_MEMBER_PROVINCE = 2;
    const PREFIX_MEMBER_CITY = 3;
    const PREFIX_MEMBER_GENERAL = 4;
    
    const STATUS_WAITING_APPROVAL = 5;
    
    const SCENARIO_REGISTER = 'register';
    const SCENARIO_CHANGE_PASSWORD = 'change-password';
    const SCENARIO_CHANGE_STATUS = 'change-status';
    
    public $current_password;
    public $new_password;
    public $password_hash;
    public $confirm_password;
    
    public $prefix_member_code;
    public $agree;
    
    /**
     * @var UploadedFile
     */
    public $idCardPhotoFile;
    
    /**
     * @var UploadedFile
     */
    public $photoFile;
    
    private $_path;
    
    public function init()
    {
        parent::init();
        
        $this->path = 'web/uploads/member/';
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
        return '{{%member}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'email', 'phone', 'address', 'province_id', 'regency_id', 'district_id', 'postal_code'], 'required', 'on' => [self::SCENARIO_DEFAULT, self::SCENARIO_REGISTER, self::SCENARIO_UPDATE, self::SCENARIO_INSERT]],
            [['password_hash', 'prefix_member_code'], 'required', 'on' => [self::SCENARIO_INSERT, self::SCENARIO_REGISTER]],
            [['agree'], 'required', 'on' => [self::SCENARIO_REGISTER]],
            [['status'], 'required', 'on' => self::SCENARIO_CHANGE_STATUS],
            [['postal_code', 'branch_id', 'status', 'confirmed_by', 'created_by', 'updated_by'], 'integer'],
            [['confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'member_code', 'branch_id', 'status', 'blocked_reason', 'password'], 'safe'],
            [['email'], 'unique', 'targetAttribute' => 'email'],
            [['member_code', 'first_name', 'last_name', 'id_card_photo', 'photo'], 'string', 'max' => 100],
            [['email', 'password', 'address'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
            [['id_card_number'], 'string', 'max' => 25],
            [['province_id'], 'string', 'max' => 2],
            [['regency_id'], 'string', 'max' => 4],
            [['district_id'], 'string', 'max' => 7],
            [['status'], 'default', 'value' => self::STATUS_WAITING_APPROVAL],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['province_id' => 'id']],
            [['regency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regencies::className(), 'targetAttribute' => ['regency_id' => 'id']],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['photoFile', 'idCardPhotoFile'], 'file', 'skipOnEmpty' => false, 'checkExtensionByMimeType' => true,
                'extensions' => ['jpg', 'jpeg', 'png'],
                'maxSize' => 1024 * 1024 * 1, 'on' => [self::SCENARIO_INSERT,self::SCENARIO_REGISTER]],
            [['photoFile', 'idCardPhotoFile'], 'file', 'skipOnEmpty' => true, 'checkExtensionByMimeType' => true,
                'extensions' => ['jpg', 'jpeg', 'png'],
                'maxSize' => 1024 * 1024 * 1, 'on' => self::SCENARIO_UPDATE],
            [['current_password', 'new_password', 'confirm_password'], 'required', 'on'=>self::SCENARIO_CHANGE_PASSWORD],
            [['confirm_password'],'compare','compareAttribute'=>'new_password'],
            [['current_password', 'new_password', 'confirm_password'], 'safe'],
            [['new_password', 'confirm_password'], 'string', 'min'=>6],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'current_password' => Yii::t('app', 'Current Password'),
            'new_password' => Yii::t('app', 'New Password'),
            'confirm_passsword' => Yii::t('app', 'Confirm Password'),
            'member_code' => Yii::t('app', 'Member Code'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'phone' => Yii::t('app', 'Phone'),
            'id_card_number' => Yii::t('app', 'ID Card Number'),
            'id_card_photo' => Yii::t('app', 'ID Card Photo'),
            'photo' => Yii::t('app', 'Pass Photo'),
            'address' => Yii::t('app', 'Address'),
            'province_id' => Yii::t('app', 'Province'),
            'regency_id' => Yii::t('app', 'City'),
            'district_id' => Yii::t('app', 'District'),
            'postal_code' => Yii::t('app', 'Postal Code'),
            'branch_id' => Yii::t('app', 'Branch Office'),
            'status' => Yii::t('app', 'Status'),
            'confirmed_at' => Yii::t('app', 'Confirmed At'),
            'confirmed_by' => Yii::t('app', 'Confirmed By'),
            'blocked_at' => Yii::t('app', 'Blocked At'),
            'blocked_reason' => Yii::t('app', 'Blocked Reason'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'agree' => Yii::t('app', 'Agree'),
            'password_hash' => Yii::t('app', 'Password'),
        ];
    }
    
    protected function setBranchMapping()
    {
        $branchs = Branch::find()->actived()->all();
        foreach ($branchs as $branch) :
            $branchMapping = ($branch->district_mapping);
            if (in_array($this->district_id, $branchMapping)) {
                return $branch->id;
            }
        endforeach;
        
        return Branch::DEFAULT_BRANCH_ID;
    }
    
    public function beforeValidate() {
        
        if ($this->scenario == self::SCENARIO_REGISTER) {
            $this->prefix_member_code = self::PREFIX_MEMBER_GENERAL;
        }
        
        return parent::beforeValidate();
    }
    
    public function beforeSave($insert) {
        
        if ($insert) {
            $this->member_code = self::generateMemberCode($this->id_card_number, $this->prefix_member_code);
        }
        
        if (!empty($this->password_hash)) {
            $this->setPassword($this->password_hash);
        }
        
        if ($this->scenario == self::SCENARIO_CHANGE_PASSWORD) {
            $this->setPassword($this->new_password);
        }
        
        if ($this->scenario == self::SCENARIO_REGISTER) {
            $this->branch_id = $this->setBranchMapping();
        }
        
        $this->processUploadFile();
        
        switch ($this->status) {
            case self::STATUS_INACTIVE :
                $this->blocked_at = date('Y-m-d H:i:s');
                break;
            case self::STATUS_ACTIVE : 
                $this->confirmed_at = date('Y-m-d H:i:s');
                $this->confirmed_by = Yii::$app->user->id;
                $this->blocked_at = null;
                break;
        }
        
        return parent::beforeSave($insert);
    }
    
    public function afterSave($insert, $changedAttributes) {
        
        if ($this->scenario == self::SCENARIO_REGISTER || $this->scenario == self::SCENARIO_INSERT) {
            $this->sendRegisterNotification();
        }
        
        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Provinces::className(), ['id' => 'province_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getRegency()
    {
        return $this->hasOne(Regencies::className(), ['id' => 'regency_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(Districts::className(), ['id' => 'district_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }
    
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => [self::STATUS_ACTIVE, self::STATUS_WAITING_APPROVAL]]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('Method "' . __CLASS__ . '::' . __METHOD__ . '" is not implemented.');
    }

    public function getAuthKey() {
        return md5($this->id);
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($authKey) {
        
    }
    
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    
    /**
     * return boolean whether status active or not.
     * 
     * @return boolean
     */
    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }
    
    /**
     * return boolean whether status active or not.
     * 
     * @return boolean
     */
    public function isInActive()
    {
        return $this->status === self::STATUS_INACTIVE;
    }
    
    /**
     * return boolean whether status active or not.
     * 
     * @return boolean
     */
    public function isNeedConfirmed()
    {
        return $this->status === self::STATUS_WAITING_APPROVAL;
    }
    
    /**
     * @param type $identityNumber
     * @param type $prefix
     * @param type $padLength
     * @param type $separator
     * @return type
     */
    public static function generateMemberCode($identityNumber, $prefix = self::PREFIX_MEMBER_GENERAL, $padLength = 7, $separator = '')
    {
        $identityNumber = substr($identityNumber, 0, 6);
        $left = $prefix . $separator . $identityNumber . $separator;
        $leftLen = strlen($left);
        $increment = 1;

        $last = self::find()
            ->select('member_code')
            ->where(['LIKE', 'member_code', $left])
            ->orderBy(['id' => SORT_DESC])
            ->limit(1)
            ->scalar();

        if ($last) {
            $increment = (int) substr($last, $leftLen, $padLength);
            $increment++;
        }

        $number = str_pad($increment, $padLength, '0', STR_PAD_LEFT);

        return $left . $separator . $number;
    }
    
    /**
     * - delete photoFile
     * 
     * @return type
     */
    public function beforeDelete()
    {
        /* todo: delete the corresponding file in storage */
        $this->deletePhoto();
        $this->deleteIdCardPhoto();
        
        return parent::beforeDelete();
    }
    
    protected function deletePhoto()
    {
        @unlink(Yii::getAlias('@app/' . $this->path) . $this->photo);
    }
    
    protected function deleteIdCardPhoto()
    {
        @unlink(Yii::getAlias('@app/' . $this->path) . $this->id_card_photo);
    }
    
    /**
     * process uploaded file
     * 
     * @return boolean
     */
    public function processUploadFile()
    {
        if (!empty($this->photoFile)) {
            $this->deletePhoto();

            $path = str_replace('web/', '', $this->path);
            
            // generate filename
            $filename = Inflector::slug($this->first_name . '-' . Yii::$app->security->generateRandomString(20));
            $filename = $filename . '.' . $this->photoFile->extension;
            
            $this->photoFile->saveAs($path . $filename);
            $this->photo = $filename;
        }
        
        if (!empty($this->idCardPhotoFile)) {
            $this->deleteIdCardPhoto();

            $path = str_replace('web/', '', $this->path);
            
            // generate filename
            $filename = Inflector::slug($this->first_name . '-' . Yii::$app->security->generateRandomString(20));
            $filename = $filename . '.' . $this->idCardPhotoFile->extension;
            
            $this->idCardPhotoFile->saveAs($path . $filename);
            $this->id_card_photo = $filename;
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
    
    /**
     * get url file
     * 
     * @return type
     */
    public function getIdCardPhotoUrl() 
    {
        if (empty($this->id_card_photo)) {
            return null;
        }

        $path = $this->path . $this->id_card_photo;

        if (!file_exists(Yii::getAlias('@app/' . $path))) {
            return 'https://via.placeholder.com/550x550';
        }

        return Url::to('@' . $path, true);
    }
    
    public function getPhotoUrlHtml($options = ['target' => '_blank'])
    {
        return Html::a($this->getPhotoUrl(), $this->getPhotoUrl(), $options);
    }
    
    public function getIdCardPhotoUrlHtml($options = ['target' => '_blank'])
    {
        return Html::a($this->getIdCardPhotoUrl(), $this->getIdCardPhotoUrl(), $options);
    }
    
    public function getPhotoImg($options = ['class' => 'img-responsive'])
    {
        return Html::img($this->getPhotoUrl(), $options);
    }
    
    public function getIdCardPhotoImg($options = ['class' => 'img-responsive'])
    {
        return Html::img($this->getIdCardPhotoUrl(), $options);
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
    
    public function getStatusWithStyle() {
        switch ($this->status) {
			case self::STATUS_ACTIVE :
				return Html::label($this->getStatusLabel(), null, ['class'=>'label label-success label-sm']);
			case self::STATUS_INACTIVE :
				return Html::label($this->getStatusLabel(), null, ['class'=>'label label-danger label-sm']);
			case self::STATUS_WAITING_APPROVAL :
				return Html::label($this->getStatusLabel(), null, ['class'=>'label label-warning label-sm']);
			default :
				return Html::label($this->getStatusLabel(), null, ['class'=>'label label-default label-sm']);
		}
    }
    
    public static function statusLabels() {
        return ArrayHelper::merge(parent::statusLabels(), [
            self::STATUS_WAITING_APPROVAL => Yii::t('app', 'Need an Approve')
        ]);
    }
    
    public function sendForgotPasswordNotification($newPassword)
    {
        $model = $this;
        $mail = Yii::$app->mailer
			->compose(['html' => 'member/forgot-password'], ['model' => $model, 'newPassword' => $newPassword])
			->setFrom([Config::getEmailNoReply() => Yii::$app->name])
			->setTo($this->email)
			->setSubject(Config::getEmailSubject() . ' | Lupa Password')
            ->send();
        
        return $mail;
    }
    
    public function sendRegisterNotification()
    {
        $model = $this;
        $mail = Yii::$app->mailer
			->compose(['html' => 'member/register'], ['model' => $model])
			->setFrom([Config::getEmailNoReply() => Yii::$app->name])
			->setTo($this->email)
			->setSubject(Config::getEmailSubject() . ' | Registrasi Berhasil, Selamat datang di ' . Config::getAppName())
            ->send();
        
        return $mail;
    }
    
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    public static function prefixMemberCodeLabels()
    {
        return [
            self::PREFIX_MEMBER_MAIN => 'Pusat',
            self::PREFIX_MEMBER_PROVINCE => 'Provinsi',
            self::PREFIX_MEMBER_CITY => 'Kota',
            self::PREFIX_MEMBER_GENERAL => 'Umum',
        ];
    }
}
