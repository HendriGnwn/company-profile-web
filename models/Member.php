<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\web\IdentityInterface;

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
            [['first_name', 'email', 'password', 'phone', 'address', 'province_id', 'regency_id', 'district_id', 'postal_code'], 'required'],
            [['postal_code', 'branch_id', 'status', 'confirmed_by', 'created_by', 'updated_by'], 'integer'],
            [['confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'member_code', 'branch_id', 'status'], 'safe'],
            [['member_code', 'first_name', 'last_name', 'id_card_photo', 'photo'], 'string', 'max' => 100],
            [['email', 'password', 'address', 'blocked_reason'], 'string', 'max' => 255],
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
                'maxSize' => 1024 * 1024 * 1, 'on' => self::SCENARIO_INSERT],
            [['photoFile', 'idCardPhotoFile'], 'file', 'skipOnEmpty' => true, 'checkExtensionByMimeType' => true,
                'extensions' => ['jpg', 'jpeg', 'png'],
                'maxSize' => 1024 * 1024 * 1, 'on' => self::SCENARIO_UPDATE],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
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
            'branch_id' => Yii::t('app', 'Branch'),
            'status' => Yii::t('app', 'Status'),
            'confirmed_at' => Yii::t('app', 'Confirmed At'),
            'confirmed_by' => Yii::t('app', 'Confirmed By'),
            'blocked_at' => Yii::t('app', 'Blocked At'),
            'blocked_reason' => Yii::t('app', 'Blocked Reason'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
    
    public function beforeSave($insert) {
        
        if ($insert) {
            $this->member_code = self::generateMemberCode($this->id_card_number);
        }
        
        return parent::beforeSave($insert);
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
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('Method "' . __CLASS__ . '::' . __METHOD__ . '" is not implemented.');
    }

    public function getAuthKey(): string {
        return md5($this->id);
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($authKey): bool {
        
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
