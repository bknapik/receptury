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
use app\models\Receptury;

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
        $id = \Yii::$app->request->get('id');
        if ($id) {
            $model = Receptury::findOne($id);
        }
        if (\Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $ret = $model->load($post, 'Receptury');
            if ($ret && $model->validate()) {
                $model->save();
                $this->redirect('?r=receptury%2Findex');
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
            $model = Receptury::findOne($id);
            if (!empty($model)) {
                $model->delete();
            }
        }
        $this->redirect('?r=receptury%2Findex');
    }
} 