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
                'options' => ['class' => 'form-horizontal']
            ]) ?>
            <?= $form->field($model, 'nazwa')->label('Nazwa')->input('text',['required' => 'required']) ?>
            <?= $form->field($model, 'stawka')->label('Stawka')->input('number',['step' => 0.01]) ?>
            <?= $form->field($model, 'litera')->label('Litera')->input('text',['required' => 'required', 'maxlength' => 1]) ?>


            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= HTML::a(Html::button('Anuluj', ['class' => 'btn btn-primary']),'?r=stawki&index') ?>
                    <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>

    </div>
</div>
