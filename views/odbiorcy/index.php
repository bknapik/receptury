<?php
/* @var $this yii\web\View */
$this->title = 'Składniki';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>odbiorcy technologiczne</h1>
            <a href="index.php?r=odbiorcy%2Fadd">Dodaj nowego odbiorcę</a>
            <table>
                <tr><td>Id</td><td>Nazwa</td><td>Opcje</td></tr>
                <?php foreach ($list as $odbiorca): ?>
                    <tr><td><?= $odbiorca->id ?></td><td><?= $odbiorca->nazwa ?></td><td><a href="?r=odbiorcy%2Fadd&id=<?= $odbiorca->id ?>">Edytuj</a> <a href="?r=odbiorcy%2Fdel&id=<?= $odbiorca->id ?>">Usuń</a></td></tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>
</div>
