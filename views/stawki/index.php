<?php
/* @var $this yii\web\View */
$this->title = 'Stawki VAT';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Stawki VAT</h1>
            <a href="index.php?r=stawki%2Fadd" class="btn btn-primary pull-right add-button">
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
                <?php foreach ($list as $stawka): ?>
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
                            <a href="?r=stawki%2Fadd&id=<?= $stawka->id ?>" class="btn btn-primary">
                                <i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;Edytuj
                            </a>
                            <a href="?r=stawki%2Fdel&id=<?= $stawka->id ?>" class="btn btn-primary">
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
