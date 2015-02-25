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
 * Class Receptury
 * @package app\models
 */
class Receptury extends ActiveRecord {

    /**
     * Makes assoc array of ingredients with additional null value at the beginning
     * @return array Skladniki array with valid ingredients
     */
    public function getIngredientsArr(){
        $ingredients = Skladniki::find()->all();
        $ingredients_arr = array();
        $ingredients_arr[null] = 'Wybierz';
        foreach ($ingredients as $ingredient) {
            $ingredients_arr[$ingredient->id] = $ingredient->nazwa_skladnika;
        }
        return $ingredients_arr;
    }

    /**
     * Saves ingredients for recipe
     * @param $ingredientsForModel array array of ingredients saved for recipe before
     * @param $post array post request array
     */
    public function saveIngredients($ingredientsForModel,$post){
        /** @var $ingredient Skladniki */
        foreach($ingredientsForModel as $ingredient){
            $ingredient->delete();
        }
        foreach ($post['RecepturySkladniki']['skladnik_id'] as $key => $value) {
            if ($value != '') {
                $rs = new RecepturySkladniki();
                $rs->skladnik_id = $value;
                $rs->receptura_id = $this->id;
                $rs->jednostka = $post['RecepturySkladniki']['jednostka'][$key];
                $rs->ilosc = $post['RecepturySkladniki']['ilosc'][$key];
                $rs->save();
            }
        }
    }

    /**
     * @param string $where where params
     * @param string $name name of the field
     * @param string $nullValue
     * @return array assoc array id => {$name}
     */
    public function getAssocArr($where = '1', $name = 'nazwa', $nullValue = ''){
        $recipes = Receptury::find()->where($where)->all();
        $recipes_arr = array();
        if($nullValue != ''){
            $recipes_arr[null] = $nullValue;
        }
        foreach ($recipes as $recipe) {
            $recipes_arr[$recipe->id] = $recipe->{$name};
        }
        return $recipes_arr;
    }
} 