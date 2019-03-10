<?php

namespace common\models\doctors;

use common\helpers\CommonHelpers;
use frontend\models\User;
use Yii;

/**
 * This is the model class for table "{{%doctor_infos}}".
 *
 * @property int $id
 * @property int $uid Uid
 * @property int $status status
 * @property int $hospital_id 医院ID
 * @property string $name 医生姓名
 * @property string $doctor_type 科目
 * @property string $role 等级
 * @property string $hospital_location 医院地址
 * @property string $hospital_name 医院名称
 * @property string $certificate 证书
 * @property int $create_at
 * @property int $update_at
 * @property int $address
 * @property int $area
 * @property int $city
 * @property int $province
 * @property int $ills
 * @property int $recommend
 * @property int $money
 * @property int $avatar
 */
class DoctorInfos extends My
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%doctor_infos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'hospital_id', 'created_at', 'updated_at','recommend','status'], 'integer'],
            [['name', 'doctor_type','hospital_id','uid'], 'required'],
            [['certificate','avatar'], 'safe'],
            [['name', 'role', 'hospital_location', 'hospital_name',], 'string', 'max' => 255],
            [['doctor_type'], 'string', 'max' => 10],
            [['money'],'compare','compareValue'=>0,'operator'=>'>='],
            [['money'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'status' => '审核状态',//0 待审核  1通过  2拒绝
            'hospital_id' => '医院ID',
            'name' => '医生姓名',
            'doctor_type' => '科目',
            'role' => '职称',
            'hospital_location' => '医院地址',
            'hospital_name' => '医院名称',
            'address' => '详细地址',
            'city' => '城市',
            'province' => '省份',
            'area' => '区域',
            'certificate' => '证书',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'ills'=> '擅长疾病',
            'recommend'=> '是否推荐',
            'money'=>'余额',
            'avatar' => '头像'
        ];
    }

    /**
     * {@inheritdoc}
     * @return DoctorInfosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DoctorInfosQuery(get_called_class());
    }

    static function getHospitalIdByUid($uid)
    {
        $doctor =  self::findOne(['uid' => $uid]);
        if ($doctor){
            return $doctor->hospital_id;
        }
        return null;
    }

    static function findAll($condition = null)
    {
        if (is_array($condition)){
            return parent::findAll($condition); // TODO: Change the autogenerated stub
        }else{
            if (is_string($condition)){
                return self::find()->where($condition)->all();
            }elseif(!$condition){
                return self::find()->all();
            }
        }
    }

    function afterFind()
    {
        if ($this->certificate){
            $this->certificate = \Qiniu\json_decode($this->certificate);
        }
        parent::afterFind(); // TODO: Change the autogenerated stub
    }

    function beforeSave($insert)
    {
        if ($this->certificate && is_array($this->certificate)){
            $this->certificate = CommonHelpers::base64ToImg($this->certificate);
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    function getRelatedUser(){
        return $this->hasOne(User::className(),['id'=>'uid']);
    }
}
