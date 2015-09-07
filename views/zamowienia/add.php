<?php
/* @var $this yii\web\View */
$this->title = 'Zamówienia';

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Dodaj/edytuj zamówienie</h1>
            <?php
            $form = ActiveForm::begin([
                'options' => ['class' => 'form-horizontal']
            ]) ?>
            <?= $form->field($model, 'data')->label('Data')->input('text',['required' => 'required']) ?>
            <?= $form->field($model, 'zrealizowane')->label('Data ralizacji') ?>
            <?= $form->field($model, 'zafakturowane')->label('Data zafakturowania') ?>
            <?= $form->field($model, 'klient_id')->label('')->hiddenInput() ?>
            <?php if(!empty($customerProducts)): ?>
                <?php foreach($customerProducts as $product): ?>
                    <?= $form->field($modelZP, 'ile['.$product->id.']')->label($product->nazwa) ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= HTML::a(Html::button('Anuluj', ['class' => 'btn btn-primary']),'?r=alergeny&index') ?>
                    <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>

    </div>
</div>
