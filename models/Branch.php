<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property string $province_id
 * @property string $regency_id
 * @property string $district_id
 * @property integer $postal_code
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Provinces $province
 * @property Regencies $regency
 * @property Districts $district
 * @property BranchMappingAddress[] $branchMappingAddresses
 * @property Member[] $members
 */
class Branch extends \app\models\BaseActiveRecord
{
    const DEFAULT_BRANCH_ID = 1;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'province_id', 'regency_id', 'district_id', 'postal_code'], 'required'],
            [['description'], 'string'],
            [['postal_code', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'address'], 'string', 'max' => 255],
            [['province_id'], 'string', 'max' => 2],
            [['regency_id'], 'string', 'max' => 4],
            [['district_id'], 'string', 'max' => 7],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['province_id' => 'id']],
            [['regency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regencies::className(), 'targetAttribute' => ['regency_id' => 'id']],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'id']],
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
            'description' => Yii::t('app', 'Description'),
            'address' => Yii::t('app', 'Address'),
            'province_id' => Yii::t('app', 'Province ID'),
            'regency_id' => Yii::t('app', 'Regency ID'),
            'district_id' => Yii::t('app', 'District ID'),
            'postal_code' => Yii::t('app', 'Postal Code'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Provinces::className(), ['id' => 'province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegency()
    {
        return $this->hasOne(Regencies::className(), ['id' => 'regency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(Districts::className(), ['id' => 'district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranchMappingAddresses()
    {
        return $this->hasMany(BranchMappingAddress::className(), ['branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['branch_id' => 'id']);
    }
}
