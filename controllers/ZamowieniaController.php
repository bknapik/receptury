<?php
/**
 * Created by PhpStorm.
 * User: kinga
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use app\models\ZamowieniaProdukty;
use Yii;
use app\models\Zamowienia;
use app\models\OdbiorcyProdukty;
use app\models\Produkty;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Class ZamowieniaController
 * @package app\controllers
 */
class ZamowieniaController extends Controller
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
     * Displays list of allergens
     * @return string html code
     */
    public function actionIndex()
    {
        $model = new Zamowienia();
        $client_id = \Yii::$app->request->get('id');
        $list = $model->find()->all();
        return $this->render('index', array('list' => $list, 'client_id' => $client_id));
    }

    /**
     * Displays form for allergen and saves it
     * @return string html code
     */
    public function actionAdd()
    {
        $model = new Zamowienia();
        $order_id = \Yii::$app->request->get('id');
        $client_id = \Yii::$app->request->get('client_id');
        $modelOP = new OdbiorcyProdukty();
        $listFilled = $modelOP->find()->where('odbiorca_id=' . $client_id)->all();
        $modelZP = new ZamowieniaProdukty();
        $customerProducts = array();
        foreach ($listFilled as $item) {
            $customerProducts[] = Produkty::findOne($item->produkt_id);
        }
        if ($order_id) {
            $model = Zamowienia::findOne($order_id);
        } else {
            $model->klient_id = $client_id;
        }
        if (\Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $return = $model->load($post, 'Zamowienia');
            if ($return && $model->validate()) {
                $model->save();
                $this->redirect('?r=zamowienia/index&client_id='.$client_id);
            }
        }
        return $this->render('add', array('model' => $model, 'customerProducts' => $customerProducts, 'modelZP' => $modelZP));
    }

    /**
     * Removes allergen with given id from database
     */
    public function actionDel(){
        $order_id = \Yii::$app->request->get('id');
        if($order_id){
            $model = Zamowienia::findOne($order_id);
            $model->delete();
            $this->redirect('?r=zamoweienia/index');
        }
    }
} 