<?php
/** @var $this yii\web\View
 * @var $parents array
 * @var $functions array
 */

$this->title = 'Składniki';

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Dodaj/edytuj składnik</h1>
            <?php
            $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'nazwa_skladnika')->label('Nazwa składnika')->input('text',['required' => 'required']) ?>
            <?= $form->field($model, 'nazwa_do_skladu')->label('Nazwa do składu') ?>
            <?= $form->field($model, 'alergen')->label('Alergen') ?>
            <?= $form->field($model, 'jednostka')->label('Jednostka')->dropDownList(['kg' => 'kilogramy','szt'=>'sztuki','l'=>'litry']) ?>
            <?= $form->field($model, 'rodzic_id')->label('Rodzic, jeżeli składnik składnika złożonego')->dropDownList($parents) ?>
            <?= $form->field($model, 'przelicznik_szt_kg')->label('Przelicznik ile sztuk na kilogram') ?>
            <?= $form->field($model, 'przelicznik_l_kg')->label('Przelicznik ile litrów na kilogram') ?>
            <?= $form->field($model, 'funkcja_technologiczna_id')->label('Funkcja technologiczna')->dropDownList($functions) ?>
            <?= $form->field($model, 'wartosc_cal')->label('Wartość kaloryczna') ?>
            <?= $form->field($model, 'bialko')->label('Białko') ?>
            <?= $form->field($model, 'tluszcz')->label('Tłuszcz') ?>
            <?= $form->field($model, 'weglowodany')->label('Węglowodany') ?>
            <?= $form->field($model, 'cukier')->label('Cukier') ?>
            <?= $form->field($model, 'od_kiedy')->label('Od kiedy składnik dostępny') ?>
            <?= $form->field($model, 'do_kiedy')->label('Do kiedy składnik dostępny') ?>

            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= HTML::a(Html::button('Anuluj', ['class' => 'btn btn-primary']),'?r=skladniki&index') ?>
                    <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>

    </div>
</div>
