<?php
/* @var $this yii\web\View
 * @var $list
 */
$this->title = 'Produkty';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1><?= \app\models\Konfiguracja::trans('produkty') ?></h1>
            <a href="index.php?r=produkty/add" class="btn btn-primary pull-right add-button">
                <i class="glyphicon glyphicon-plus"></i> Dodaj nowy <?= \app\models\Konfiguracja::trans('produkt') ?>
            </a>
            <a href="index.php?r=produkty/ceny-pdf" class="btn btn-primary pull-right add-button">
                <i class="glyphicon glyphicon-print"></i> Drukuj ceny hurt detal
            </a>
            <a href="index.php?r=produkty/ceny-kg-pdf" class="btn btn-primary pull-right add-button">
                <i class="glyphicon glyphicon-print"></i> Drukuj ceny za kilogram
            </a>
            <a href="index.php?r=produkty/sklad-pdf" class="btn btn-primary pull-right add-button">
                <i class="glyphicon glyphicon-print"></i> Drukuj skład
            </a>
            <a class="btn btn-primary pull-right add-button" onclick="document.getElementById('choose').submit()">
                <i class="glyphicon glyphicon-print"></i> Drukuj skład wybranych
            </a>
            <a href="index.php?r=produkty/print-recipes" class="btn btn-primary pull-right add-button">
                <i class="glyphicon glyphicon-print"></i> Drukuj receptury
            </a>

            <form method="POST" action="index.php?r=produkty/sklad-pdf-which" id="choose">
                <table class="table table-hover table-striped my-data-table">
                    <thead>
                    <tr>
                        <th>
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
                            Opcje
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php /** @var $produkt \app\models\Produkty */
                    foreach ($list as $produkt): ?>
                        <tr>
                            <td>
                                <label>
                                    <input type="checkbox" name="product_id[]" value="<?= $produkt->id ?>"/>
                                </label>
                            </td>
                            <td>
                                <?= $produkt->sortowanie ?>
                            </td>
                            <td>
                                <?= $produkt->nazwa ?>
                            </td>
                            <td>
                                <?= $produkt->ile_sztuk ?>
                            </td>
                            <td>
                                <a href="?r=produkty/add&id=<?= $produkt->id ?>" class="btn btn-primary btn-xs">
                                    <i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;Edytuj
                                </a>
                                <a href="?r=produkty/add-similar&id=<?= $produkt->id ?>" class="btn btn-primary btn-xs">
                                    <i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Dodaj podobny
                                </a>
                                <a href="?r=produkty/print-cards&id=<?= $produkt->id ?>" class="btn btn-primary btn-xs">
                                    <i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;Drukuj kartki
                                </a>
                                <a href="?r=receptury/add&id=<?= $produkt->receptura_id ?>" class="btn btn-primary btn-xs">
                                    <i class="glyphicon glyphicon-arrow-right"></i>&nbsp;&nbsp;Przejdź do receptury
                                </a>
                                <a href="?r=produkty/del&id=<?= $produkt->id ?>" class="btn btn-primary remove-button btn-xs">
                                    <i class="glyphicon glyphicon-trash"></i>&nbsp;&nbsp;Usuń
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </form>
        </div>

    </div>
</div>
