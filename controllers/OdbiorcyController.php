<?php
/**
 * Created by PhpStorm.
 * User: kinga
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use app\models\Odbiorcy;
use app\models\OdbiorcyProdukty;
use app\models\Produkty;
use Yii;
use yii\web\Controller;

/**
 * Class OdbiorcyController
 * @package app\controllers
 */
class OdbiorcyController extends Controller
{

    /**
     * Displays list of customers
     * @return string html code
     */
    public function actionIndex()
    {
        $model = new Odbiorcy();
        $list = $model->find()->all();
        return $this->render('index', array('list' => $list));
    }

    /**
     * Displays form for customer and saves it
     * @return string html code
     */
    public function actionAdd()
    {
        $model = new Odbiorcy();
        $customer_id = \Yii::$app->request->get('id');
        if ($customer_id) {
            $model = Odbiorcy::findOne($customer_id);
        }
        if (\Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $return = $model->load($post, 'Odbiorcy');
            if ($return && $model->validate()) {
                $model->save();
                $this->redirect('?r=odbiorcy/index');
            }
        }
        return $this->render('add', array('model' => $model));
    }

    /**
     * Deletes customer with given id from database
     */
    public function actionDel(){
        $customer_id = \Yii::$app->request->get('id');
        if($customer_id){
            $model = Odbiorcy::findOne($customer_id);
            $model->delete();
            $this->redirect('?r=odbiorcy/index');
        }
    }

    /**
     * Displays form for customers products and saves it
     * @return string html code
     */
    public function actionProducts(){
        $customer_id = \Yii::$app->request->get('id');
        $list = Produkty::find()->all();
        $model = new OdbiorcyProdukty();
        $listFilled = $model->find()->where('odbiorca_id='.$customer_id)->all();
        if (\Yii::$app->request->isPost) {
            foreach($listFilled as $item){
                $item->delete();
            }
            $post = Yii::$app->request->post();
            foreach($post['produkt_id'] as $produkt_id){
                $op = new OdbiorcyProdukty();
                $op->odbiorca_id = $customer_id;
                $op->produkt_id = $produkt_id;
                $op->save();
            }
            $this->redirect('?r=odbiorcy/index');
        }
        $customerProductsIds = array();
        foreach($listFilled as $item){
            $customerProductsIds[] = $item->produkt_id;
        }
        return $this->render('products', array('model' => $model, 'list' => $list, 'ids' => $customerProductsIds));
    }
} 