<?php
/* @var $this yii\web\View
 * @var $list
 */
$this->title = 'StawkiVat VAT';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Stawki VAT</h1>
            <a href="index.php?r=stawki/add" class="btn btn-primary pull-right add-button">
                <i class="glyphicon glyphicon-plus"></i> Dodaj nową stawkę VAT
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
                        Stawka
                    </th>
                    <th>
                        Litera
                    </th>
                    <th>
                        Opcje
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var $stawka \app\models\StawkiVat */
                foreach ($list as $stawka): ?>
                    <tr>
                        <td>
                            <?= $stawka->id ?>
                        </td>
                        <td>
                            <?= $stawka->nazwa ?>
                        </td>
                        <td>
                            <?= $stawka->stawka ?>
                        </td>
                        <td>
                            <?= $stawka->litera ?>
                        </td>
                        <td>
                            <a href="?r=stawki/add&id=<?= $stawka->id ?>" class="btn btn-primary">
                                <i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;Edytuj
                            </a>
                            <a href="?r=stawki/del&id=<?= $stawka->id ?>" class="btn btn-primary remove-button">
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
