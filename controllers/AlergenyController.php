<?php
/**
 * Created by PhpStorm.
 * User: kinga
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use app\models\Alergeny;
use Yii;
use yii\web\Controller;

/**
 * Class FunkcjeController
 * @package app\controllers
 */
class AlergenyController extends Controller
{

    /**
     * Displays list of functions
     * @return string html code
     */
    public function actionIndex()
    {
        $model = new Alergeny();
        $list = $model->find()->all();
        return $this->render('index', array('list' => $list));
    }

    /**
     * Displays form for function and saves it
     * @return string html code
     */
    public function actionAdd()
    {
        $model = new Alergeny();
        $function_id = \Yii::$app->request->get('id');
        if ($function_id) {
            $model = Alergeny::findOne($function_id);
        }
        if (\Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $return = $model->load($post, 'Alergeny');
            if ($return && $model->validate()) {
                $model->save();
                $this->redirect('?r=alergeny/index');
            }
        }
        return $this->render('add', array('model' => $model));
    }

    /**
     * Removes function with given id from database
     */
    public function actionDel(){
        $function_id = \Yii::$app->request->get('id');
        if($function_id){
            $model = Alergeny::findOne($function_id);
            $model->delete();
            $this->redirect('?r=alergeny/index');
        }
    }
} 