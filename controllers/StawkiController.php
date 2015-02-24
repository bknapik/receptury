<?php
/**
 * Created by PhpStorm.
 * User: kinga
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use app\models\Stawki;
use Yii;
use yii\web\Controller;

/**
 * Class StawkiController
 * @package app\controllers
 */
class StawkiController extends Controller
{

    /**
     * Displays list of tax rates
     * @return string html code
     */
    public function actionIndex()
    {
        $model = new Stawki();
        $list = $model->find()->all();
        return $this->render('index', array('list' => $list));
    }

    /**
     * Displays form for tax rate and saves it
     * @return string html code
     */
    public function actionAdd()
    {
        $model = new Stawki();
        $rate_id = \Yii::$app->request->get('id');
        if ($rate_id) {
            $model = Stawki::findOne($rate_id);
        }
        if (\Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $ret = $model->load($post, 'Stawki');
            if ($ret && $model->validate()) {
                $model->save();
                $this->redirect('?r=stawki/index');
            }
        }
        return $this->render('add', array('model' => $model));
    }

    /**
     * Removes tax rate with given id from database
     */
    public function actionDel(){
        $rate_id = \Yii::$app->request->get('id');
        if($rate_id){
            $model = Stawki::findOne($rate_id);
            $model->delete();
            $this->redirect('?r=stawki/index');
        }
    }
} 