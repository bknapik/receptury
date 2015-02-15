<?php
/**
 * Created by PhpStorm.
 * User: knapi_000
 * Date: 15.02.15
 * Time: 11:41
 */

namespace app\models;
use yii\db\ActiveRecord;

class Skladniki extends ActiveRecord{
    public static function tableName(){
        return 'skladniki';
    }
} 