<?php
/**
 * Created by PhpStorm.
 * User: kinga
 * Date: 15.02.15
 * Time: 11:41
 */

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Skladniki
 * @package app\models
 */
class Skladniki extends ActiveRecord
{

    /**
     * Defines rules for validator
     * Overrides method from Model class
     * @return array validation rules
     */
    public function rules()
    {
        return [
            [['nazwa_skladnika'], 'required'],
            ['alergen', 'required', 'when' => function ($model) {
                    return $model->nazwa_do_skladu == '';
                }, 'whenClient' => "function (attribute, value) {
                        return jQuery('#skladniki-nazwa_do_skladu').val() == '';
                        }",
                'message' => 'Alergen musi być wypełniony jeżeli nie ma nazwy do składu'],
            ['nazwa_do_skladu', 'required', 'when' => function ($model) {
                    return $model->alergen == '';
                }, 'whenClient' => "function (attribute, value) {
                        return jQuery('#skladniki-alergen').val() == '';
                        }",
                'message' => 'Nazwa do składu musi być wypełniona jeżeli nie ma alergenu'],
            ['przelicznik_szt_kg', 'required', 'when' => function ($model) {
                    return $model->jednostka == 'szt';
                }, 'whenClient' => "function (attribute, value) {
                        return jQuery('#skladniki-jednostka')[0].selectedIndex == 1;
                        }",
                'message' => 'Musisz podać przelicznik sztuk na kilogramy'],
            ['przelicznik_l_kg', 'required', 'when' => function ($model) {
                    return $model->jednostka == 'l';
                }, 'whenClient' => "function (attribute, value) {
                        return jQuery('#skladniki-jednostka')[0].selectedIndex == 2;
                        }",
                'message' => 'Musisz podać przelicznik litrów na kilogramy'],
        ];
    }

    /**
     * Makes assoc array of ingredients without one which is just edited with additional null value
     * @param $ingredient_id int id of ingredient that is just edited
     * @return array Skladniki array of valid ingredients
     */
    public function getParentsArr($ingredient_id){
        $parents = $this->find()->where('id!='.$ingredient_id)->all();
        $parents_arr = array();
        $parents_arr[null] = 'Wybierz';
        foreach ($parents as $parent) {
            $parents_arr[$parent->id] = $parent->nazwa_skladnika;
        }
        return $parents_arr;
    }

    /**
     * Makes assoc array of functions with additional null value
     * @return array Funkcja array of valid functions
     */
    public function getFunctionsArr(){
        $functions = Funkcja::find()->all();
        $functions_arr = array();
        $functions_arr[null] = 'Wybierz';
        foreach($functions as $function){
            $functions_arr[$function->id] = $function->nazwa;
        }
        return $functions_arr;
    }
} 