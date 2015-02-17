<?php
/* @var $this yii\web\View */
$this->title = 'Produkty';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Produkty</h1>
            <a href="index.php?r=produkty%2Fadd" class="btn btn-primary pull-right add-button">
                <i class="glyphicon glyphicon-plus"></i> Dodaj nowy produkt
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
                        Masa netto
                    </th>
                    <th>
                        Opcje
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($list as $produkt): ?>
                    <tr>
                        <td>
                            <?= $produkt->id ?>
                        </td>
                        <td>
                            <?= $produkt->nazwa ?>
                        </td>
                        <td>
                            <?= $produkt->masa_netto ?>
                        </td>
                        <td>
                            <a href="?r=produkty%2Fadd&id=<?= $produkt->id ?>" class="btn btn-primary">
                                <i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;Edytuj
                            </a>
                            <a href="?r=produkty%2Fdel&id=<?= $produkt->id ?>" class="btn btn-primary">
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
