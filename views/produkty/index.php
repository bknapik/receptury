<?php
/* @var $this yii\web\View */
$this->title = 'Produkty';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Produkty</h1>
            <a href="index.php?r=produkty%2Fadd" class="btn btn-primary pull-right add-button">Dodaj nowy produkt</a>
            <table class="table">
            <tr><td>Id</td><td>Nazwa</td><td>Opcje</td></tr>
                <?php foreach ($list as $produkt): ?>
                    <tr><td><?= $produkt->id ?></td><td><?= $produkt->nazwa ?></td><td><a href="?r=produkty%2Fadd&id=<?= $produkt->id ?>" class="btn btn-primary">Edytuj</a> <a href="?r=produkty%2Fdel&id=<?= $produkt->id ?>" class="btn btn-primary">Usuń</a></td></tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>
</div>
