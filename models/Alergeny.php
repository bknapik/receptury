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
 * Class Alergeny
 * @package app\models
 */
class Alergeny extends ActiveRecord {

    /**
     * @param string $where where params
     * @param string $name name of the field
     * @return array assoc array id => {$name}
     */
    public function getAssocArr($where = '1', $name = 'nazwa')
    {
        $parents = $this->find()->where($where)->all();
        $parents_arr = array();
        foreach ($parents as $parent) {
            $parents_arr[$parent->id] = $parent->{$name};
        }
        return $parents_arr;
    }

} 