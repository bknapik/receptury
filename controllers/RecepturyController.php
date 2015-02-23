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
                $model->saveIngredients($ingredientsForModel,$post);
                $this->redirect('?r=receptury%2Findex');
            }
        }
        $ingredients_arr = $model->getIngredientsArr();
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