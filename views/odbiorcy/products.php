<?php
/* @var $this yii\web\View */
$this->title = 'Odbiorcy';
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Produkty przypisane do odbiorcy</h1>
            <?php $form = ActiveForm::begin() ?>
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>
                        Opcje
                    </th>
                    <th>
                        Id
                    </th>

                    <th>
                        Nazwa
                    </th>

                </tr>
                </thead>
                <tbody>
                <?php foreach ($list as $produkt): ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="produkt_id[]" value="<?= $produkt->id ?>" <?= (in_array($produkt->id,$ids)) ? 'checked="checked"' : '' ?>/>
                        </td>
                        <td>
                            <?= $produkt->id ?>
                        </td>
                        <td>
                            <?= $produkt->nazwa ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= HTML::a(Html::button('Anuluj', ['class' => 'btn btn-primary']),'?r=odbiorcy&index') ?>
                    <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>

    </div>
</div>
