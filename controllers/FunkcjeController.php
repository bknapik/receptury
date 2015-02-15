<?php
/**
 * Created by PhpStorm.
 * User: knapi_000
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use app\models\Funkcja;
use Yii;
use yii\web\Controller;

class FunkcjeController extends Controller
{

    public function actionIndex()
    {
        $model = new Funkcja();
        $list = $model->find()->all();
        return $this->render('index', array('list' => $list));
    }

    public function actionAdd()
    {
        $model = new Funkcja();
        $id = \Yii::$app->request->get('id');
        if ($id) {
            $model = Funkcja::findOne($id);
        }
        if (\Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $ret = $model->load($post, 'Funkcja');
            if ($ret && $model->validate()) {
                $model->save();
                $this->redirect('?r=funkcje%2Findex');
                // all inputs are valid
            } else {
                // validation failed: $errors is an array containing error messages
                $errors = $model->errors;
            }
        }
        return $this->render('add', array('model' => $model));
    }

    public function actionDel(){
        $id = \Yii::$app->request->get('id');
        if($id){
            $model = Funkcja::findOne($id);
            $model->delete();
            $this->redirect('?r=funkcje%2Findex');
        }
    }
} 