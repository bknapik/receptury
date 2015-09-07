<?php
/* @var $this yii\web\View */
$this->title = 'Odbiorcy';

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Dodaj/edytuj odbiorcę</h1>
            <?php
            $form = ActiveForm::begin([
                'options' => ['class' => 'form-horizontal']
            ]) ?>
            <?= $form->field($model, 'nazwa')->label('Nazwa')->input('text',['required' => 'required']) ?>
            <?= $form->field($model, 'nazwa_skrocona')->label('Skrócona nazwa') ?>
            <?= $form->field($model, 'nip')->label('NIP/PESEL') ?>
            <?= $form->field($model, 'adres')->label('Adres') ?>
            <?= $form->field($model, 'telefon')->label('Telefon') ?>
            <?= $form->field($model, 'email')->label('Email') ?>
            <?= $form->field($model, 'osoby_kontaktowe')->label('Osoby kontaktowe') ?>
            <?= $form->field($model, 'status')->label('Status') ?>
            <?= $form->field($model, 'uwagi')->label('Uwagi')->textarea() ?>
            <?= $form->field($model, 'aktywny')->label('Czy odbiorca aktywny')->checkbox() ?>


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
