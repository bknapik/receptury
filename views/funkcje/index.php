<?php
/**
 * @var $this yii\web\View
 * @var $list
 */
$this->title = 'Funkcje technologiczne';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Funkcje technologiczne</h1>
            <a href="index.php?r=funkcje/add" class="btn btn-primary pull-right add-button">
                <i class="glyphicon glyphicon-plus"></i> Dodaj nową funkcję technologiczną
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
                <?php foreach ($list as $funkcja): ?>
                    <tr>
                        <td>
                            <?= $funkcja->id ?>
                        </td>
                        <td>
                            <?= $funkcja->nazwa ?>
                        </td>
                        <td>
                            <a href="?r=funkcje/add&id=<?= $funkcja->id ?>" class="btn btn-primary btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;Edytuj
                            </a>
                            <a href="?r=funkcje/del&id=<?= $funkcja->id ?>" class="btn btn-primary remove-button btn-xs">
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
