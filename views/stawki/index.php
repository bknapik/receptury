<?php
/* @var $this yii\web\View */
$this->title = 'Stawki VAT';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Stawki VAT</h1>
            <a href="index.php?r=stawki%2Fadd" class="btn btn-primary pull-right add-button">Dodaj nową stawkę VAT</a>
            <table class="table">
            <tr><td>Id</td><td>Nazwa</td><td>Opcje</td></tr>
                <?php foreach ($list as $stawka): ?>
                    <tr><td><?= $stawka->id ?></td><td><?= $stawka->nazwa ?></td><td><a href="?r=stawki%2Fadd&id=<?= $stawka->id ?>" class="btn btn-primary">Edytuj</a> <a href="?r=stawki%2Fdel&id=<?= $stawka->id ?>" class="btn btn-primary">Usuń</a></td></tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>
</div>
