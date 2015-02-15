<?php
/**
 * Created by PhpStorm.
 * User: knapi_000
 * Date: 15.02.15
 * Time: 11:55
 */

namespace app\models;
use yii\db\ActiveRecord;

class Produkty  extends ActiveRecord{
    public static function tableName(){
        return 'produkty';
    }
} 