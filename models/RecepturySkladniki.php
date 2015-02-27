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
 * Class RecepturySkladniki
 * @package app\models
 */
class RecepturySkladniki extends ActiveRecord {
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredient()
    {
        return $this->hasOne(Skladniki::className(), ['id' => 'skladnik_id']);
    }
} 