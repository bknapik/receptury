<?php
/**
 * Created by PhpStorm.
 * User: kinga
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use app\models\StawkiVat;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Class StawkiController
 * @package app\controllers
 */
class StawkiController extends Controller
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
     * Displays list of tax rates
     * @return string html code
     */
    public function actionIndex()
    {
        $model = new StawkiVat();
        $list = $model->find()->all();
        return $this->render('index', array('list' => $list));
    }

    /**
     * Displays form for tax rate and saves it
     * @return string html code
     */
    public function actionAdd()
    {
        $model = new StawkiVat();
        $rate_id = \Yii::$app->request->get('id');
        if ($rate_id) {
            $model = StawkiVat::findOne($rate_id);
        }
        if (\Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $ret = $model->load($post, 'StawkiVat');
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
            $model = StawkiVat::findOne($rate_id);
            $model->delete();
            $this->redirect('?r=stawki/index');
        }
    }
} 