<?php
/* @var $this yii\web\View
 * @var $type
 */
$this->title = 'Funkcje technologiczne';

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1>Edytuj</h1>
            <?php
            $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
            ]) ?>
            <?= $form->field($model, 'klucz')->hiddenInput()->label('') ?>
            <?= $form->field($model, 'nazwa')->label('Nazwa')->input('text',array('readonly' => 'readonly')) ?>
            <?php if($model->klucz == 'logo' && $model->wartosc != '' && $model->wartosc != null): ?>
                <img src="uploads/<?= $model->wartosc ?>"/>
            <?php endif; ?>
            <?= ($type == 'file') ?
                $form->field($model, 'wartosc')->label('Wartość')->fileInput() :
                $form->field($model, 'wartosc')->label('Wartość')->input('text',['required' => 'required']) ?>


            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= HTML::a(Html::button('Anuluj', ['class' => 'btn btn-primary']),'index.php') ?>
                    <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>

    </div>
</div>
