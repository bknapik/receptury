<?php
/* @var $this yii\web\View */
$this->title = 'Receptury';

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Dodaj/edytuj recepturę</h1>
            <?php
            $form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal'],
            ]) ?>
            <?= $form->field($model, 'nazwa')->label('Nazwa') ?>
            <?= $form->field($model, 'numer')->label('Numer') ?>
            <?= $form->field($model, 'nawazka')->label('Naważka') ?>
            <?= $form->field($model, 'ile_sztuk')->label('Ile sztuk z naważki') ?>
            <?= $form->field($model, 'masa_koncowa')->label('Masa końcowa') ?>
            <?= $form->field($model, 'data_od')->label('Data od której receptura obowiązuje') ?>
            <?= $form->field($model, 'data_do')->label('Data do której receptura obowiązuje') ?>
            <?= $form->field($model, 'woda')->label('Woda') ?>
            <?= $form->field($model, 'uwagi')->label('Uwagi')->textarea() ?>
            <h2>Składniki receptury</h2>
            <?php foreach($ingredientsForModel as $ifm): ?>
                <?= $form->field($ifm, 'skladnik_id[]')->label('Składnik')->dropDownList($ingredients) ?>
                <?= $form->field($ifm, 'jednostka[]')->label('Jednostka')->dropDownList(['kg' => 'kilogramy','szt'=>'sztuki','l'=>'litry']) ?>
                <?= $form->field($ifm, 'ilosc[]')->label('Ilość') ?>
            <?php endforeach; ?>
            <?= $form->field($rs, 'skladnik_id[]')->label('Składnik')->dropDownList($ingredients) ?>
            <?= $form->field($rs, 'jednostka[]')->label('Jednostka')->dropDownList(['kg' => 'kilogramy','szt'=>'sztuki','l'=>'litry']) ?>
            <?= $form->field($rs, 'ilosc[]')->label('Ilość') ?>
            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>

    </div>
</div>
