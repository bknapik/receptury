<?php
/* @var $this yii\web\View
 * @var $list
 */
$this->title = \app\models\Konfiguracja::trans('produkty');
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1><?= \app\models\Konfiguracja::trans('produkty') ?></h1>
            <a class="btn btn-primary pull-right add-button" onclick="document.getElementById('choose').submit()">
                <i class="glyphicon glyphicon-print"></i> Drukuj receptury wybranych
            </a>
            <a class="btn btn-primary pull-right add-button" id="set-default" data-check="true">
                <i class="glyphicon glyphicon-transfer"></i> Ustaw domyślne wartości dla wszystkich <?= \app\models\Konfiguracja::trans('produktow') ?>
            </a>

            <form method="POST" action="index.php?r=produkty/print-recipes-pdf" id="choose">
                <table class="table table-hover table-striped my-data-table">
                    <thead>
                    <tr>
                        <th>
                            Ile
                        </th>
                        <th>
                            Kolejność
                        </th>
                        <th>
                            Nazwa
                        </th>
                        <th>
                            Masa netto
                        </th>
                        <th>
                            Presa
                        </th>
                        <th>
                            Sztuk wg receptury
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php /** @var $produkt \app\models\Produkty */
                    foreach ($list as $produkt): ?>
                        <tr>
                            <td>
                                <label>
                                    <input type="text" name="number[<?= $produkt->id ?>]" data-value="<?= $produkt->ile_sztuk ?>" class="number-input"/>
                                </label>
                            </td>
                            <td>
                                <?= $produkt->sortowanie ?>
                            </td>
                            <td>
                                <?= $produkt->nazwa ?>
                            </td>
                            <td>
                                <?= $produkt->getFormatted('masa_netto') ?>
                            </td>
                            <td>
                                <?= $produkt->getFormatted('presa') ?>
                            </td>
                            <td>
                                <?= $produkt->ile_sztuk ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </form>
            <a class="btn btn-primary pull-right add-button" onclick="document.getElementById('choose').submit()">
                <i class="glyphicon glyphicon-print"></i> Drukuj receptury wybranych
            </a>
        </div>

    </div>
</div>
