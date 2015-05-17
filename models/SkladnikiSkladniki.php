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
 * Class SkladnikiSkladniki
 * @package app\models
 */
class SkladnikiSkladniki extends ActiveRecord {
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredient()
    {
        return $this->hasOne(Skladniki::className(), ['id' => 'skladnik_id']);
    }

    /**
     * Counts percent amount of ingredient in ingredient when given in kilograms or return percent if given
     * @param $percents float percent amount of ingredient in ingredient
     * @param $kilograms float amount of ingredient in ingredient in kilograms
     * @param $sum float sum of ingredients of ingredient in kilograms
     * @return float|int percent amount of ingredient in ingredient
     */
    public function countPercent($percents,$kilograms,$sum){
        if(!empty($percents) && is_numeric($percents)){
            return $percents;
        }
        if($sum > 0){
            return ($kilograms/$sum)*100;
        }
        return 0;

    }

} 