<?php
/** @var $this yii\web\View
 * @var $list array Skladniki
 */
$this->title = \app\models\Konfiguracja::trans('skladniki');
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1><?= \app\models\Konfiguracja::trans('skladniki') ?></h1>
            <a href="index.php?r=skladniki/add" class="btn btn-primary pull-right add-button">
                <i class="glyphicon glyphicon-plus"></i> Dodaj nowy <?= \app\models\Konfiguracja::trans('skladnik') ?>
            </a>
            <table class="table table-hover table-striped my-data-table">
                <thead>
                <tr>
                    <th>
                        Nazwa
                    </th>
                    <th>
                        Nazwa do składu
                    </th>
                    <th>
                        Alergen
                    </th>
                    <th>
                        Wersja
                    </th>
                    <th >
                        Opcje
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var $skladnik \app\models\Skladniki */
                foreach ($list as $skladnik): ?>
                    <tr>
                        <td>
                            <?= $skladnik->nazwa_skladnika ?>
                        </td>
                        <td>
                            <?= $skladnik->nazwa_do_skladu ?>
                        </td>
                        <td>
                            <?= $skladnik->alergen ?>
                        </td>
                        <td>
                            <?= $skladnik->wersja ?>
                        </td>
                        <td>
                            <a href="?r=skladniki/add&id=<?= $skladnik->id ?>" class="btn btn-primary btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;Edytuj
                            </a>
                            <a href="?r=skladniki/del&id=<?= $skladnik->id ?>" class="btn btn-primary remove-button btn-xs">
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
