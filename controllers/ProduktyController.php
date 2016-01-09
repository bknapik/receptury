<?php
/**
 * Created by PhpStorm.
 * User: kinga
 * Date: 15.02.15
 * Time: 12:16
 */

namespace app\controllers;

use app\models\Konfiguracja;
use app\models\Produkty;
use app\models\Receptury;
use app\models\StawkiVat;
use app\models\OdbiorcyProdukty;
use app\models\Alergeny;
use app\models\RecepturyAlergeny;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Class ProduktyController
 * @package app\controllers
 */
class ProduktyController extends Controller
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
     * @var bool overrides Controller class field
     * whether to enable CSRF validation for the actions in this controller.
     * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
     */
    public $enableCsrfValidation = false;

    /**
     * Displays list of products
     * @return string rendered page for products index
     */
    public function actionIndex()
    {
        $model = new Produkty();
        $list = $model->find()->orderBy('sortowanie ASC')->all();
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
            $post['Produkty']['masa_netto'] = str_replace(',', '.', $post['Produkty']['masa_netto']);
            $post['Produkty']['cena_det_netto'] = str_replace(',', '.', $post['Produkty']['cena_det_netto']);
            $post['Produkty']['cena_det_brutto'] = str_replace(',', '.', $post['Produkty']['cena_det_brutto']);
            $post['Produkty']['cena_hurt_netto'] = str_replace(',', '.', $post['Produkty']['cena_hurt_netto']);
            $post['Produkty']['cena_hurt_brutto'] = str_replace(',', '.', $post['Produkty']['cena_hurt_brutto']);
            $post['Produkty']['nawazka'] = str_replace(',', '.', $post['Produkty']['nawazka']);
            $post['Produkty']['presa'] = str_replace(',', '.', $post['Produkty']['presa']);
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
        $recipes_arr = $recipeModel->getAssocArr('(data_od IS NULL OR data_od="0000-00-00" OR data_od <= NOW())
                                                    && (data_do IS NULL OR data_do="0000-00-00" OR data_do >= NOW())');
        $rateModel = new StawkiVat();
        $vat_arr = $rateModel->getAssocArr();
        return $this->render('add', array(
            'model' => $model,
            'recipes' => $recipes_arr,
            'vat' => $vat_arr
        ));
    }

    /**
     * Displays form for product, and saves it
     * @return string rendered page with product form
     */
    public function actionAddSimilar()
    {
        $model = new Produkty();
        $product_id = \Yii::$app->request->get('id');
        if ($product_id) {
            $model_old = Produkty::findOne($product_id);
            foreach ($model_old->oldAttributes as $key => $value) {
                if ($key != 'id') {
                    $model->$key = $value;
                }
            }
        } else {
            $model->setDefault();
        }
        if (\Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();
            $post['Produkty']['masa_netto'] = str_replace(',', '.', $post['Produkty']['masa_netto']);
            $post['Produkty']['cena_det_netto'] = str_replace(',', '.', $post['Produkty']['cena_det_netto']);
            $post['Produkty']['cena_det_brutto'] = str_replace(',', '.', $post['Produkty']['cena_det_brutto']);
            $post['Produkty']['cena_hurt_netto'] = str_replace(',', '.', $post['Produkty']['cena_hurt_netto']);
            $post['Produkty']['cena_hurt_brutto'] = str_replace(',', '.', $post['Produkty']['cena_hurt_brutto']);
            $post['Produkty']['nawazka'] = str_replace(',', '.', $post['Produkty']['nawazka']);
            $post['Produkty']['presa'] = str_replace(',', '.', $post['Produkty']['presa']);
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
        $recipes_arr = $recipeModel->getAssocArr('(data_od IS NULL OR data_od="0000-00-00" OR data_od <= NOW())
                                                    && (data_do IS NULL OR data_do="0000-00-00" OR data_do >= NOW())');
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
            /**
             * @var $model Produkty
             */
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

        $list = Produkty::find()->orderBy('sortowanie ASC')->all();
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

        $list = Produkty::find()->orderBy('sortowanie ASC')->all();
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
     * @param string $which
     */
    public function actionSkladPdf($which = '')
    {
        /** @noinspection PhpIncludeInspection */
        require_once("../vendor/dompdf/dompdf_config.inc.php");

        if (empty($which)) {
            $list = Produkty::find()->orderBy('sortowanie ASC')->all();
        } else {
            $list = Produkty::find()->where('id IN (' . $which . ')')->orderBy('sortowanie ASC')->all();
        }
        $allergensArray = array();
        foreach ($list as $item) {
            $allergensForModel = RecepturyAlergeny::find()->where('receptura_id=' . $item->receptura_id)->all();
            foreach ($allergensForModel as $afm) {
                $allergensArray[] = $afm->alergen_id;
            }
        }
        if (!empty($allergensArray)) {
            $allergens = Alergeny::find()->where('id IN (' . implode(',', $allergensArray) . ')')->all();
        } else {
            $allergens = array();
        }

        $html = $this->renderPartial('ingredientsPdf', array(
            'list' => $list,
            'allergens' => $allergens,
        ));
        $dompdf = new \DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("sklad.pdf");
    }

    /**
     * Choose whether print all products or subset of products
     */
    public function actionSkladPdfWhich()
    {
        if (\Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if (isset($post['product_id'])) {
                $this->actionSkladPdf(implode(',', $post['product_id']));
            } else {
                $this->actionSkladPdf();
            }
        }
    }

    /**
     * Selects products assigned to customer and call actionSkladPdf with selected subset
     */
    public function actionSkladPdfCustomer()
    {
        $customer_id = \Yii::$app->request->get('id');
        $model = new OdbiorcyProdukty();
        $listFilled = $model->find()->where('odbiorca_id=' . $customer_id)->all();
        $ids = [];
        foreach ($listFilled as $item) {
            $ids[] = $item->produkt_id;
        }
        if (!empty($ids)) {
            $this->actionSkladPdf(implode(',', $ids));
        } else {
            $this->actionSkladPdf();
        }
    }

    /**
     * Prints cards for given product
     */
    public function actionPrintCards()
    {
        /** @noinspection PhpIncludeInspection */
        require_once("../vendor/dompdf/dompdf_config.inc.php");
        $productId = \Yii::$app->request->get('id');
        $model = Produkty::findOne($productId);

        $html = $this->renderPartial('cards', array(
            'model' => $model,
        ));
        //echo $html;die;

        $dompdf = new \DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("kartki_" . $model->nazwa . ".pdf");

    }

    /**
     * Shows list of products with possibility to choose which recipes for products print,
     * and how much of each product should be calculated for its recipe
     * @return string html code
     */
    public function actionPrintRecipes()
    {
        $model = new Produkty();
        $list = $model->find()->orderBy('sortowanie ASC')->all();
        return $this->render('printRecipes', array('list' => $list));
    }

    /**
     * Prints recipes for given products with report
     */
    public function actionPrintRecipesPdf()
    {
        if (\Yii::$app->request->isPost) {
            require('../vendor/fpdf/tfpdf.php');
            require('../vendor/fpdf/pdf.php');
            $pdf = new \PDF();
            $pdf->AliasNbPages();
            $pdf->logo = "uploads/" . Konfiguracja::trans('logo');
            $pdf->name = Konfiguracja::trans('nazwa');
            $pdf->adres = date('d.m.y');
            $pdf->AddPage();
            $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
            $pdf->AddFont('DejaVu','B','DejaVuSansCondensed-Bold.ttf',true);
            $pdf->SetFont('DejaVu','',12);
            $post = Yii::$app->request->post();
            $reportArray = array();
            $header = array('nazwa', 'ilość', 'jednostka');
            foreach ($post['number'] as $key => $product_number) {
                $product_number = str_replace(',','.',$product_number);
                if ($product_number != '') {
                    $model = Produkty::findOne($key);
                    $recipeModel = $model->recipe;
                    $model->ile_sztuk = ($model->ile_sztuk > 0) ? $model->ile_sztuk : 1;
                    $multiplier = $product_number / $model->ile_sztuk;
                    $recipe = array();
                    $recipe['nazwa'] = $model->nazwa;
                    $recipe['nawazka'] = $model->nawazka;
                    $recipe['ile_sztuk'] = $product_number;
                    $recipe['presa'] = $model->presa * $multiplier;
                    $recipe['suma_skladnikow'] = $recipeModel->woda * $multiplier;
                    $recipe['woda'] = $recipeModel->woda * $multiplier;
                    $recipe['uwagi'] = $recipeModel->uwagi;
                    $recipe['masa_netto'] = $model->masa_netto;
                    $ingredients = $recipeModel->recipeIngredients;
                    foreach ($ingredients as $ingredient) {
                        $recipeElements = array();
                        $recipeElements['nazwa'] = $ingredient->ingredient->nazwa_skladnika;
                        $recipeElements['ilosc'] = $ingredient->ilosc * $multiplier;
                        $recipeElements['jednostka'] = $ingredient->jednostka;
                        if (!isset($reportArray[$ingredient->skladnik_id])) {
                            $reportArray[$ingredient->skladnik_id] = ['suma' => 0,
                                'nazwa' => $ingredient->ingredient->nazwa_skladnika,
                                'jednostka' => $recipeElements['jednostka']
                            ];
                        }
                        $reportArray[$ingredient->skladnik_id]['suma'] += $ingredient->ilosc * $multiplier;
                        $recipe['suma_skladnikow'] += $ingredient->ilosc_przeliczona * $multiplier;
                        $recipe['skladniki'][] = $recipeElements;
                    }
                    $data = array();
                    foreach ($recipe['skladniki'] as $ingredient) {
                        $data[] = array(
                            $ingredient['nazwa'],
                            number_format($ingredient['ilosc'], 4, ',', ' '),
                            $ingredient['jednostka']);
                    }
                    $nb=0;
                    for($i=0;$i<count($data);$i++)
                        $nb++;
                    $h=($nb + 6)*5;
                    //Issue a page break first if needed
                    $pdf->CheckPageBreak($h);
                    $pdf->SetFont('DejaVu','B',12);
                    $pdf->Write(10,'Nazwa '.Konfiguracja::trans('produktu').': '.$recipe['nazwa']);
                    $pdf->Ln(7);
                    $pdf->Write(10,'naważka [kg] / presa [kg]: ');
                    $pdf->SetFont('DejaVu','',12);
                    $pdf->Write(10,number_format($recipe['nawazka'], 4, ',', ' ').'/'.number_format($recipe['presa'], 4, ',', ' '));
                    $pdf->SetFont('DejaVu','B',12);
                    $pdf->Ln(7);
                    $pdf->Write(10,'masa netto [kg]: ');
                    $pdf->SetFont('DejaVu','',12);
                    $pdf->Write(10, number_format($recipe['masa_netto'], 4, ',', ' ').'                       ');
                    $pdf->SetFont('DejaVu','B',12);
                    $pdf->Write(10,'ile sztuk: ');
                    $pdf->SetFont('DejaVu','',12);
                    $pdf->Write(10,number_format($recipe['ile_sztuk'], 2, ',', ' '));
                    $pdf->Ln(7);
                    $pdf->SetFont('DejaVu','B',12);
                    $pdf->Write(10,'suma '.Konfiguracja::trans('skladnikow').' w tym woda [kg]: ');
                    $pdf->SetFont('DejaVu','',12);
                    $pdf->Write(10, number_format($recipe['suma_skladnikow'], 4, ',', ' '));
                    $pdf->Ln(10);
                    $pdf->Table($header, $data);
                    $pdf->Ln(10);
                }
            }
            $pdf->AddPage();
            $tableTitle = 'Suma '.Konfiguracja::trans('skladnikow') .' potrzebna do wyprodukowania powyższych '. Konfiguracja::trans('produktow');
            $pdf->SetFont('DejaVu','B',16);
            $pdf->Write(10,$tableTitle);
            $pdf->Ln(15);
            $pdf->SetFont('DejaVu','',12);
            $data = array();
            foreach ($reportArray as $ingredient) {
                $data[] = array($ingredient['nazwa'],
                number_format($ingredient['suma'], 4, ',', ' '),
                $ingredient['jednostka']);
            }
            $pdf->Table($header, $data);
            $pdf->Ln(15);
            $pdf->Output("receptury".date('d-m-y').".pdf",'D');
        }
    }

    /**
     * Makes head and header with configuration elements
     * @return string html code with head and header
     */
    private function makeHeader()
    {
        return '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                    <link href="css/print.css" rel="stylesheet">
                    </head><body>
                    <div class="header">
                        ' . Konfiguracja::trans('nazwa') . '<br/>
                        ' . Konfiguracja::trans('adres') . '
                        <img class="logo" src="uploads/' . Konfiguracja::trans('logo') . '" />
                    </div>';
    }

    /**
     * Makes table header from array of names
     * @param $ths array with names of table headers
     * @return string html code
     */
    private function makeTableHeader($ths)
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
    private function makeSimpleFooter()
    {
        return '<div class="footer">' . date('Y-m-d') . '</div></tbody>
                </table></body></html>';
    }
}