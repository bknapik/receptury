<?php
/* @var $this yii\web\View */
$this->title = 'Składniki';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Składniki</h1>
            <a href="index.php?r=skladniki%2Fadd">Dodaj nowy składnik</a>
            <table>
                <tr><td>Id</td><td>Nazwa składnika</td><td>Opcje</td></tr>
                <?php foreach ($list as $skladnik): ?>
                    <tr><td><?= $skladnik->id ?></td><td><?= $skladnik->nazwa_skladnika ?></td><td><a href="?r=skladniki%2Fadd&id=<?= $skladnik->id ?>">Edytuj</a> <a href="?r=skladniki%2Fdel&id=<?= $skladnik->id ?>">Usuń</a></td></tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>
</div>
