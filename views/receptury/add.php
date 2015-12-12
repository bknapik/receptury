<?php
/* @var $this yii\web\View
 * @var $ingredientsForModel
 * @var $ingredients
 * @var $recipe_ingredients
 * @var $allergens
 */
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
                'options' => ['class' => 'form-horizontal']
            ]) ?>
            <?= $form->field($model, 'nazwa')->label('Nazwa')->input('text', ['required' => 'required']) ?>
            <?= $form->field($model, 'numer')->label('Numer') ?>
            <?= $form->field($model, 'masa_koncowa')->label('Masa końcowa') ?>
            <?= $form->field($model, 'data_od')->label('Data od której receptura obowiązuje') ?>
            <?= $form->field($model, 'data_do')->label('Data do której receptura obowiązuje') ?>
            <?= $form->field($model, 'woda')->label('Woda') ?>
            <?= $form->field($model, 'uwagi')->label('Uwagi')->textarea() ?>
            <h2>Możliwe dodatkowe alergeny</h2>
            <div class="form-section allergens">
                <?= $form->field($model, 'alergen_id')->checkboxlist($allergens)->label(''); ?>
                <button class="btn small btn-primary" id="check-all-allergens" data-check="true">Zaznacz wszystkie alergeny</button>
            </div>
            <div id="ingredients">
                <h2><?= \app\models\Konfiguracja::trans('skladniki') ?> receptury
                    <button class="btn btn-primary add-ingredient" type="button">
                        <i class="glyphicon glyphicon-plus"></i>
                    </button>
                </h2>
                <?php foreach ($ingredientsForModel as $ifm): ?>
                    <div
                        class="form-section with-percent <?= ($ifm == $ingredientsForModel[count($ingredientsForModel) - 1]) ? 'last' : '' ?>">
                        <button class="btn btn-link pull-right remove-ingredient" type="button">
                            <i class="glyphicon glyphicon-remove"></i>
                        </button>
                        <?= $form->field($ifm, 'skladnik_id')->label(ucfirst(\app\models\Konfiguracja::trans('skladnik')))->dropDownList($ingredients) ?>
                        <?=
                        $form->field($ifm, 'jednostka')->label('Jednostka')->dropDownList([
                            'kg' => 'kilogramy',
                            'szt' => 'sztuki',
                            'l' => 'litry'
                        ]) ?>
                        <?= $form->field($ifm, 'ilosc')->label('Ilość')->input('number', ['step' => 0.001, 'min' => 0, 'minValue' => 0, 'required' => 'required']) ?>
                        <div class="col-lg-offset-2 col-lg-10 show-percent">
                            <?= $form->field($ifm, 'wyswietlac_procent')->checkbox(array('label' => 'Wyświetlać procent w składzie?')) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php if (empty($ingredientsForModel)): ?>
                    <div class="form-section with-percent last">
                        <button class="btn btn-link pull-right remove-ingredient" type="button">
                            <i class="glyphicon glyphicon-remove"></i>
                        </button>
                        <?= $form->field($recipe_ingredients, 'skladnik_id')->label( ucfirst(\app\models\Konfiguracja::trans('skladnik')))->dropDownList($ingredients) ?>
                        <?=
                        $form->field($recipe_ingredients, 'jednostka')->label('Jednostka')->dropDownList([
                            'kg' => 'kilogramy',
                            'szt' => 'sztuki',
                            'l' => 'litry'
                        ]) ?>
                        <?= $form->field($recipe_ingredients, 'ilosc')->label('Ilość')->input('number', ['step' => 0.001, 'min' => 0, 'minValue' => 0, 'required' => 'required']) ?>
                        <div class="col-lg-offset-2 col-lg-10 show-percent">
                            <?= $form->field($recipe_ingredients, 'wyswietlac_procent')->checkbox(array('label' => 'Wyświetlać procent w składzie?')) ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <button class="btn btn-primary add-ingredient" type="button">
                <i class="glyphicon glyphicon-plus"></i> Dodaj następny <?= \app\models\Konfiguracja::trans('skladnik') ?>
            </button>
            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= HTML::a(Html::button('Anuluj', ['class' => 'btn btn-primary']), '?r=receptury&index') ?>
                    <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>

    </div>
</div>
