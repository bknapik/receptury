<?php
/**
 * Created by PhpStorm.
 * User: knapi_000
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use app\models\Funkcja;
use app\models\Konfiguracja;
use app\models\Produkty;
use app\models\Receptury;
use app\models\RS;
use app\models\Skladniki;
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

    public function actionCenyPdf()
    {
        require_once("../vendor/dompdf/dompdf_config.inc.php");

        $model = new Produkty();
        $config_list = Konfiguracja::find()->all();
        $list = $model->find()->all();
        $html = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                    <link href="css/print.css" rel="stylesheet">
                    </head><body>
                    <div class="header">
                        ' . $config_list[2]->wartosc . '<br/>
                        ' . $config_list[0]->wartosc . '
                        <img class="logo" src="uploads/' . $config_list[1]->wartosc . '" />
                    </div>
                    <table>
                    <thead>
                    <tr>
                        <th>ASORTYMENT</th>
                        <th>Masa (kg)</th>
                        <th>DETAL (zł)</th>
                        <th>HURT NETTO (zł)</th>
                        <th>HURT BRUTTO (zł) </th>
                    </tr>
                    </thead>
                    <tbody>';
        foreach ($list as $produkt):
            $html .= '<tr>
                        <td>'
                . $produkt->nazwa . '
                        </td>
                        <td class="center">
                            ' . number_format($produkt->masa_netto, 2, ',', ' ') . '
                        </td>
                        <td class="right">
                            ' . (($produkt->cena_det_brutto > 0) ? number_format($produkt->cena_det_brutto, 2, ',', ' ') : '') . '
                        </td>
                        <td class="right">
                            ' . (($produkt->cena_hurt_netto > 0) ? number_format($produkt->cena_hurt_netto, 2, ',', ' ') : '') . '
                        </td>
                        <td class="right">
                            ' . (($produkt->cena_hurt_brutto > 0) ? number_format($produkt->cena_hurt_brutto, 2, ',', ' ') : '') . '
                        </td>
                    </tr>';
        endforeach;
        $html .= '<div class="footer">' . date('Y-m-d') . '</div></tbody>
                </table></body></html>';
//        echo $html;die;
        $dompdf = new \DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("cena_hurt_det.pdf");
    }

    public function actionCenyKgPdf()
    {
        require_once("../vendor/dompdf/dompdf_config.inc.php");

        $model = new Produkty();
        $config_list = Konfiguracja::find()->all();
        $list = $model->find()->all();
        $html = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                    <link href="css/print.css" rel="stylesheet">
                    </head><body>
                    <div class="header">
                        ' . $config_list[2]->wartosc . '<br/>
                        ' . $config_list[0]->wartosc . '
                        <img class="logo" src="uploads/' . $config_list[1]->wartosc . '" />
                    </div>
                    <table>
                    <thead>
                    <tr>
                        <th>ASORTYMENT</th>
                        <th>Masa (kg)</th>
                        <th>Cena (zł)</th>
                        <th>Cen za 1 kg</th>
                    </tr>
                    </thead>
                    <tbody>';
        foreach ($list as $produkt):
            $html .= '<tr>
                        <td>'
                . $produkt->nazwa . '
                        </td>
                        <td class="center">
                            ' . number_format($produkt->masa_netto, 2, ',', ' ') . '
                        </td>
                        <td class="right">
                            ' . (($produkt->cena_det_brutto > 0) ? number_format($produkt->cena_det_brutto, 2, ',', ' ') : '') . '
                        </td>
                        <td class="right">
                            ' . (($produkt->cena_det_brutto > 0) ? number_format($produkt->cena_det_brutto / $produkt->masa_netto, 2, ',', ' ') : '') . '
                        </td>
                    </tr>';
        endforeach;
        $html .= '<div class="footer">' . date('Y-m-d') . '</div></tbody>
                </table></body></html>';
//        echo $html;die;
        $dompdf = new \DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("cena_za_kg.pdf");
    }

    public function actionSkladPdf()
    {
        require_once("../vendor/dompdf/dompdf_config.inc.php");
        $model = new Produkty();
        $config_list = Konfiguracja::find()->all();
        $list = $model->find()->all();
        $html = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                    <link href="css/print.css" rel="stylesheet">
                    </head><body>
                    <div class="header">
                        ' . $config_list[2]->wartosc . '<br/>
                        ' . $config_list[0]->wartosc . '
                        <img class="logo" src="uploads/' . $config_list[1]->wartosc . '" />
                    </div>';
        foreach ($list as $produkt):
            $recipe = Receptury::findOne($produkt->receptura_id);
            $rs = RS::find()->where('receptura_id=' . $produkt->receptura_id)->orderBy('ilosc DESC')->all();
            $html .= '<div class="page_break">';
            $html .= '<div class="recipe_header"><p><span>Nazwa produktu</span> ' . $produkt->nazwa . '</p></div>';
            $html .= '<div class="recipe_weight"><p><span>masa netto [kg]</span> ' . number_format($produkt->masa_netto, 2, ',', ' ') . '</p></div>';
            $html .= '<div class="recipe_ingredient"><p class="ingredient_header">skład</p></div>';
            foreach ($rs as $rs_) {
                $ingredient = Skladniki::findOne($rs_->skladnik_id);
                $ingredients = Skladniki::find()->where('rodzic_id=' . $ingredient->id)->all();
                $quantity = ($recipe->masa_koncowa / $rs_->ilosc) * 100;
                if ($ingredient->funkcja_technologiczna_id != null) {
                    $function = Funkcja::findOne($ingredient->funkcja_technologiczna_id);
                    $function = '<span class="ingredient_function">'.$function->nazwa.': </span><br />';
                } else {
                    $function = '';
                }
                $html .= '<div class="recipe_ingredient"><p>'.$function.'<span class="ingredient_name">' . $ingredient->nazwa_do_skladu . '</span>' . (($ingredient->alergen != '') ? ' <span class="ingredient_alergen">' . $ingredient->alergen . '</span>' : '');
                if (!empty($ingredients) && $quantity >= 2) {
                    $html .= ' (';
                    foreach ($ingredients as $i) {
                        $html .= '<span class="ingredient_name">' . $i->nazwa_do_skladu . '</span>' . (($i->alergen) ? ' <span>' . $i->alergen . '</span>, ' : ', ');
                    }
                    $html = substr($html, 0, -2);
                    $html .= ')';
                }
                $html .= '</p></div>';
//                var_dump($ingredient);
//                var_dump($rs_);
            }
            $html .= '</div>';

        endforeach;
        $html .= '<div class="footer bigger"><p>Produkty mogą dodatkowo zawierać <strong>sezam, soję, orzechy,seler, gorczycę, jaja, mleko, łubin i produkty pochodne</strong></p></div></tbody>
                </table></body></html>';
//        echo $html;
//        die;
        $dompdf = new \DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("sklad.pdf");
    }
} 