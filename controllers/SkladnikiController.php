<?php
/**
 * Created by PhpStorm.
 * User: kinga
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use app\models\FunkcjaTechnologiczna;
use Yii;
use yii\web\Controller;
use app\models\Skladniki;
use app\models\SkladnikiSkladniki;

/**
 * Class SkladnikiController
 * @package app\controllers
 */
class SkladnikiController extends Controller
{

    /**
     * Displays list of ingredients
     * @return string html code
     */
    public function actionIndex()
    {
        $model = new Skladniki();
        $list = $model->find()->all();
        return $this->render('index', array('list' => $list));
    }

    /**
     * Displays form for ingredient and saves it
     * @return string html code
     */
    public function actionAdd()
    {
        $model = new Skladniki();
        $ingredient_id = \Yii::$app->request->get('id');
        if ($ingredient_id) {
            $model = Skladniki::findOne($ingredient_id);
            $ingredientsForModel = SkladnikiSkladniki::find()->where('rodzic_id=' . $ingredient_id)->orderBy('procenty DESC')->all();
        } else {
            $ingredientsForModel = array();
        }
        if (\Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $ret = $model->load($post, 'Skladniki');
//            var_dump($model->validate());die;
            if ($ret && $model->validate()) {
                $model->save();
                $model->saveIngredients($ingredientsForModel,$post);
                $this->redirect('?r=skladniki/index');
            }
        }
        $parents_arr = $model->getParentsArr($ingredient_id);
        $functionModel = new FunkcjaTechnologiczna();
        $functions_arr = $functionModel->getAssocArr('1','nazwa','Wybierz');
        $ingredientsModel = new Skladniki();
        $ingredients_arr = $ingredientsModel->getAssocArr('1','nazwa_skladnika','Wybierz');
        $ingredient_ingredients = new SkladnikiSkladniki();
        return $this->render('add', array('model' => $model,
                                            'parents' => $parents_arr,
                                            'functions' => $functions_arr,
                                            'ingredientsForModel' => $ingredientsForModel,
                                            'ingredients' => $ingredients_arr,
                                            'ingredient_ingredients' => $ingredient_ingredients,
                                            ));
    }

    /**
     * Remove ingredient with given id from database
     */
    public function actionDel(){
        $ingredient_id = \Yii::$app->request->get('id');
        if($ingredient_id){
            $model = Skladniki::findOne($ingredient_id);
            $model->delete();
            $this->redirect('?r=skladniki/index');
        }
    }
} 