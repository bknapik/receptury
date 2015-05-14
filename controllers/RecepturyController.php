<?php
/**
 * Created by PhpStorm.
 * User: kinga
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use app\models\Alergeny;
use app\models\RecepturyAlergeny;
use app\models\Skladniki;
use Yii;
use yii\web\Controller;
use app\models\Receptury;
use app\models\RecepturySkladniki;

/**
 * Class RecepturyController
 * @package app\controllers
 */
class RecepturyController extends Controller
{

    /**
     * Displays list of recipes
     * @return string html code
     */
    public function actionIndex()
    {
        $model = new Receptury();
        $list = $model->find()->all();
        return $this->render('index', array('list' => $list));
    }

    /**
     * Displays form for recipe and saves it
     * @return string html code
     */
    public function actionAdd()
    {
        $model = new Receptury();
        $recipe_ingredient = new RecepturySkladniki();
        $recipe_id = \Yii::$app->request->get('id');
        $model->alergen_id = array();
        if ($recipe_id) {
            $model = Receptury::findOne($recipe_id);
            $ingredientsForModel = RecepturySkladniki::find()->where('receptura_id=' . $recipe_id)->orderBy('ilosc_przeliczona DESC')->all();
            $allergensForModel = RecepturyAlergeny::find()->where('receptura_id=' . $recipe_id)->all();
        } else {
            $ingredientsForModel = array();
            $allergensForModel = array();
        }
        if (\Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $ret = $model->load($post, 'Receptury');
            if ($ret && $model->validate()) {
                $model->save();
                $model->saveIngredients($ingredientsForModel, $post);
                $model->saveAllergens($allergensForModel, $post);
                $this->redirect('?r=receptury/index');
            }
        }
        $ingredientsModel = new Skladniki();
        $ingredients_arr = $ingredientsModel->getAssocArr('1', 'nazwa_skladnika', 'Wybierz');
        $allergensModel = new Alergeny();
        $allergens_arr = $allergensModel->getAssocArr('1', 'nazwa');
        foreach ($allergensForModel as $afm) {
            $model->alergen_id[] = $afm->alergen_id;
        }
        return $this->render('add', array(
            'model' => $model,
            'ingredients' => $ingredients_arr,
            'allergens' => $allergens_arr,
            'ingredientsForModel' => $ingredientsForModel,
            'allergensForModel' => $allergensForModel,
            'recipe_ingredients' => $recipe_ingredient
        ));
    }

    /**
     * @return string html code
     */
    public function actionAddSimilar()
    {
        $model = new Receptury();
        $model_old = new Receptury();
        $recipe_ingredient = new RecepturySkladniki();
        $recipe_id = \Yii::$app->request->get('id');
        $model->alergen_id = array();
        if ($recipe_id) {
            $model_old = Receptury::findOne($recipe_id);
            foreach ($model_old->oldAttributes as $key => $value) {
                if ($key != 'id') {
                    $model->$key = $value;
                }
            }
            $ingredientsForModel = RecepturySkladniki::find()->where('receptura_id=' . $recipe_id)->orderBy('ilosc_przeliczona DESC')->all();
            $allergensForModel = RecepturyAlergeny::find()->where('receptura_id=' . $recipe_id)->all();
        } else {
            $ingredientsForModel = array();
            $allergensForModel = array();
        }
        if (\Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $ret = $model->load($post, 'Receptury');
            if ($ret && $model->validate()) {
                $model->save();
                $model->saveIngredients($ingredientsForModel, $post, false);
                $model->saveAllergens($allergensForModel, $post, false);
                $this->redirect('?r=receptury/index');
            }
        }
        $ingredientsModel = new Skladniki();
        $ingredients_arr = $ingredientsModel->getAssocArr('1', 'nazwa_skladnika', 'Wybierz');
        $allergensModel = new Alergeny();
        $allergens_arr = $allergensModel->getAssocArr('1', 'nazwa');
        foreach ($allergensForModel as $afm) {
            $model->alergen_id[] = $afm->alergen_id;
        }
        return $this->render('add', array(
            'model' => $model,
            'ingredients' => $ingredients_arr,
            'allergens' => $allergens_arr,
            'ingredientsForModel' => $ingredientsForModel,
            'allergensForModel' => $allergensForModel,
            'recipe_ingredients' => $recipe_ingredient
        ));
    }

    /**
     * Remove recipe with given id from database
     */
    public function actionDel()
    {
        $recipe_id = \Yii::$app->request->get('id');
        if ($recipe_id) {
            $model = Receptury::findOne($recipe_id);
            if (!empty($model)) {
                $model->delete();
            }
        }
        $this->redirect('?r=receptury/index');
    }
} 