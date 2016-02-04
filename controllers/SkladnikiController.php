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
use app\models\Konfiguracja;
use yii\filters\AccessControl;

/**
 * Class SkladnikiController
 * @package app\controllers
 */
class SkladnikiController extends Controller
{

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function () {
                                return !\Yii::$app->user->getIsGuest();
                            },
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays list of ingredients
     * @return string html code
     */
    public function actionIndex()
    {
        $model = new Skladniki();
        $list = $model->find()->all();
        $configObject = new Konfiguracja();
        return $this->render('index', array('list' => $list, 'configObject' => $configObject));
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
            $post['Skladniki']['przelicznik_szt_kg'] = str_replace(',','.',$post['Skladniki']['przelicznik_szt_kg']);
            $post['Skladniki']['przelicznik_l_kg'] = str_replace(',','.',$post['Skladniki']['przelicznik_l_kg']);
            $post['Skladniki']['wartosc_cal'] = str_replace(',','.',$post['Skladniki']['wartosc_cal']);
            $post['Skladniki']['bialko'] = str_replace(',','.',$post['Skladniki']['bialko']);
            $post['Skladniki']['tluszcz'] = str_replace(',','.',$post['Skladniki']['tluszcz']);
            $post['Skladniki']['weglowodany'] = str_replace(',','.',$post['Skladniki']['weglowodany']);
            $post['Skladniki']['cukier'] = str_replace(',','.',$post['Skladniki']['cukier']);
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
        if($ingredient_id) {
            $ingredients_arr = $ingredientsModel->getAssocArr('id != '.$ingredient_id, 'nazwa_skladnika', 'Wybierz');
        } else {
            $ingredients_arr = $ingredientsModel->getAssocArr('1', 'nazwa_skladnika', 'Wybierz');
        }
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