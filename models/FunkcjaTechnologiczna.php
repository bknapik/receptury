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
 * Class FunkcjaTechnologiczna
 * @package app\models
 */
class FunkcjaTechnologiczna extends ActiveRecord {

    /**
     * @param string $where where params
     * @param string $name name of the field
     * @param string $nullValue
     * @return array assoc array id => {$name}
     */
    public function getAssocArr($where = '1', $name = 'nazwa', $nullValue = ''){
        $functions = FunkcjaTechnologiczna::find()->where($where)->all();
        $functions_arr = array();
        if($nullValue != ''){
            $functions_arr[null] = 'Wybierz';
        }
        foreach($functions as $function){
            $functions_arr[$function->id] = $function->{$name};
        }
        return $functions_arr;
    }
} 