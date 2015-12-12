<?php
/**
 * @var $recipesArray
 * @var $reportArray
 */
?>
<!DOCTYPE>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
    <link href="css/print.css" rel="stylesheet">
</head>
<body>
<div class="header">
    <?= \app\models\Konfiguracja::trans('nazwa') ?><br/>
    <?= date('d.m.y') ?>
    <img class="logo" src="uploads/<?= \app\models\Konfiguracja::trans('logo') ?>"/>
</div>
<?php foreach ($recipesArray as $recipe): ?>
    <div class="page_break">
        <div class="recipe_header">
            <div class="no-border">
                <div>
                    <div style="display:inline-block">
                        <span>Nazwa <?= \app\models\Konfiguracja::trans('produktu') ?> </span>
                    </div>
                    <div style="display:inline-block">
                        <?= $recipe['nazwa'] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="recipe_weight">
            <div class="no-border">
                <div>
                    <div style="display:inline-block">
                        <span>naważka [kg] / presa [kg]</span>
                    </div>
                    <div style="display:inline-block">
                        <?= number_format($recipe['nawazka'], 2, ',', ' ') ?>
                        / <?= number_format($recipe['presa'], 2, ',', ' ') ?>&nbsp;&nbsp;&nbsp;
                    </div>
                    <div style="display:inline-block">
                        <span>masa netto [kg]</span>
                    </div>
                    <div style="display:inline-block">
                        <?= number_format($recipe['masa_netto'], 2, ',', ' ') ?>&nbsp;&nbsp;&nbsp;
                    </div>
                    <div style="display:inline-block">
                        <span>ile sztuk</span>
                    </div>
                    <div style="display:inline-block">
                        <?= $recipe['ile_sztuk'] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="recipe_weight">
            <div class="no-border">
                <div>
                    <div style="display:inline-block">
                        <span>suma <?= \app\models\Konfiguracja::trans('skladnikow') ?> w tym woda [kg]</span>
                    </div>
                    <div style="display:inline-block">
                        <?= number_format($recipe['suma_skladnikow'], 2, ',', ' ') ?>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div>
                <div>
                    <div style="display:inline-block">
                        nazwa
                    </div>
                    <div style="display:inline-block">
                        ilość
                    </div>
                    <div style="display:inline-block">
                        jednostka
                    </div>
                </div>
                <?php foreach ($recipe['skladniki'] as $ingredient): ?>
                    <div>
                        <div style="display:inline-block">
                            <?= $ingredient['nazwa'] ?>
                        </div>
                        <div style="display:inline-block">
                            <?= number_format($ingredient['ilosc'], 2, ',', ' ') ?>
                        </div>
                        <div style="display:inline-block">
                            <?= $ingredient['jednostka'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div>
                    <div style="display:inline-block">
                        woda
                    </div>
                    <div style="display:inline-block">
                        <?= number_format($recipe['woda'], 2, ',', ' ') ?>
                    </div>
                    <div style="display:inline-block">
                        l
                    </div>
                </div>
            </div>
        </div>
        <div>
            <?= $recipe['uwagi'] ?>
        </div>
    </div>
<?php endforeach; ?>
<div class="page_break">
    <h1>Suma <?= \app\models\Konfiguracja::trans('skladnikow') ?> potrzebna do wyprodukowania powyższych <?= \app\models\Konfiguracja::trans('produktow') ?></h1>
    <div>
        <div>
            <div style="display:inline-block">
                nazwa
            </div>
            <div style="display:inline-block">
                ilość
            </div>
            <div style="display:inline-block">
                jednostka
            </div>
        </div>
        <?php foreach ($reportArray as $ingredient): ?>
            <div>
                <div style="display:inline-block">
                    <?= $ingredient['nazwa'] ?>
                </div>
                <div style="display:inline-block">
                    <?= number_format($ingredient['suma'], 2, ',', ' ') ?>
                </div>
                <div style="display:inline-block">
                    <?= $ingredient['jednostka'] ?>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>
</body>
</html>