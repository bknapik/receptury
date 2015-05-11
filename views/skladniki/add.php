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
            <div id="ingredients">
                <h2>Składniki składnika
                    <button class="btn btn-primary add-ingredient" type="button">
                        <i class="glyphicon glyphicon-plus"></i>
                    </button>
                </h2>
                <?php foreach ($ingredientsForModel as $ifm): ?>
                    <div class="form-section <?= ($ifm == $ingredientsForModel[count($ingredientsForModel)-1]) ? 'last' : '' ?>">
                        <button class="btn btn-link pull-right remove-ingredient" type="button">
                            <i class="glyphicon glyphicon-remove"></i>
                        </button>
                        <?= $form->field($ifm, 'skladnik_id')->label('Składnik')->dropDownList($ingredients) ?>
                        <?= $form->field($ifm, 'kilogramy')->label('Ilość w kilogramach') ?>
                        <?= $form->field($ifm, 'procenty')->label('Ilość w procentach') ?>
                        <?= $form->field($ifm, 'wyswietlac_procent')->checkbox(array('label' => 'Wyświetlać procent w składzie?')) ?>
                    </div>
                <?php endforeach; ?>
                <?php if (empty($ingredientsForModel)): ?>
                    <div class="form-section last">
                        <button class="btn btn-link pull-right remove-ingredient" type="button">
                            <i class="glyphicon glyphicon-remove"></i>
                        </button>
                        <?= $form->field($ingredient_ingredients, 'skladnik_id')->label('Składnik')->dropDownList($ingredients) ?>
                        <?= $form->field($ingredient_ingredients, 'kilogramy')->label('Ilość w kilogramach') ?>
                        <?= $form->field($ingredient_ingredients, 'procenty')->label('Ilość w procentach') ?>
                        <?= $form->field($ingredient_ingredients, 'wyswietlac_procent')->checkbox(array('label' => 'Wyświetlać procent w składzie?')) ?>
                    </div>
                <?php endif; ?>
            </div>
            <button class="btn btn-primary add-ingredient" type="button">
                <i class="glyphicon glyphicon-plus"></i> Dodaj następny składnik
            </button>

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
