<?php
/* @var $this yii\web\View */
$this->title = 'Stawki VAT';

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Dodaj/edytuj stawkę VAT</h1>
            <?php
            $form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal'],
            ]) ?>
            <?= $form->field($model, 'nazwa')->label('Nazwa') ?>
            <?= $form->field($model, 'stawka')->label('Stawka') ?>
            <?= $form->field($model, 'litera')->label('Litera') ?>


            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>

    </div>
</div>
