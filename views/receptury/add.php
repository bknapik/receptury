<?php
/* @var $this yii\web\View
 * @var $ingredientsForModel
 * @var $ingredients
 * @var $recipe_ingredients
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
            $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'nazwa')->label('Nazwa')->input('text',['required' => 'required']) ?>
            <?= $form->field($model, 'numer')->label('Numer') ?>
            <?= $form->field($model, 'nawazka')->label('Naważka') ?>
            <?= $form->field($model, 'ile_sztuk')->label('Ile sztuk z naważki') ?>
            <?= $form->field($model, 'masa_koncowa')->label('Masa końcowa') ?>
            <?= $form->field($model, 'data_od')->label('Data od której receptura obowiązuje') ?>
            <?= $form->field($model, 'data_do')->label('Data do której receptura obowiązuje') ?>
            <?= $form->field($model, 'woda')->label('Woda') ?>
            <?= $form->field($model, 'uwagi')->label('Uwagi')->textarea() ?>
            <div id="ingredients">
                <h2>Składniki receptury
                    <button class="btn btn-primary" id="add-ingredient" type="button">
                        <i class="glyphicon glyphicon-plus"></i>
                    </button>
                </h2>
                <?php foreach ($ingredientsForModel as $ifm): ?>
                    <div class="form-section <?= ($ifm == $ingredientsForModel[count($ingredientsForModel)-1]) ? 'last' : '' ?>">
                        <button class="btn btn-link pull-right remove-ingredient" type="button">
                            <i class="glyphicon glyphicon-remove"></i>
                        </button>
                        <?= $form->field($ifm, 'skladnik_id')->label('Składnik')->dropDownList($ingredients) ?>
                        <?=
                        $form->field($ifm, 'jednostka')->label('Jednostka')->dropDownList([
                            'kg' => 'kilogramy',
                            'szt' => 'sztuki',
                            'l' => 'litry'
                        ]) ?>
                        <?= $form->field($ifm, 'ilosc')->label('Ilość') ?>
                    </div>
                <?php endforeach; ?>
                <?php if (empty($ingredientsForModel)): ?>
                    <div class="form-section last">
                        <button class="btn btn-link pull-right remove-ingredient" type="button">
                            <i class="glyphicon glyphicon-remove"></i>
                        </button>
                        <?= $form->field($recipe_ingredients, 'skladnik_id')->label('Składnik')->dropDownList($ingredients) ?>
                        <?=
                        $form->field($recipe_ingredients, 'jednostka')->label('Jednostka')->dropDownList([
                            'kg' => 'kilogramy',
                            'szt' => 'sztuki',
                            'l' => 'litry'
                        ]) ?>
                        <?= $form->field($recipe_ingredients, 'ilosc')->label('Ilość') ?>
                    </div>
                <?php endif; ?>
            </div>
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
