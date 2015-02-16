<?php
/* @var $this yii\web\View */
$this->title = 'Receptury';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Konfiguracja</h1>
            <table class="table">
                <tr><td>Nazwa</td><td>Opcje</td></tr>
                <?php foreach ($list as $config): ?>
                    <tr><td><?= $config->nazwa ?></td><td><a href="?r=site%2Fedit&id=<?= $config->klucz ?>" class="btn btn-primary">Edytuj</a></tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>
</div>
