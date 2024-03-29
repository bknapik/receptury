<?php
/* @var $this yii\web\View
 * @var $recipes
 * @var $vat
 */
$this->title = \app\models\Konfiguracja::trans('produkty');

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Dodaj/edytuj <?= \app\models\Konfiguracja::trans('produkt') ?></h1>
            <?php
            $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-horizontal'],
            ]) ?>
            <?= $form->field($model, 'nazwa')->label('Nazwa')->input('text',['required' => 'required']) ?>
            <?= $form->field($model, 'masa_netto')->label('Masa netto')->input('number',['required' => 'required', 'step' => 0.01, 'min' => 0, 'minValue' => 0]) ?>
            <?= $form->field($model, 'receptura_id')->label('Receptura')->dropDownList($recipes) ?>
            <?= $form->field($model, 'cena_det_netto')->label('Cena detaliczna netto')->input('number',['step' => 0.01, 'min' => 0, 'minValue' => 0]) ?>
            <?= $form->field($model, 'cena_det_brutto')->label('Cena detaliczna brutto')->input('number',['step' => 0.01, 'min' => 0, 'minValue' => 0]) ?>
            <?= $form->field($model, 'cena_hurt_netto')->label('Cena hurtowa netto')->input('number',['step' => 0.01, 'min' => 0, 'minValue' => 0]) ?>
            <?= $form->field($model, 'cena_hurt_brutto')->label('Cena hurtowa brutto')->input('number',['step' => 0.01, 'min' => 0, 'minValue' => 0]) ?>
            <?= $form->field($model, 'vat_id')->label('Stawka VAT')->dropDownList($vat) ?>
            <?= $form->field($model, 'data_od')->label('Data od której obowiązuje '. \app\models\Konfiguracja::trans('produkt')) ?>
            <?= $form->field($model, 'data_do')->label('Data do której obowiązuje '. \app\models\Konfiguracja::trans('produkt')) ?>
            <?php if($model->grafika != '' && $model->grafika != null): ?>
                <img src="uploads/<?= $model->grafika ?>"/>
                <?= $form->field($model,'file_rem')->checkbox(array('label'=>'Usuń grafikę')) ?>
            <?php endif; ?>
            <?= $form->field($model, 'grafika')->fileInput() ?>
            <?= $form->field($model, 'opis')->label('Opis')->textarea() ?>
            <?= $form->field($model, 'nawazka')->label('Naważka')->input('number',['step' => 0.001, 'min' => 0, 'minValue' => 0]) ?>
            <?= $form->field($model, 'presa')->label('Presa')->input('number',['step' => 0.001, 'min' => 0, 'minValue' => 0]) ?>
            <?= $form->field($model, 'ile_sztuk')->label('Ile sztuk wg receptury')->input('number',['step' => 0.5, 'min' => 0, 'minValue' => 0]) ?>
            <?= $form->field($model, 'sortowanie')->label('Kolejność')->input('number') ?>


            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= HTML::a(Html::button('Anuluj', ['class' => 'btn btn-primary']),'?r=produkty&index') ?>
                    <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>

    </div>
</div>
