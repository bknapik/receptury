<?php
/**
 * Created by PhpStorm.
 * User: kinga
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use app\models\FunkcjaTechnologiczna;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Class FunkcjeController
 * @package app\controllers
 */
class FunkcjeController extends Controller
{

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function () {
                                return !\Yii::$app->user->getIsGuest();
                            },
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays list of functions
     * @return string html code
     */
    public function actionIndex()
    {
        $model = new FunkcjaTechnologiczna();
        $list = $model->find()->all();
        return $this->render('index', array('list' => $list));
    }

    /**
     * Displays form for function and saves it
     * @return string html code
     */
    public function actionAdd()
    {
        $model = new FunkcjaTechnologiczna();
        $function_id = \Yii::$app->request->get('id');
        if ($function_id) {
            $model = FunkcjaTechnologiczna::findOne($function_id);
        }
        if (\Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $return = $model->load($post, 'FunkcjaTechnologiczna');
            if ($return && $model->validate()) {
                $model->save();
                $this->redirect('?r=funkcje/index');
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
            $model = FunkcjaTechnologiczna::findOne($function_id);
            $model->delete();
            $this->redirect('?r=funkcje/index');
        }
    }
} 