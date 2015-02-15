<?php
/**
 * Created by PhpStorm.
 * User: knapi_000
 * Date: 15.02.15
 * Time: 12:03
 */

namespace app\models;
use yii\db\ActiveRecord;

class Odbiorcy extends ActiveRecord {
    public static function tableName(){
        return 'odbiorcy';
    }
} 