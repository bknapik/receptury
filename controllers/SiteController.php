<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Konfiguracja;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $list = Konfiguracja::find()->all();
        return $this->render('index', array('list' => $list));
    }

    public function actionEdit(){
        $id = \Yii::$app->request->get('id');
        if($id){
            $model = Konfiguracja::findOne($id);
            if (\Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $wartosc = $model->wartosc;
                $ret = $model->load($post, 'Konfiguracja');
                $model->wartosc = $wartosc;
                if ($ret && $model->validate()) {
                    $model->managePicture();
                    $model->save();
                    $this->redirect('?r=site%2Findex');
                }
            }
            $type = ($model->klucz == 'logo') ? 'file' : 'text';
            return $this->render('edit', array('model' => $model, 'type' => $type));
        } else {
            $this->redirect('index.php');
        }
        return '';
    }
}
