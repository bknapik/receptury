<?php
/* @var $this yii\web\View */
$this->title = 'Składniki';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Funkcje technologiczne</h1>
            <a href="index.php?r=funkcje%2Fadd" class="btn btn-primary pull-right add-button">Dodaj nową funkcję technologiczną</a>
            <table class="table">
            <tr><td>Id</td><td>Nazwa</td><td>Opcje</td></tr>
                <?php foreach ($list as $funkcja): ?>
                    <tr><td><?= $funkcja->id ?></td><td><?= $funkcja->nazwa ?></td><td><a href="?r=funkcje%2Fadd&id=<?= $funkcja->id ?>" class="btn btn-primary">Edytuj</a> <a href="?r=funkcje%2Fdel&id=<?= $funkcja->id ?>" class="btn btn-primary">Usuń</a></td></tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>
</div>
