<?php
/**
 * Created by PhpStorm.
 * User: knapi_000
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use app\models\Produkty;
use app\models\Receptury;
use app\models\Stawki;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class ProduktyController extends Controller
{

    public function actionIndex()
    {
        $model = new Produkty();
        $list = $model->find()->all();
        return $this->render('index', array('list' => $list));
    }

    public function actionAdd()
    {
        $model = new Produkty();
        $id = \Yii::$app->request->get('id');
        if ($id) {
            $model = Produkty::findOne($id);
        } else {
            $max = Produkty::find()->having('sortowanie = max(sortowanie)')->all();
            if (empty($max)) {
                $model->sortowanie = 1;
            } else {
                $model->sortowanie = $max[0]->sortowanie + 1;
            }
            $model->cena_det_netto = 0;
            $model->cena_det_brutto = 0;
            $model->cena_hurt_netto = 0;
            $model->cena_hurt_brutto = 0;
        }
        if (\Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $grafika = $model->grafika;
            $ret = $model->load($post, 'Produkty');
            $model->grafika = $grafika;
            if ($ret && $model->validate()) {
                if (UploadedFile::getInstance($model, 'grafika') != null) {
                    if ($model->grafika != null && $model->grafika != '') {
                        unlink('uploads/' . $model->grafika);
                    }
                    $model->grafika = UploadedFile::getInstance($model, 'grafika');
                    $model->grafika->saveAs('uploads/' . $model->grafika->baseName . '.' . $model->grafika->extension);
                } else if ($model->file_rem == '1') {
                    unlink('uploads/' . $model->grafika);
                    $model->grafika = null;
                }
                $model->save();
                $this->redirect('?r=produkty%2Findex');
                // all inputs are valid
            } else {
                // validation failed: $errors is an array containing error messages
                $errors = $model->errors;
            }
        }
        $recipes = Receptury::find()->where('(data_od IS NULL OR data_od <= NOW()) && (data_do IS NULL OR data_do >= NOW())')->all();
        $recipes_arr = array();
        foreach ($recipes as $recipe) {
            $recipes_arr[$recipe->id] = $recipe->nazwa;
        }
        $vat = Stawki::find()->all();
        $vat_arr = array();
        foreach ($vat as $v) {
            $vat_arr[$v->id] = $v->nazwa;
        }
        return $this->render('add', array('model' => $model, 'recipes' => $recipes_arr, 'vat' => $vat_arr));
    }

    public function actionDel()
    {
        $id = \Yii::$app->request->get('id');
        if ($id) {
            $model = Produkty::findOne($id);
            $model->delete();
            $this->redirect('?r=produkty%2Findex');
        }
    }
} 