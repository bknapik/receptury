<?php
/* @var $this yii\web\View */
$this->title = 'Receptury';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Konfiguracja</h1>
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>
                        Nazwa
                    </th>
                    <th>
                        Wartość
                    </th>
                    <th>
                        Opcje
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($list as $config): ?>
                    <tr>
                        <td>
                            <?= $config->nazwa ?>
                        </td>
                        <td>
                            <?= $config->wartosc ?>
                        </td>
                        <td>
                            <a href="?r=site%2Fedit&id=<?= $config->klucz ?>" class="btn btn-primary">
                                <i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;Edytuj
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
