<?php
/**
 * Created by PhpStorm.
 * User: knapi_000
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use app\models\Stawki;
use Yii;
use yii\web\Controller;

class StawkiController extends Controller
{

    public function actionIndex()
    {
        $model = new Stawki();
        $list = $model->find()->all();
        return $this->render('index', array('list' => $list));
    }

    public function actionAdd()
    {
        $model = new Stawki();
        $id = \Yii::$app->request->get('id');
        if ($id) {
            $model = Stawki::findOne($id);
        }
        if (\Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $ret = $model->load($post, 'Stawki');
            if ($ret && $model->validate()) {
                $model->save();
                $this->redirect('?r=stawki%2Findex');
            }
        }
        return $this->render('add', array('model' => $model));
    }

    public function actionDel(){
        $id = \Yii::$app->request->get('id');
        if($id){
            $model = Stawki::findOne($id);
            $model->delete();
            $this->redirect('?r=stawki%2Findex');
        }
    }
} 