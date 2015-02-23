<?php
/**
 * Created by PhpStorm.
 * User: knapi_000
 * Date: 15.02.15
 * Time: 11:41
 */

namespace app\models;

use yii\db\ActiveRecord;

class Skladniki extends ActiveRecord
{
    public static function tableName()
    {
        return 'skladniki';
    }

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

    public function getParentsArr($id){
        $parents = $this->find()->where('id='.$id)->all();
        $parents_arr = array();
        $parents_arr[null] = 'Wybierz';
        foreach ($parents as $parent) {
            $parents_arr[$parent->id] = $parent->nazwa_skladnika;
        }
        return $parents_arr;
    }

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