<?php
/**
 * Created by PhpStorm.
 * User: knapi_000
 * Date: 15.02.15
 * Time: 12:10
 */

namespace app\models;
use yii\db\ActiveRecord;

class RS extends ActiveRecord {
    public static function tableName(){
        return 'receptury_skladniki';
    }
} 