<?php
/**
 * @var $config_list
 * @var $recipesArray
 * @var $reportArray
 */
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="css/print.css" rel="stylesheet">
</head>
<body>
<div class="header">
    <?= $config_list[3]->wartosc ?><br/>
    <?= date('d.m.y') ?>
    <img class="logo" src="uploads/<?= $config_list[2]->wartosc ?>"/>
</div>
<?php foreach ($recipesArray as $recipe): ?>
    <div class="page_break">
        <div class="recipe_header">
            <table class="no-border">
                <tr>
                    <td>
                        <span>Nazwa produktu </span>
                    </td>
                    <td>
                        <?= $recipe['nazwa'] ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="recipe_weight">
            <table class="no-border">
                <tr>
                    <td>
                        <span>naważka [kg]</span>
                    </td>
                    <td>
                        <?= $recipe['nawazka'] ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="recipe_weight">
            <table class="no-border">
                <tr>
                    <td>
                        <span>suma składników [kg] / presa [kg]</span>
                    </td>
                    <td>
                        <?= $recipe['suma_skladnikow'] ?> / <?= $recipe['presa'] ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="recipe_weight">
            <table class="no-border">
                <tr>
                    <td>
                        <span>ile sztuk</span>
                    </td>
                    <td>
                        <?= $recipe['ile_sztuk'] ?>
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <table>
                <tr>
                    <th>
                        nazwa
                    </th>
                    <th>
                        ilość
                    </th>
                    <th>
                        jednostka
                    </th>
                </tr>
                <?php foreach ($recipe['skladniki'] as $ingredient): ?>
                    <tr>
                        <td>
                            <?= $ingredient['nazwa'] ?>
                        </td>
                        <td>
                            <?= $ingredient['ilosc'] ?>
                        </td>
                        <td>
                            <?= $ingredient['jednostka'] ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td>
                        woda
                    </td>
                    <td>
                        <?= $recipe['woda'] ?>
                    </td>
                    <td>
                        l
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <?= $recipe['uwagi'] ?>
        </div>
    </div>
<?php endforeach; ?>
<div class="page_break">
    <h1>Suma składników potrzebna do wyprodukowania powyższych produktów</h1>
    <table>
        <tr>
            <th>
                nazwa
            </th>
            <th>
                ilość
            </th>
            <th>
                jednostka
            </th>
        </tr>
        <?php foreach ($reportArray as $ingredient): ?>
            <tr>
                <td>
                    <?= $ingredient['nazwa'] ?>
                </td>
                <td>
                    <?= $ingredient['suma'] ?>
                </td>
                <td>
                    <?= $ingredient['jednostka'] ?>
                </td>
            </tr>

        <?php endforeach; ?>
    </table>
</div>
</body>
</html>