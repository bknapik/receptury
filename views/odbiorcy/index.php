<?php
/* @var $this yii\web\View */
$this->title = 'Składniki';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Odbiorcy</h1>
            <a href="index.php?r=odbiorcy%2Fadd" class="btn btn-primary pull-right add-button">Dodaj nowego odbiorcę</a>
            <table class="table">
            <tr><td>Id</td><td>Nazwa</td><td>Opcje</td></tr>
                <?php foreach ($list as $odbiorca): ?>
                    <tr><td><?= $odbiorca->id ?></td><td><?= $odbiorca->nazwa ?></td><td><a href="?r=odbiorcy%2Fadd&id=<?= $odbiorca->id ?>" class="btn btn-primary">Edytuj</a> <a href="?r=odbiorcy%2Fdel&id=<?= $odbiorca->id ?>" class="btn btn-primary">Usuń</a></td></tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>
</div>
