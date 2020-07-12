<?php
/**
 * Created by PhpStorm.
 * User: weilone
 * Date: 2020/7/11
 * Time: 18:04
 */

namespace api\controllers;

trait lmcTrait
{
    function getHostUrl($string = '')
    {
        if (!$string) {
            return '';
        }
        return \Yii::$app->request->getHostInfo() . '/' . trim($string, '/');
    }
}