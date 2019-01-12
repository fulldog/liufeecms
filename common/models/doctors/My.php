<?php
/**
 * Created by PhpStorm.
 * User: weilone
 * Date: 2018/12/29
 * Time: 23:04
 */

namespace common\models\doctors;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Exception;

class My extends ActiveRecord
{
    public  $_status = [
        '待审核', '通过', '拒绝' ,
    ];

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    function _load($data)
    {
        try{
            foreach ($data as $k=>$v){
                $this->$k = $v;
            }
            return true;
        }catch (Exception $e){
            exit($e->getMessage());
        }
    }

    function getStatus($status=false,$returnArr=false){
        if ($status){
            if ($returnArr){
                return [$status=>$this->_status[$status]];
            }
            return $this->_status[$status];
        }
        return $this->_status[$this->status];
    }
}