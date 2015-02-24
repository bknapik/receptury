<?php
/* @var $this yii\web\View
 * @var $list
 */
$this->title = 'Receptury';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Receptury</h1>
            <a href="index.php?r=receptury/add" class="btn btn-primary pull-right add-button">
                <i class="glyphicon glyphicon-plus"></i> Dodaj nową recepturę
            </a>
            <table class="table table-hover table-striped my-data-table">
                <thead>
                <tr>
                    <th>
                        Id
                    </th>
                    <th>
                        Nazwa
                    </th>
                    <th>
                        Numer
                    </th>
                    <th>
                        Masa końcowa
                    </th>
                    <th>
                        Opcje
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var $receptura \app\models\Receptury */
                foreach ($list as $receptura): ?>
                    <tr>
                        <td>
                            <?= $receptura->id ?>
                        </td>
                        <td>
                            <?= $receptura->nazwa ?>
                        </td>
                        <td>
                            <?= $receptura->numer ?>
                        </td>
                        <td>
                            <?= $receptura->masa_koncowa ?>
                        </td>
                        <td>
                            <a href="?r=receptury/add&id=<?= $receptura->id ?>" class="btn btn-primary">
                                <i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;Edytuj
                            </a>
                            <a href="?r=receptury/del&id=<?= $receptura->id ?>" class="btn btn-primary">
                                <i class="glyphicon glyphicon-trash"></i>&nbsp;&nbsp;Usuń
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
