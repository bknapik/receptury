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
            $post = Yii::$app->request->post();
            $ret = $model->load($post, 'Skladniki');
//            var_dump($model->validate());die;
            if ($ret && $model->validate()) {
                $model->save();
                $this->redirect('?r=skladniki%2Findex');
            }
        }
        $parents_arr = $model->getParentsArr($id);
        $functions_arr = $model->getFunctionsArr();
        return $this->render('add', array('model' => $model, 'parents' => $parents_arr, 'functions' => $functions_arr));
    }

    public function actionDel(){
        $id = \Yii::$app->request->get('id');
        if($id){
            $model = Skladniki::findOne($id);
            $model->delete();
            $this->redirect('?r=skladniki%2Findex');
        }
    }
} 