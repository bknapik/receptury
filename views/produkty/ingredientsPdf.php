<?php
/**
 * @var $config_list
 * @var $list
 */
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="css/print.css" rel="stylesheet">
</head>
<body>
<div class="header">
    <?= $config_list[2]->wartosc ?><br/>
    <?= $config_list[0]->wartosc ?>
    <img class="logo" src="uploads/<?= $config_list[1]->wartosc ?>"/>
</div>
<div class="first-page-logo">
    <img class="logo-big" src="uploads/<?= $config_list[1]->wartosc ?>"/>
</div>
<?php /** @var $produkt \app\models\Produkty */
foreach ($list as $produkt):
    /** @var $recipe \app\models\Receptury */
    $recipe = $produkt->recipe;
    $recipeIngredients = $produkt->recipe->recipeIngredientsWithOrder;
    ?>
    <div class="page_break">
        <div class="recipe_header">
            <table class="no-border">
                <tr>
                    <td>
                        <span>Nazwa produktu </span>
                    </td>
                    <td>
                        <?= $produkt->nazwa ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="recipe_weight">
            <table class="no-border">
                <tr>
                    <td>
                        <span>masa netto [kg]</span>
                    </td>
                    <td>
                        <?= $produkt->getFormatted('masa_netto') ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="recipe_ingredient"><p class="ingredient_header">skład</p></div>
        <div class="recipe_ingredient">
            <?php foreach ($recipeIngredients as $recipeIngredient): ?>
                <?php /** @var $ingredient \app\models\Skladniki */ ?>
                <?php $ingredient = $recipeIngredient->ingredient; ?>
                <?php $ingredients = $ingredient->getChildren();
                $quantity = ($recipe->masa_koncowa / $recipeIngredient->ilosc) * 100;
                if ($ingredient->funkcja_technologiczna_id != null):
                    /** @var $function \app\models\FunkcjaTechnologiczna */
                    $function = $ingredient->function; ?>
                    &nbsp;<?= $function->nazwa ?>:
                <?php endif; ?>
                <?= $ingredient->nazwa_do_skladu ?>
                <?php if ($ingredient->alergen != '') : ?>
                    <strong><?= $ingredient->alergen ?></strong>
                <?php endif; ?>
                <?php if (!empty($ingredients) && $quantity >= 2) : ?>
                    (
                    <?php foreach ($ingredients as $ing) : ?>
                        <?= $ing->nazwa_do_skladu ?>
                        <?=
                        (($ing->alergen) ?
                            '<strong>' . $ing->alergen . '</strong>, ' :
                            (($ing != $ingredients[count($ingredients) - 1]) ? ',' : '')
                        )
                        ?>
                    <?php endforeach; ?>
                    )
                <?php endif; ?>
                <?php if ($recipeIngredient != $recipeIngredients[count($recipeIngredients) - 1]): ?>
                    ,
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>
<div class="footer bigger">
    <p>
        Produkty mogą dodatkowo zawierać <strong>sezam, soję, orzechy, seler, gorczycę, jaja, mleko, łubin i produkty
            pochodne</strong>
    </p>
</div>
</body>
</html>