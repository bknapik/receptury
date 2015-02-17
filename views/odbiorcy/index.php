<?php
/* @var $this yii\web\View */
$this->title = 'Odbiorcy';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Odbiorcy</h1>
            <a href="index.php?r=odbiorcy%2Fadd" class="btn btn-primary pull-right add-button">
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
                        Opcje
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($list as $odbiorca): ?>
                    <tr>
                        <td>
                            <?= $odbiorca->id ?></td>
                        <td><?= $odbiorca->nazwa ?>
                        </td>
                        <td>
                            <a href="?r=odbiorcy%2Fadd&id=<?= $odbiorca->id ?>" class="btn btn-primary">
                                <i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;Edytuj
                            </a>
                            <a href="?r=odbiorcy%2Fdel&id=<?= $odbiorca->id ?>" class="btn btn-primary">
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
