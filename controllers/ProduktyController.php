<?php
/**
 * Created by PhpStorm.
 * User: kinga
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use app\models\FunkcjaTechnologiczna;
use app\models\Konfiguracja;
use app\models\Produkty;
use app\models\Receptury;
use app\models\RecepturySkladniki;
use app\models\Skladniki;
use app\models\StawkiVat;
use Yii;
use yii\web\Controller;

/**
 * Class ProduktyController
 * @package app\controllers
 */
class ProduktyController extends Controller
{
    /**
     * Displays list of products
     * @return string rendered page for products index
     */
    public function actionIndex()
    {
        $model = new Produkty();
        $list = $model->find()->all();
        return $this->render('index', array('list' => $list));
    }

    /**
     * Displays form for product, and saves it
     * @return string rendered page with product form
     */
    public function actionAdd()
    {
        $model = new Produkty();
        $product_id = \Yii::$app->request->get('id');
        if ($product_id) {
            $model = Produkty::findOne($product_id);
        } else {
            $model->setDefault();
        }
        if (\Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();
            $grafika = $model->grafika;
            $ret = $model->load($post, 'Produkty');
            $model->grafika = $grafika;
            if ($ret && $model->validate()) {
                $model->handlePictureUpload();
                $model->save();
                $this->redirect('?r=produkty/index');
            }
        }
        $recipeModel = new Receptury();
        $recipes_arr = $recipeModel->getAssocArr('(data_od IS NULL OR data_od <= NOW())
                                                    && (data_do IS NULL OR data_do >= NOW())');
        $rateModel = new StawkiVat();
        $vat_arr = $rateModel->getAssocArr();
        return $this->render('add', array(
                                            'model' => $model,
                                            'recipes' => $recipes_arr,
                                            'vat' => $vat_arr
                                            ));
    }

    /**
     * Removes product with given id from database
     */
    public function actionDel()
    {
        $product_id = \Yii::$app->request->get('id');
        if ($product_id) {
            $model = Produkty::findOne($product_id);
            $model->delete();
            $this->redirect('?r=produkty/index');
        }
    }

    /**
     * Makes pdf with prices table
     */
    public function actionCenyPdf()
    {
        /** @noinspection PhpIncludeInspection */
        require_once("../vendor/dompdf/dompdf_config.inc.php");

        $list = Produkty::find()->all();
        $html = $this->makeHeader();
        $html .= $this->makeTableHeader(
                                        [
                                            'ASORTYMENT',
                                            'Masa (kg)',
                                            'DETAL (zł)',
                                            'HURT NETTO (zł)',
                                            'HURT BRUTTO (zł)'
                                        ]);
        /** @var $produkt Produkty */
        foreach ($list as $produkt) {
            $html .= '<tr>
                        <td>
                            ' . $produkt->nazwa . '
                        </td>
                        <td class="center">
                            ' . $produkt->getFormatted('masa_netto') . '
                        </td>
                        <td class="right">
                            ' . $produkt->getFormatted('cena_det_brutto') . '
                        </td>
                        <td class="right">
                            ' . $produkt->getFormatted('cena_hurt_netto') . '
                        </td>
                        <td class="right">
                            ' . $produkt->getFormatted('cena_hurt_brutto') . '
                        </td>
                    </tr>';
        }
        $html .= $this->makeSimpleFooter();
//        echo $html;die;
        $dompdf = new \DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("cena_hurt_det.pdf");
    }

    /**
     * Makes pdf with prices for kg
     */
    public function actionCenyKgPdf()
    {
        /** @noinspection PhpIncludeInspection */
        require_once("../vendor/dompdf/dompdf_config.inc.php");

        $list = Produkty::find()->all();
        $html = $this->makeHeader();
        $html .= $this->makeTableHeader(['ASORTYMENT', 'Masa (kg)', 'Cena (zł)', 'Cena za 1 kg']);
        /** @var $produkt Produkty */
        foreach ($list as $produkt) {
            $html .= '<tr>
                        <td>
                            ' . $produkt->nazwa . '
                        </td>
                        <td class="center">
                            ' . $produkt->getFormatted('masa_netto') . '
                        </td>
                        <td class="right">
                            ' . $produkt->getFormatted('cena_det_brutto') . '
                        </td>
                        <td class="right">
                            ' . $produkt->getPLNPerKg() . '
                        </td>
                    </tr>';
        }
        $html .= $this->makeSimpleFooter();
//        echo $html;die;
        $dompdf = new \DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("cena_za_kg.pdf");
    }

    /**
     * Makes pdf with recipes for products
     */
    public function actionSkladPdf()
    {
        /** @noinspection PhpIncludeInspection */
        require_once("../vendor/dompdf/dompdf_config.inc.php");

        $list = Produkty::find()->all();
        $config_list = Konfiguracja::find()->all();
        $html = $this->renderPartial('ingredientsPdf',array(
                                                        'config_list' => $config_list,
                                                        'list' => $list,
                                                    ));
        $dompdf = new \DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("sklad.pdf");
    }

    /**
     * Makes head and header with configuration elements
     * @return string html code with head and header
     */
    public function makeHeader()
    {
        $config_list = Konfiguracja::find()->all();
        return '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                    <link href="css/print.css" rel="stylesheet">
                    </head><body>
                    <div class="header">
                        ' . $config_list[2]->wartosc . '<br/>
                        ' . $config_list[0]->wartosc . '
                        <img class="logo" src="uploads/' . $config_list[1]->wartosc . '" />
                    </div>';
    }

    /**
     * Makes table header from array of names
     * @param $ths array with names of table headers
     * @return string html code
     */
    public function makeTableHeader($ths)
    {
        $html = '<table>
                    <thead>
                    <tr>';
        foreach ($ths as $th) {
            $html .= '<th>' . $th . '</th>';
        }
        $html .= '</tr>
                    </thead>
                    <tbody>';
        return $html;
    }

    /**
     * Makes footer
     * @return string html code
     */
    public function makeSimpleFooter()
    {
        return '<div class="footer">' . date('Y-m-d') . '</div></tbody>
                </table></body></html>';
    }
} 