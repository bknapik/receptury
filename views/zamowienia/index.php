<?php
/**
 * @var $this yii\web\View
 * @var $list
 */
$this->title = 'Zamówienia';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Zamówienia</h1>
            <a href="index.php?r=zamowienia/add&client_id=<?= $client_id ?>" class="btn btn-primary pull-right add-button">
                <i class="glyphicon glyphicon-plus"></i> Dodaj nowe zamówienie
            </a>
            <table class="table table-hover table-striped my-data-table">
                <thead>
                <tr>
                    <th>
                        Id
                    </th>
                    <th>
                        Data
                    </th>
                    <th>
                        Opcje
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($list as $zamowienie): ?>
                    <tr>
                        <td>
                            <?= $zamowienie->id ?>
                        </td>
                        <td>
                            <?= $zamowienie->data ?>
                        </td>
                        <td>
                            <a href="?r=zamowienia/add&id=<?= $zamowienie->id ?>" class="btn btn-primary btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;Edytuj
                            </a>
                            <a href="?r=zamowienia/del&id=<?= $zamowienie->id ?>" class="btn btn-primary remove-button btn-xs">
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
