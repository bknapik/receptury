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
class Receptury extends ActiveRecord
{

    /**
     * Auxiliary field to manage recipe additional allergens save
     */
    public $alergen_id = array();

    /**
     * Makes assoc array of ingredients with additional null value at the beginning
     * @return array Skladniki array with valid ingredients
     */
    public function getIngredientsArr()
    {
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
     * @param $remove
     */
    public function saveIngredients($ingredientsForModel, $post, $remove = true)
    {
        /** @var $ingredient Skladniki */
        if($remove){
            foreach ($ingredientsForModel as $ingredient) {
                $ingredient->delete();
            }
        }
        $post['RecepturySkladniki']['skladnik_id'] = array_unique($post['RecepturySkladniki']['skladnik_id']);
        foreach ($post['RecepturySkladniki']['skladnik_id'] as $key => $value) {
            if ($value != '' && $post['RecepturySkladniki']['ilosc'][$key] != null && $post['RecepturySkladniki']['ilosc'][$key] != 0) {
                $post['RecepturySkladniki']['ilosc'][$key] = str_replace(',','.',$post['RecepturySkladniki']['ilosc'][$key]);
                $rs = new RecepturySkladniki();
                $rs->skladnik_id = $value;
                $rs->receptura_id = $this->id;
                $rs->jednostka = $post['RecepturySkladniki']['jednostka'][$key];
                $rs->ilosc = $post['RecepturySkladniki']['ilosc'][$key];
                $rs->wyswietlac_procent = $post['RecepturySkladniki']['wyswietlac_procent'][$key];
                $rs->ilosc_przeliczona = $rs->countAmount();
                $rs->save();
            }
        }
    }

    /**
     * Save allergens for recipe
     * @param $allergensForModel array array of allergens saved for recipe before
     * @param $post array post request array
     * @param $remove
     */
    public function saveAllergens($allergensForModel, $post, $remove = true)
    {
        if (!empty($allergensForModel) && $remove) {
            /** @var $allergen Alergeny */
            foreach ($allergensForModel as $allergen) {
                $allergen->delete();
            }
        }
        if (!empty($post['Receptury']['alergen_id'])) {
            foreach ($post['Receptury']['alergen_id'] as $value) {
                $model = new RecepturyAlergeny();
                $model->alergen_id = $value;
                $model->receptura_id = $this->id;
                $model->save();
            }
        }
    }

    /**
     * @param string $where where params
     * @param string $name name of the field
     * @param string $nullValue
     * @return array assoc array id => {$name}
     */
    public function getAssocArr($where = '1', $name = 'nazwa', $nullValue = '')
    {
        $recipes = Receptury::find()->where($where)->orderBy('nazwa ASC')->all();
        $recipes_arr = array();
        if ($nullValue != '') {
            $recipes_arr[null] = $nullValue;
        }
        foreach ($recipes as $recipe) {
            $recipes_arr[$recipe->id] = $recipe->{$name};
        }
        return $recipes_arr;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipeIngredients()
    {
        return $this->hasMany(RecepturySkladniki::className(), ['receptura_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipeIngredientsWithOrder()
    {
        return $this->hasMany(RecepturySkladniki::className(), ['receptura_id' => 'id'])->addOrderBy('ilosc_przeliczona DESC');
    }

} 