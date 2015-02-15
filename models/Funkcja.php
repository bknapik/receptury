<?php
/**
 * Created by PhpStorm.
 * User: knapi_000
 * Date: 15.02.15
 * Time: 12:09
 */

namespace app\models;
use yii\db\ActiveRecord;

class Funkcja extends ActiveRecord {
    public static function tableName(){
        return 'funkcja_technologiczna';
    }
} 