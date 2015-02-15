<?php
/* @var $this yii\web\View */
$this->title = 'Składniki';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Składniki</h1>
            <a href="index.php?r=skladniki%2Fadd" class="btn btn-primary pull-right add-button">Dodaj nowy składnik</a>
            <table class="table">
                <tr><td>Id</td><td>Nazwa składnika</td><td>Opcje</td></tr>
                <?php foreach ($list as $skladnik): ?>
                    <tr><td><?= $skladnik->id ?></td><td><?= $skladnik->nazwa_skladnika ?></td><td><a href="?r=skladniki%2Fadd&id=<?= $skladnik->id ?>" class="btn btn-primary">Edytuj</a> <a href="?r=skladniki%2Fdel&id=<?= $skladnik->id ?>" class="btn btn-primary">Usuń</a></td></tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>
</div>
