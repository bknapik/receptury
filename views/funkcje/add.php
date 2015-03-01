<?php
/* @var $this yii\web\View */
$this->title = 'Funkcje technologiczne';

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Dodaj/edytuj funkcję technologiczną</h1>
            <?php
            $form = ActiveForm::begin([]) ?>
            <?= $form->field($model, 'nazwa')->label('Nazwa')->input('text',['required' => 'required']) ?>
            <?= $form->field($model, 'nazwa_wielokrotna')->label('Nazwa (liczba mnoga)')->input('text',['required' => 'required']) ?>


            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= HTML::a(Html::button('Anuluj', ['class' => 'btn btn-primary']),'?r=funkcje&index') ?>
                    <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>

    </div>
</div>
