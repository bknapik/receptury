<?php
/**
 * Created by PhpStorm.
 * User: knapi_000
 * Date: 16.02.15
 * Time: 20:12
 */

namespace app\models;
use yii\db\ActiveRecord;

class Konfiguracja extends ActiveRecord {
    public static function tableName(){
        return 'konfiguracja';
    }
} 