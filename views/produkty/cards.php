<?php
/**
 * Created by PhpStorm.
 * User: Kinga
 * Date: 26.03.15
 * Time: 18:11
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
        foreach ($ingredients as $ing) :
            $html .= $ing->nazwa_do_skladu;
            $html .= ($ing->alergen) ?
                ' <strong>' . $ing->alergen . '</strong>' : '';
            $html .= (($ing != $ingredients[count($ingredients) - 1]) ? ', ' : ')');
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
    <link href="css/print.css" rel="stylesheet">
</head>
<body class="wide">
<table class="big-table">
    <?php for ($j = 0; $j < 5; $j++): ?>
        <tr>
            <?php for ($i = 0; $i < $break; $i++): ?>
                <td>
                    <?= $config_list[3]->wartosc ?><br/>
                    <?= $config_list[0]->wartosc ?><br/>
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