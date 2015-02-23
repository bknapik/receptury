<?php
/**
 * Created by PhpStorm.
 * User: knapi_000
 * Date: 15.02.15
 * Time: 12:10
 */

namespace app\models;
use yii\db\ActiveRecord;

class Receptury extends ActiveRecord {
    public static function tableName(){
        return 'receptury';
    }

    public function getIngredientsArr(){
        $ingredients = Skladniki::find()->all();
        $ingredients_arr = array();
        $ingredients_arr[null] = 'Wybierz';
        foreach ($ingredients as $ingredient) {
            $ingredients_arr[$ingredient->id] = $ingredient->nazwa_skladnika;
        }
        return $ingredients_arr;
    }

    public function saveIngredients($ingredientsForModel,$post){
        foreach($ingredientsForModel as $ingredient){
            $ingredient->delete();
        }
        foreach ($post['RS']['skladnik_id'] as $key => $value) {
            if ($value != '') {
                $rs = new RS();
                $rs->skladnik_id = $value;
                $rs->receptura_id = $this->id;
                $rs->jednostka = $post['RS']['jednostka'][$key];
                $rs->ilosc = $post['RS']['ilosc'][$key];
                $rs->save();
            }
        }
    }
} 