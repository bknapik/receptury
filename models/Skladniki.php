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
            [
                'alergen',
                'required',
                'when' => function ($model) {
                        return $model->nazwa_do_skladu == '';
                    },
                'whenClient' => "function (attribute, value) {
                        return jQuery('#skladniki-nazwa_do_skladu').val() == '';
                        }",
                'message' => 'Alergen musi być wypełniony jeżeli nie ma nazwy do składu'
            ],
            [
                'nazwa_do_skladu',
                'required',
                'when' => function ($model) {
                        return $model->alergen == '';
                    },
                'whenClient' => "function (attribute, value) {
                        return jQuery('#skladniki-alergen').val() == '';
                        }",
                'message' => 'Nazwa do składu musi być wypełniona jeżeli nie ma alergenu'
            ],
            [
                'przelicznik_szt_kg',
                'required',
                'when' => function ($model) {
                        return $model->jednostka == 'szt';
                    }, 'whenClient' => "function (attribute, value) {
                        return jQuery('#skladniki-jednostka')[0].selectedIndex == 1;
                        }",
                'message' => 'Musisz podać przelicznik sztuk na kilogramy'
            ],
            [
                'przelicznik_l_kg',
                'required',
                'when' => function ($model) {
                        return $model->jednostka == 'l';
                    },
                'whenClient' => "function (attribute, value) {
                        return jQuery('#skladniki-jednostka')[0].selectedIndex == 2;
                        }",
                'message' => 'Musisz podać przelicznik litrów na kilogramy'
            ],
        ];
    }

    /**
     * Makes assoc array of ingredients without one which is just edited with additional null value
     * @param $ingredient_id int id of ingredient that is just edited
     * @return array Skladniki array of valid ingredients
     */
    public function getParentsArr($ingredient_id)
    {
        if ($ingredient_id != null && $ingredient_id != '') {
            $parents = $this->find()->where('id!=' . $ingredient_id)->all();
        } else {
            $parents = $this->find()->all();
        }
        $parents_arr = array();
        $parents_arr[null] = 'Wybierz';
        foreach ($parents as $parent) {
            $parents_arr[$parent->id] = $parent->nazwa_skladnika;
        }
        return $parents_arr;
    }

    /**
     * @param string $where where params
     * @param string $name name of the field
     * @param string $nullValue
     * @return array assoc array id => {$name}
     */
    public function getAssocArr($where = '1', $name = 'nazwa_skladnika', $nullValue = '')
    {
        $parents = $this->find()->where($where)->all();
        $parents_arr = array();
        if ($nullValue != '') {
            $parents_arr[null] = 'Wybierz';
        }
        foreach ($parents as $parent) {
            $parents_arr[$parent->id] = $parent->{$name};
        }
        return $parents_arr;
    }

    /**
     * @return array|\yii\db\ActiveRecord[] list of child ingredients of complex ingredient
     */
    public function getChildren()
    {
        return $this->ingredients;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFunction()
    {
        return $this->hasOne(FunkcjaTechnologiczna::className(), ['id' => 'funkcja_technologiczna_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasMany(SkladnikiSkladniki::className(), ['rodzic_id' => 'id']);
    }

    /**
     * Saves ingredients for ingredient
     * @param $ingredientsForModel array array of ingredients saved for ingredient before
     * @param $post array post request array
     */
    public function saveIngredients($ingredientsForModel, $post)
    {
        /** @var $ingredient Skladniki */
        foreach ($ingredientsForModel as $ingredient) {
            $ingredient->delete();
        }
        $sum = 0;
        if (isset($post['SkladnikiSkladniki']['skladnik_id'][0]) && !empty($post['SkladnikiSkladniki']['skladnik_id'][0])) {
            foreach ($post['SkladnikiSkladniki']['skladnik_id'] as $key => $value) {
                $sum += $post['SkladnikiSkladniki']['kilogramy'][$key];
            }
            foreach ($post['SkladnikiSkladniki']['skladnik_id'] as $key => $value) {
                if ($value != '') {
                    $ss = new SkladnikiSkladniki();
                    $ss->skladnik_id = $value;
                    $ss->rodzic_id = $this->id;
                    $ss->kilogramy = $post['SkladnikiSkladniki']['kilogramy'][$key];
                    $ss->procenty = $ss->countPercent($post['SkladnikiSkladniki']['procenty'][$key], $post['SkladnikiSkladniki']['kilogramy'][$key], $sum);
                    $ss->wyswietlac_procent = $post['SkladnikiSkladniki']['wyswietlac_procent'][$key];
                    $ss->save();
                }
            }
        }
    }

} 