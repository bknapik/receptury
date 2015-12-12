<?php
/**
 * Created by PhpStorm.
 * User: Kinga
 * Date: 26.03.15
 * Time: 18:11
 */
/**
 * @var $model \app\models\Produkty
 * @var $config_list
 */
$recipeIngredients = $model->recipe->recipeIngredientsWithOrder;
$recipeIngredientsWithFunction = array();
$recipe = $model->recipe;
$break = (count($recipeIngredients) >= 10) ? 3 : 4;
$html = '';
$suma = 0;
foreach ($recipeIngredients as $recipeIngredient):
    $suma += $recipeIngredient->ilosc_przeliczona;
endforeach;
foreach ($recipeIngredients as $recipeIngredient):
    /** @var $ingredient \app\models\Skladniki */
    $ingredient = $recipeIngredient->ingredient;
    $ingredients = $ingredient->getChildren();
    $quantity = ($recipeIngredient->ilosc_przeliczona / $suma) * 100;
    if ($ingredient->funkcja_technologiczna_id != null):
        $recipeIngredientsWithFunction[$ingredient->funkcja_technologiczna_id][] = $recipeIngredient;
        continue;
    endif;
    $html .= $ingredient->nazwa_do_skladu;
    if ($ingredient->alergen != '') :
        $html .= ' <strong>' . $ingredient->alergen . '</strong> ';
    endif;
    if (!empty($ingredients) && $quantity >= 2) :
        $html .= ' (';
        foreach ($ingredients as $ingr) :
            $ing = \app\models\Skladniki::findOne($ingr->skladnik_id);
            $html .= $ing->nazwa_do_skladu;
            $html .= ($ing->alergen) ?
                ' <strong>' . $ing->alergen . '</strong>' : '';
            $html .= ($ingr->wyswietlac_procent == 1) ? '('.number_format($ingr->procenty*($quantity/100),2,',',' ').'%)' : '';
            $html .= (($ingr != $ingredients[count($ingredients) - 1]) ? ', ' : ')');
        endforeach;
    endif;
    if ($recipeIngredient->wyswietlac_procent == 1):
        $html .= ' (' . number_format($quantity, 2, ',', ' ') . '%)';
    endif;
    if ($recipeIngredient != $recipeIngredients[count($recipeIngredients) - 1] || !empty($recipeIngredientsWithFunction)):
        $html .= ', ';
    endif;
endforeach;
foreach ($recipeIngredientsWithFunction as $key => $functionArray):
    $function = \app\models\FunkcjaTechnologiczna::findOne($key);
    if (count($functionArray) > 1):
        $html .= $function->nazwa_wielokrotna . ': ';
    else :
        $html .= $function->nazwa . ': ';
    endif;
    foreach ($functionArray as $functionIngredient):
        $ingredient = $functionIngredient->ingredient;
        $quantity = ($functionIngredient->ilosc_przeliczona / ($suma)) * 100;
        $html .= $ingredient->nazwa_do_skladu;
        if ($ingredient->alergen != '') :
            $html .= ' <strong>' . $ingredient->alergen . '</strong>';
        endif;
        if ($functionIngredient->wyswietlac_procent == 1):
            $html .= '(' . number_format($quantity, 2, ',', ' ') . '%)';
        endif;
        if ($functionIngredient != $functionArray[count($functionArray) - 1]):
            $html .= ', ';
        endif;
    endforeach;
    if ($functionArray != end($recipeIngredientsWithFunction)):
        $html .= ',';
    endif;
endforeach; ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!--suppress HtmlUnknownTarget -->
    <link href="css/print.css" rel="stylesheet">
</head>
<body class="wide">
<table class="big-table">
    <?php for ($j = 0; $j < 5; $j++): ?>
        <tr>
            <?php for ($i = 0; $i < $break; $i++): ?>
                <td>
                    <?= \app\models\Konfiguracja::trans('nazwa') ?><br/>
                    <?= \app\models\Konfiguracja::trans('adres') ?><br/>
                    <?= $model->nazwa ?><br/>
                    <span class="mass">masa netto <?= $model->getFormatted('masa_netto') ?> kg</span><br/>
                    <?= $html; ?>
                </td>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>
</body>
</html>