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

    /**
     * Calculates amount of ingredients in kg
     * @return float
     */
    public function countAmount(){
        switch($this->jednostka){
            default:
            case 'kg' : return $this->ilosc;
            case 'l' : return ($this->ingredient->przelicznik_l_kg != 0) ?
                                $this->ilosc/($this->ingredient->przelicznik_l_kg) :
                                $this->ilosc;
            case 'szt' : return ($this->ingredient->przelicznik_szt_kg != 0) ?
                                $this->ilosc/($this->ingredient->przelicznik_szt_kg) :
                                $this->ilosc;
        }
    }
} 