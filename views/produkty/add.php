<?php
/* @var $this yii\web\View */
$this->title = 'Produkty';

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Dodaj/edytuj produkt</h1>
            <?php
            $form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal','enctype' => 'multipart/form-data'],
            ]) ?>
            <?= $form->field($model, 'nazwa')->label('Nazwa')->input('text',['required' => 'required']) ?>
            <?= $form->field($model, 'masa_netto')->label('Masa netto') ?>
            <?= $form->field($model, 'receptura_id')->label('Receptura')->dropDownList($recipes) ?>
            <?= $form->field($model, 'cena_det_netto')->label('Cena detaliczna netto') ?>
            <?= $form->field($model, 'cena_det_brutto')->label('Cena detaliczna brutto') ?>
            <?= $form->field($model, 'cena_hurt_netto')->label('Cena hurtowa netto') ?>
            <?= $form->field($model, 'cena_hurt_brutto')->label('Cena hurtowa brutto') ?>
            <?= $form->field($model, 'vat_id')->label('Stawka VAT')->dropDownList($vat) ?>
            <?= $form->field($model, 'data_od')->label('Data od której obowiązuje produkt') ?>
            <?= $form->field($model, 'data_do')->label('Data do której obowiązuje produkt') ?>
            <?= $form->field($model, 'grafika')->fileInput() ?>
            <?= $form->field($model, 'opis')->label('Opis')->textarea() ?>
            <?= $form->field($model, 'nawazka')->label('Naważka') ?>
            <?= $form->field($model, 'sortowanie')->label('Kolejność') ?>


            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>

    </div>
</div>
