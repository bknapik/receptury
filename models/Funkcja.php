<?php
/**
 * Created by PhpStorm.
 * User: kinga
 * Date: 15.02.15
 * Time: 12:09
 */

namespace app\models;
use yii\db\ActiveRecord;

/**
 * Class Funkcja
 * @package app\models
 */
class Funkcja extends ActiveRecord {

    /**
     * Overrides method from ActiveRecord class
     * @return string database table name
     */
    public static function tableName(){
        return 'funkcja_technologiczna';
    }
} 