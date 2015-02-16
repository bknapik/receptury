<?php
/**
 * Created by PhpStorm.
 * User: knapi_000
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use app\models\Skladniki;
use Yii;
use yii\web\Controller;
use app\models\Receptury;
use app\models\RS;

class RecepturyController extends Controller
{

    public function actionIndex()
    {
        $model = new Receptury();
        $list = $model->find()->all();
        return $this->render('index', array('list' => $list));
    }

    public function actionAdd()
    {
        $model = new Receptury();
        $rs = new RS();

        $id = \Yii::$app->request->get('id');
        if ($id) {
            $model = Receptury::findOne($id);
            $ingredientsForModel = RS::find()->where('receptura_id=' . $id)->all();
        } else {
            $ingredientsForModel = array();
        }
        if (\Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $ret = $model->load($post, 'Receptury');
            if ($ret && $model->validate()) {
                $model->save();
                foreach($ingredientsForModel as $ingredient){
                    $ingredient->delete();
                }
                foreach ($post['RS']['skladnik_id'] as $key => $value) {
                    if ($value != '') {
                        $rs = new RS();
                        $rs->skladnik_id = $value;
                        $rs->receptura_id = $model->id;
                        $rs->jednostka = $post['RS']['jednostka'][$key];
                        $rs->ilosc = $post['RS']['ilosc'][$key];
                        $rs->save();
                    }
                }
                $this->redirect('?r=receptury%2Findex');
                // all inputs are valid
            } else {
                // validation failed: $errors is an array containing error messages
                $errors = $model->errors;
            }
        }
        $ingredients = Skladniki::find()->all();
        $ingredients_arr = array();
        $ingredients_arr[null] = 'Wybierz';
        foreach ($ingredients as $ingredient) {
            $ingredients_arr[$ingredient->id] = $ingredient->nazwa_skladnika;
        }
        return $this->render('add', array('model' => $model, 'ingredients' => $ingredients_arr, 'ingredientsForModel' => $ingredientsForModel, 'rs' => $rs));
    }

    public function actionDel()
    {
        $id = \Yii::$app->request->get('id');
        if ($id) {
            $model = Receptury::findOne($id);
            if (!empty($model)) {
                $model->delete();
            }
        }
        $this->redirect('?r=receptury%2Findex');
    }
} 