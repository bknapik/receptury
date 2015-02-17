<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Konfiguracja;
use yii\web\UploadedFile;

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
                if ($ret && $model->validate()) {
                    if($model->klucz == 'logo'){
                        if (UploadedFile::getInstance($model, 'wartosc') != null) {
                            if ($model->wartosc != null && $model->wartosc != '') {
                                unlink('uploads/' . $model->wartosc);
                            }
                            $model->wartosc = UploadedFile::getInstance($model, 'grafika');
                            $model->wartosc->saveAs('uploads/' . $model->wartosc->baseName . '.' . $model->wartosc->extension);
                        } else {
                            $model->wartosc = $wartosc;
                        }
                    }
                    $model->save();
                    $this->redirect('?r=site%2Findex');
                    // all inputs are valid
                } else {
                    // validation failed: $errors is an array containing error messages
                    $errors = $model->errors;
                }
            }
            $type = ($model->klucz == 'logo') ? 'file' : 'text';
            return $this->render('edit', array('model' => $model, 'type' => $type));
        } else {
            $this->redirect('index.php');
        }
    }
}
