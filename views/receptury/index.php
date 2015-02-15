<?php
/* @var $this yii\web\View */
$this->title = 'Receptury';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Receptury</h1>
            <a href="index.php?r=receptury%2Fadd" class="btn btn-primary pull-right add-button">Dodaj nową recepturę</a>
            <table class="table">
                <tr><td>Id</td><td>Nazwa</td><td>Opcje</td></tr>
                <?php foreach ($list as $receptura): ?>
                    <tr><td><?= $receptura->id ?></td><td><?= $receptura->nazwa ?></td><td><a href="?r=receptury%2Fadd&id=<?= $receptura->id ?>" class="btn btn-primary">Edytuj</a> <a href="?r=receptury%2Fdel&id=<?= $receptura->id ?>" class="btn btn-primary">Usuń</a></td></tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>
</div>
