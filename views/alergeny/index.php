<?php
/* @var $this yii\web\View */
$this->title = 'Alergeny';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Alergeny</h1>
            <a href="index.php?r=alergeny/add" class="btn btn-primary pull-right add-button">
                <i class="glyphicon glyphicon-plus"></i> Dodaj nowy alergen
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
                        Opcje
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($list as $alergen): ?>
                    <tr>
                        <td>
                            <?= $alergen->id ?>
                        </td>
                        <td>
                            <?= $alergen->nazwa ?>
                        </td>
                        <td>
                            <a href="?r=alergeny/add&id=<?= $alergen->id ?>" class="btn btn-primary">
                                <i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;Edytuj
                            </a>
                            <a href="?r=alergeny/del&id=<?= $alergen->id ?>" class="btn btn-primary remove-button">
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
