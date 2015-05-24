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
 * Class StawkiVat
 * @package app\models
 */
class StawkiVat extends ActiveRecord {

    /**
     * @param string $where where params
     * @param string $name name of the field
     * @param string $nullValue
     * @return array assoc array id => {$name}
     */
    public function getAssocArr($where = '1', $name = 'nazwa', $nullValue = ''){
        $vatRates = StawkiVat::find()->where($where)->orderBy('litera ASC')->all();
        $vat_arr = array();
        if($nullValue != ''){
            $vat_arr[null] = $nullValue;
        }
        foreach ($vatRates as $vat) {
            $vat_arr[$vat->id] = $vat->{$name};
        }
        return $vat_arr;
    }
} 