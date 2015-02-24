<?php
/**
 * Created by PhpStorm.
 * User: kinga
 * Date: 15.02.15
 * Time: 12:10
 */

namespace app\models;
use yii\db\ActiveRecord;

/**
 * Class Stawki
 * @package app\models
 */
class Stawki extends ActiveRecord {

    /**
     * Overrides method from ActiveRecord class
     * @return string database table name
     */
    public static function tableName(){
        return 'stawki_vat';
    }
} 