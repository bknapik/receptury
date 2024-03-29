<?php
/* @var $this yii\web\View
 * @var $list
 */
$this->title = 'Odbiorcy';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Odbiorcy</h1>
            <a href="index.php?r=odbiorcy/add" class="btn btn-primary pull-right add-button">
                <i class="glyphicon glyphicon-plus"></i> Dodaj nowego odbiorcę
            </a>
            <table class="table table-hover table-striped my-data-table">
                <thead>
                <tr>
                    <th>
                        Id
                    </th>
                    <th>
                        Nazwa
                    </th>
                    <th>
                        Aktywny
                    </th>
                    <th>
                        Opcje
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var $odbiorca \app\models\Odbiorcy */
                foreach ($list as $odbiorca): ?>
                    <tr>
                        <td>
                            <?= $odbiorca->id ?></td>
                        <td>
                            <?= $odbiorca->nazwa ?>
                        </td>
                        <td>
                            <?= ($odbiorca->aktywny == 1) ? 'Tak' : 'Nie' ?>
                        </td>
                        <td>
                            <a href="?r=odbiorcy/add&id=<?= $odbiorca->id ?>" class="btn btn-primary btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;Edytuj
                            </a>
                            <a href="?r=odbiorcy/products&id=<?= $odbiorca->id ?>" class="btn btn-primary btn-xs">
                                <i class="glyphicon glyphicon-list"></i>&nbsp;&nbsp;<?= \app\models\Konfiguracja::trans('produkty') ?>
                            </a>
                            <a href="?r=zamowienia/index&id=<?= $odbiorca->id ?>" class="btn btn-primary btn-xs">
                                <i class="glyphicon glyphicon-list"></i>&nbsp;&nbsp;Zamówienia
                            </a>
                            <a href="index.php?r=produkty/sklad-pdf-customer&id=<?= $odbiorca->id ?>" class="btn btn-primary btn-xs">
                                <i class="glyphicon glyphicon-print"></i> Drukuj skład <?= \app\models\Konfiguracja::trans('produktow') ?> odbiorcy
                            </a>
                            <a href="?r=odbiorcy/del&id=<?= $odbiorca->id ?>" class="btn btn-primary btn-xs remove-button">
                                <i class="glyphicon glyphicon-trash"></i>&nbsp;&nbsp;Usuń
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
