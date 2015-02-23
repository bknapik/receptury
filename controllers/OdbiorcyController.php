<?php
/**
 * Created by PhpStorm.
 * User: knapi_000
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use app\models\Odbiorcy;
use app\models\OP;
use app\models\Produkty;
use Yii;
use yii\web\Controller;

class OdbiorcyController extends Controller
{

    public function actionIndex()
    {
        $model = new Odbiorcy();
        $list = $model->find()->all();
        return $this->render('index', array('list' => $list));
    }

    public function actionAdd()
    {
        $model = new Odbiorcy();
        $id = \Yii::$app->request->get('id');
        if ($id) {
            $model = Odbiorcy::findOne($id);
        }
        if (\Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $ret = $model->load($post, 'Odbiorcy');
            if ($ret && $model->validate()) {
                $model->save();
                $this->redirect('?r=odbiorcy%2Findex');
            }
        }
        return $this->render('add', array('model' => $model));
    }

    public function actionDel(){
        $id = \Yii::$app->request->get('id');
        if($id){
            $model = Odbiorcy::findOne($id);
            $model->delete();
            $this->redirect('?r=odbiorcy%2Findex');
        }
    }

    public function actionProducts(){
        $id = \Yii::$app->request->get('id');
        $list = Produkty::find()->all();
        $model = new OP();
        $listFilled = $model->find()->where('odbiorca_id='.$id)->all();
        if (\Yii::$app->request->isPost) {
            foreach($listFilled as $lf){
                $lf->delete();
            }
            $post = Yii::$app->request->post();
            foreach($post['produkt_id'] as $produkt_id){
                $op = new OP();
                $op->odbiorca_id = $id;
                $op->produkt_id = $produkt_id;
                $op->save();
            }
            $this->redirect('?r=odbiorcy%2Findex');
        }
        $ids = array();
        foreach($listFilled as $lf){
            $ids[] = $lf->produkt_id;
        }
        return $this->render('products', array('model' => $model, 'list' => $list, 'ids' => $ids));
    }
} 