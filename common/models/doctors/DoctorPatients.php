<?php

namespace common\models\doctors;

use Yii;

/**
 * This is the model class for table "{{%doctor_patients}}".
 *
 * @property int $id
 * @property int $hospital_id 所属医院
 * @property int $doctor_id 所属医生
 * @property int $is_transfer 转诊
 * @property int $transfer_doctor 转诊医生
 * @property string $name 姓名
 * @property string $phone 手机
 * @property string $sex 性别
 * @property int $id_number 身份证
 * @property string $desc 描述
 * @property int $create_at 创建时间
 * @property int $update_at 更新时间
 * @property int $age 年龄
 * @property int $invite 被邀请码
 */
class DoctorPatients extends My
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%doctor_patients}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hospital_id', 'doctor_id', 'is_transfer','created_at', 'updated_at', 'age','transfer_doctor'], 'integer'],
            [['doctor_id','hospital_id','name'], 'required'],
            [['desc','id_number'], 'string'],
            [['name', 'phone', 'sex','invite'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hospital_id' => '所属医院',
            'doctor_id' => '所属医生',
            'is_transfer' => '转诊',
            'transfer_doctor' => '转诊医生',
            'name' => '姓名',
            'phone' => '手机',
            'sex' => '性别',
            'id_number' => '身份证',
            'desc' => '描述',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'age' => '年龄',
            'invite' =>'被邀请码'
        ];
    }

    /**
     * {@inheritdoc}
     * @return DoctorPatientsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DoctorPatientsQuery(get_called_class());
    }

    function getTransferDoctor(){
       return $this->hasOne(DoctorInfos::className(),['id'=>'transfer_doctor']);
    }
}
