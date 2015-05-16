<?php
/* @var $this yii\web\View
 * @var $list
 */
$this->title = 'Produkty';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Produkty</h1>
            <a class="btn btn-primary pull-right add-button" onclick="document.getElementById('choose').submit()">
                <i class="glyphicon glyphicon-print"></i> Drukuj receptury wybranych
            </a>

            <form method="POST" action="index.php?r=produkty/print-recipes-pdf" id="choose">
                <table class="table table-hover table-striped my-data-table">
                    <thead>
                    <tr>
                        <th>
                            Ile
                        </th>
                        <th>
                            Id
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
                            Sztuk z presy
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php /** @var $produkt \app\models\Produkty */
                    foreach ($list as $produkt): ?>
                        <tr>
                            <td>
                                <label>
                                    <input type="text" name="number[<?= $produkt->id ?>]" />
                                </label>
                            </td>
                            <td>
                                <?= $produkt->id ?>
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
