<?php
/**
 * Created by PhpStorm.
 * User: weilone
 * Date: 2018/12/27
 * Time: 22:06
 */

namespace frontend\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class DoctorInfos extends ActiveRecord
{

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    static function tableName()
    {
        return '{{%doctor_infos}}'; // TODO: Change the autogenerated stub
    }

    static function getHospitalIdByUid($uid)
    {
        return self::findOne(['id' => $uid])->toArray()['hospital_id'];
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
}