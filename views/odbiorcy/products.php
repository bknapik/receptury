<?php
/* @var $this yii\web\View
 * @var $list
 * @var $ids
 */
$this->title = 'Odbiorcy';
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <h1><?= \app\models\Konfiguracja::trans('produkty') ?> przypisane do odbiorcy</h1>
            <?php $form = ActiveForm::begin() ?>
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>
                        Opcje
                    </th>
                    <th>
                        Nazwa
                    </th>

                </tr>
                </thead>
                <tbody>
                <?php /** @var $produkt \app\models\Produkty */
                foreach ($list as $produkt): ?>
                    <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="produkt_id[]" class="products"
                                       value="<?= $produkt->id ?>"
                                    <?= (in_array($produkt->id,$ids)) ? 'checked="checked"' : '' ?>/>
                            </label>
                        </td>
                        <td>
                            <?= $produkt->nazwa ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <button class="btn small btn-primary" id="check-all-products" data-check="true">Zaznacz wszystkie <?= strtolower(\app\models\Konfiguracja::trans('produkty')) ?></button>
                    <?= HTML::a(Html::button('Anuluj', ['class' => 'btn btn-primary']),'?r=odbiorcy&index') ?>
                    <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>

    </div>
</div>
