<?php
/**
 * Created by PhpStorm.
 * User: kinga
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Receptury;
use app\models\RS;

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
        $recipe_ingredient = new RS();
        $recipe_id = \Yii::$app->request->get('id');
        if ($recipe_id) {
            $model = Receptury::findOne($recipe_id);
            $ingredientsForModel = RS::find()->where('receptura_id=' . $recipe_id)->all();
        } else {
            $ingredientsForModel = array();
        }
        if (\Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $ret = $model->load($post, 'Receptury');
            if ($ret && $model->validate()) {
                $model->save();
                $model->saveIngredients($ingredientsForModel,$post);
                $this->redirect('?r=receptury/index');
            }
        }
        $ingredients_arr = $model->getIngredientsArr();
        return $this->render('add', array('model' => $model, 'ingredients' => $ingredients_arr, 'ingredientsForModel' => $ingredientsForModel, 'recipe_ingredients' => $recipe_ingredient));
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