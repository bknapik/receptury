<?php
/* @var $this yii\web\View
 * @var $list
 */
$this->title = 'Receptury';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Receptury</h1>
            <a href="index.php?r=receptury/add" class="btn btn-primary pull-right add-button">
                <i class="glyphicon glyphicon-plus"></i> Dodaj nową recepturę
            </a>
            <table class="table table-hover table-striped my-data-table recipe-table">
                <thead>
                <tr>
                    <th>
                        Nazwa
                    </th>
                    <th>
                        Numer
                    </th>
                    <th>
                        Aktywna
                    </th>
                    <th>
                        Opcje
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var $receptura \app\models\Receptury */
                foreach ($list as $receptura): ?>
                    <tr>
                        <td>
                            <?= $receptura->nazwa ?>
                        </td>
                        <td>
                            <?= $receptura->numer ?>
                        </td>
                        <td>
                            <?= (($receptura->data_od == null ||
                                    $receptura->data_od == '0000-00-00' ||
                                    $receptura->data_od <= date('Y-m-d')) &&
                                ($receptura->data_do == null ||
                                    $receptura->data_do == '0000-00-00' ||
                                    $receptura->data_do >= date('Y-m-d'))) ? 'TAK' : 'NIE' ?>
                        </td>
                        <td>
                            <a href="?r=receptury/add&id=<?= $receptura->id ?>" class="btn btn-primary btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;Edytuj
                            </a>
                            <a href="?r=receptury/add-similar&id=<?= $receptura->id ?>" class="btn btn-primary btn-xs">
                                <i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Dodaj podobną
                            </a>
                            <a href="?r=receptury/del&id=<?= $receptura->id ?>"
                               class="btn btn-primary remove-button btn-xs">
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
