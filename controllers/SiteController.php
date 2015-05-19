<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Konfiguracja;
use yii\filters\AccessControl;

/**
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends Controller
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
     * Displays list of configuration elements
     * @return string html code
     */
    public function actionIndex()
    {
        if(\Yii::$app->user->getIsSuperAdmin()){
            $list = Konfiguracja::find()->all();
        } else {
            $list = Konfiguracja::find()->where('klucz NOT IN ("logo","adres","nazwa")')->all();
        }
        return $this->render('index', array('list' => $list));
    }

    /**
     * Displays form for configuration an saves it
     * @return string html code
     */
    public function actionEdit(){
        $config_id = \Yii::$app->request->get('id');
        if($config_id){

            /** @var $model Konfiguracja */
            $model = Konfiguracja::findOne($config_id);
            if (\Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $wartosc = $model->wartosc;
                $ret = $model->load($post, 'Konfiguracja');
                if($model->klucz == 'logo'){
                    $model->wartosc = $wartosc;
                }
                if ($ret && $model->validate()) {
                    $model->handlePictureUpload();
                    $model->save();
                    $this->redirect('?r=site/index');
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
