<?php
/**
 * Created by PhpStorm.
 * User: knapi_000
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Skladniki;

class SkladnikiController extends Controller
{

    public function actionIndex()
    {
        $model = new Skladniki();
        $list = $model->find()->all();
        return $this->render('index', array('list' => $list));
    }

    public function actionAdd()
    {
        $model = new Skladniki();
        $id = \Yii::$app->request->get('id');
        if ($id) {
            $model = Skladniki::findOne($id);
        }
        if (\Yii::$app->request->isPost) {
//            var_dump(\Yii::$app->request->post('Skladniki'));
            //$model->attributes = array_merge($model->attributes, \Yii::$app->request->post('Skladniki'));
            $post = Yii::$app->request->post();
            $ret = $model->load($post, 'Skladniki');
            if ($ret && $model->validate()) {
                $model->save();
                $this->redirect('?r=skladniki%2Findex');
                // all inputs are valid
            } else {
                // validation failed: $errors is an array containing error messages
                $errors = $model->errors;
            }
        }
        $parents = $model->find()->all();
        $parents_arr = array();
        $parents_arr[null] = 'Wybierz';
        foreach ($parents as $parent) {
            if ($parent->id != $id) {
                $parents_arr[$parent->id] = $parent->nazwa_skladnika;
            }
        }
        return $this->render('add', array('model' => $model, 'parents' => $parents_arr));
    }
} 